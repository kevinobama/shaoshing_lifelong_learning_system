<?php
namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\Models\Book;
use App\Models\User;
use App\Models\Subject;

use Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Users_book;

class BooksController extends Controller
{
    public function __construct()
    {
        if (array_key_exists('HTTP_AUTHORIZATION', $_SERVER) && !empty($_SERVER['HTTP_AUTHORIZATION'])) {
            $this->middleware('auth:api');
        }
    }

    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        //
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create()
    {
        //
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(Request $request)
    {
        //
    }

    /**
    * Display the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function show($id)
    {
        //
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function edit($id)
    {
        //
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function update(Request $request, $id)
    {
        //
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    * 
    */
    public function destroy($id)
    {
        //
    }
   
   
    /**
    * Delete Books from Users list
    *
    * @param  Request $request
    * @return \Illuminate\Http\Response
    * 
    */
    public function deleteFromMylist(Request $request) {
        $bookParams = $request->all();
        
        // Get User Information 
        $userId = Auth::id();
        $exists = 0;
        
        // Check if Book Id is set
        if(!isset($bookParams["book_id"])) {
            $errorMsg = "参数丢失";
            return response()->json(['error' => $errorMsg], 400);     
        }
        
        // Check if the book exists in the list
        if(!$this->checkBookExistsInList($bookParams["book_id"], $userId)) {
            $errorMsg = "书不存在于列表中";
            return response()->json(['error' => $errorMsg], 400);     
        }
        
        // Delete the book from the user association
        try{
            $bookUpdate = User::find($userId)->books()->detach($bookParams["book_id"]);
        } catch (Exception $ex) {
            return response()->json(['error' => "无法保存消息: ".$ex->getMessage()], 400);     
        }
        
        // Subtract from download Count
        try{
            $downloadCountUpdateResult = Book::where('id', $bookParams["book_id"])->decrement('download_count');
        } catch (Exception $ex) {
            return response()->json(['error' => "无法删除书: ".$ex->getMessage()], 400);     
        }
        return response()->json(['msg' => "success"], 200);
    }
   
    /**
    * Add Books from Users list
    *
    * @param  Request $request
    * @return \Illuminate\Http\Response
    * 
    */
    public function addToMylist(Request $request) {
        $bookParams = $request->all();
        
        // Get User Information 
        $userId = Auth::id();
        $exists = 0;
        $insertedId = 0;
        
        // Check if Book Id is set
        if(!isset($bookParams["book_id"])) {
            $errorMsg = "参数丢失";
            return response()->json(['error' => $errorMsg], 400);     
        }
        
        // Check if the book exists in the list
        if($this->checkBookExistsInList($bookParams["book_id"], $userId)) {
            $errorMsg = "书已存在于列表中";
            return response()->json(['error' => $errorMsg], 400);     
        }
        
        // ADD the book TO the user association
        try{
            $bookUpdate = User::find($userId)->books()->attach($bookParams["book_id"]);
            
            // Get the pivot table insert id
            $insertedId = $this->getUserBookId($bookParams["book_id"], $userId);
        } catch (Exception $ex) {
            return response()->json(['error' => "无法保存消息: ".$ex->getMessage()], 400);     
        }
        
        // Add to download Count
        try{
            $downloadCountUpdateResult = Book::where('id', $bookParams["book_id"])->increment('download_count');
        } catch (Exception $ex) {
            return response()->json(['error' => "无法更新下载次数: ".$ex->getMessage()], 400);     
        }
        return response()->json(['data'=>['book_user_id' => $insertedId]], 200);  
    }
   
    /**
    * Browse Books from Users list
    *
    * @param  Request $request
    * @return \Illuminate\Http\Response
    * 
    */
    public function browse(Request $request) {
        $bookParams = $request->all();
        $subjectId = (isset($bookParams['subject_id']))? $bookParams['subject_id'] : '';
        $pageLimit = (isset($bookParams['per_page']))? $bookParams['per_page'] : Config::get('shaoshing_lifelong_learning_system.defaultPageLimit'); // @TODO: check if this is correct
        $searchKeyword = (isset($bookParams['search_keyword']))? $bookParams['search_keyword'] : '';
        
        $searchResult = array();
        $subjectsResult = array();
//        $searchResult['subject_id'] = $subjectId;
        
//        // Get the subject name
//        $subject = Subject::where('id', $subjectId)->get(['name']);
//        if($subject->count()) {
//            $searchResult['subject_name'] = $subject[0]->name; 
//        } else {
//            $searchResult['subject_name'] = '';
//        }
        
        try{
            // Get the Search Result
            $books = Book::select(DB::raw('id, title, author, download_count, download_url, cover_image_url, forum_id'))
                ->when($subjectId, function ($query) use ($subjectId) {
                    return $query->where('subject_id', $subjectId);;
                })
                ->when($searchKeyword, function ($query) use ($searchKeyword) {
                    return $query->where('title', 'like',  "%".$searchKeyword."%")
                                 ->orWhere('author', 'like',  "%".$searchKeyword."%");
                })
                ->with(array('userBooksByUserId' => function($query)
                {
                    return $query->select('id as user_book_id','book_id');
                }))
                ->orderBy('books.id', 'DESC')
                ->paginate($pageLimit);

            // Get the Result 
            $searchResult['data'] = $books;
            if(!$searchResult['data']->count()) {
                return response()->json($this->removePaginationLinks($searchResult['data']), 200);
            } else {
                $books = $this->removePaginationLinks($searchResult['data'], true);
                $books['fileUrl'] = Config::get('shaoshing_lifelong_learning_system.media_host');
                return response()->json($books, 200);
            }
            return response()->json($searchResult['data'], 200);  
        } catch (Exception $ex) {
            return response()->json(['error' => "无法获取结果: ".$ex->getMessage()], 400);     
        }
    }
   
   
    /**
    * Delete Books from Users list
    *
    * @param  Request $request
    * @return \Illuminate\Http\Response
    * 
    */
    public function getBasicInfoOfBooks(Request $request) {
        //
    }
   
    /**
    * Delete Books from Users list
    *
    * @param  Request $request
    * @return \Illuminate\Http\Response
    * 
    */
    public function getDetailsOfBooks(Request $request) {
        //
    }
   
    /**
    * List Books from Users list
    *
    * @param  Request $request
    * @return \Illuminate\Http\Response
    * 
    */
    public function getMyList(Request $request) {
        // Get User Information 
        $userId = Auth::id();
        $bookParams = $request->all();
        
        $pageLimit = (isset($bookParams['per_page']))? $bookParams['per_page'] : Config::get('shaoshing_lifelong_learning_system.defaultPageLimit'); // @TODO: check if this is correct
        $userBookListData = array();
        
        //Paginated
        try{
            $listOfBooks = User::find($userId)->books()->orderBy('users_books.id', 'DESC')->paginate($pageLimit, ['title', 'author', 'download_count', 'download_url', 'cover_image_url', 'forum_id']);
            if(!$listOfBooks->count()) {
                return response()->json($this->removePaginationLinks($listOfBooks), 200);
            }

            $books = $this->removePaginationLinks($listOfBooks, true);
            $books['fileUrl'] = Config::get('shaoshing_lifelong_learning_system.media_host');

            return response()->json($books, 200);
        } catch (Exception $ex) {
            return response()->json(['error' => "无法获取结果:  ".$ex->getMessage()], 400);     
        }
    }
    
    /**
    * List Books from Users list
    *
    * @param  Request $request
    * @return \Illuminate\Http\Response
    * 
    */
    public function getDownloadCount(Request $request) {
        //
    }
    
    /**
    * List Books from Users list
    *
    * @param  Request $request
    * @return \Illuminate\Http\Response
    * 
    */
    public function getDownloadLink(Request $request) {
        //
    }
   
    /**
    * List Books from Users list
    *
    * @param  Request $request
    * @return \Illuminate\Http\Response
    * 
    */
//   public function (Request $request) {
//       //
//   }
   
   /**
    * List Books from Users list
    *
    * @param  Request $request
    * @return \Illuminate\Http\Response
    * 
    */
//   public function (Request $request) {
//       //
//   }
    
    
    private function checkBookExistsInList($bookId, $userId) {
        // Check if Already in user list
        $exists = DB::table('users_books') // @TODO check if model can be used
            ->whereBookId($bookId)
            ->whereUserId($userId)
            ->count() > 0;
        return ($exists > 0) ? true : false;
    }
    
    
    private function getUserBookId($bookId, $userId) {
        // Check if Already in user list
        $pivotData = DB::table('users_books') // @TODO check if model can be used
            ->whereBookId($bookId)
            ->whereUserId($userId)
            ->first();
        
        return $pivotData->id;
    }
    
    private function removePaginationLinks($dataObj, $total = false) {
        $dataDump = json_decode(json_encode($dataObj), true);
        
        unset($dataDump['next_page_url']);
        unset($dataDump['prev_page_url']);
        $dataDump['from'] = 0;
        $dataDump['to'] = 0;
        if(!$total) {
            $dataDump['data'] = array();
        }
        return $dataDump;
    }
}