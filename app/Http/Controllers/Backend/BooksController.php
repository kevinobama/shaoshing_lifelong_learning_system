<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\Backend\CreateBooksRequest;
use App\Http\Requests\Backend\UpdateBooksRequest;
use App\Repositories\Backend\BooksRepository;
use Config;
use Flash;
use Illuminate\Http\Request;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use App\Models\Forum;
use App\Models\Subject;
use App\Models\Book;
use Session;
use App\Helpers\ZipArchiveHelper;
use DB;

class BooksController extends AppBaseController
{
    /** @var  BooksRepository */
    private $booksRepository;

    public function __construct(BooksRepository $booksRepo)
    {
        $this->middleware('auth');
        $this->booksRepository = $booksRepo;
    }

    /**
     * Display a listing of the Books.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->booksRepository->pushCriteria(new RequestCriteria($request));
        $books = $this->booksRepository->with('subject')->orderBy('id', 'desc')->paginate(20);;
        $coverImagePath = Config::get('shaoshing_lifelong_learning_system.uploads.book_covers_folder');
        $page = $request->page;
        $subjects = Subject::where(['module' => 'book'])->pluck('name', 'id');

        return view('backend.books.index')->with('books', $books)
            ->with('coverImagePath', $coverImagePath)
            ->with('page', $page)
            ->with('subjects',$subjects);
    }

    /**
     * Show the form for creating a new Books.
     *
     * @return Response
     */
    public function create()
    {
        $subjects = Subject::where(['module' => 'book'])->pluck('name', 'id');

        return view('backend.books.create')->with('subjects', $subjects);
    }

    /**
     * Store a newly created Books in storage.
     *
     * @param CreateBooksRequest $request
     *
     * @return Response
     */
    public function store(CreateBooksRequest $request)
    {
        $input = $request->all();

        $book_covers_location = Config::get('shaoshing_lifelong_learning_system.uploads.book_covers_folder');
        $books_location       = Config::get('shaoshing_lifelong_learning_system.uploads.books_folder');
        $createTime = time();
        $coverImageUrl = null;
        $path = Config::get('shaoshing_lifelong_learning_system.media_path');
        if ($request->file('cover_image_url')) {
            $bookCoverName = "cover_image_".$createTime.'.'.$request->cover_image_url->getClientOriginalExtension();
            $request->cover_image_url->move($path.$book_covers_location.$input['subject_id'].'/', $bookCoverName);
            $coverImageUrl = $book_covers_location.$input['subject_id'].'/'.$bookCoverName;
            $input                = array_merge($input, array('cover_image_url' => $coverImageUrl));
        }
        if ($request->file('download_url')) {
            $bookFileName = "book_file_".time().'.'.$request->download_url->getClientOriginalExtension();

            $request->download_url->move($path.$books_location.$input['subject_id'].'/', $bookFileName);
            $input                = array_merge($input, array('download_url' => $books_location.$input['subject_id'].'/'.$bookFileName));

            $bookFileExtension = $request->download_url->getClientOriginalExtension();

            if(strtolower($bookFileExtension) === 'epub') {
                $coverImagePath = $path.$book_covers_location.$input['subject_id'].'/'.$createTime.'/';
                $epubfile = $path.$books_location.$input['subject_id'].'/'.$bookFileName;
                ZipArchiveHelper::extractCoverImage($epubfile, $coverImagePath);
                $coverImageUrl = $book_covers_location.$input['subject_id'].'/'.$createTime.'/'.'cover.jpeg';
                $input = array_merge($input, array('cover_image_url' => $coverImageUrl));
            }

            if(empty($input['title'])) {
                $input = array_merge($input, array('title' => str_replace(".epub","",$bookFileName)));
            }
        }

        Session::put('subject_id', $input['subject_id']);

        DB::beginTransaction();
        try {
            $books = $this->booksRepository->create($input);

            $forum = new Forum(['name' => $input['title'], 'desc' => 'Forum of ' . $input['title']]);
            if ($coverImageUrl) {
                $forum->cover = $coverImageUrl;
            }
            $forum->save();
            $books->forum_id = $forum->id;
            $books->save();

            DB::commit();
            Flash::success('电子书已成功保存.');
        } catch (\Exception $e) {
            DB::rollback();
            Log::info(array('log_content'=> $e->getMessage()));
            throw $e;
        }

        return redirect(route('backend.books.index'));
    }

    /**
     * Display the specified Books.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $books = $this->booksRepository->findWithoutFail($id);

        if (empty($books)) {
            Flash::error('Books not found');

            return redirect(route('backend.books.index'));
        }

        return view('backend.books.show')->with('books', $books);
    }

    /**
     * Show the form for editing the specified Books.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id,Request $request)
    {
        $books = $this->booksRepository->findWithoutFail($id);

        if (empty($books)) {
            Flash::error('Books not found');

            return redirect(route('backend.books.index'));
        }
        $subjects = Subject::where(['module' => 'book'])->pluck('name', 'id');

        return view('backend.books.edit')->with('books', $books)
            ->with('subjects', $subjects)
            ->with('page', $request->page);
    }

    /**
     * Update the specified Books in storage.
     *
     * @param  int              $id
     * @param UpdateBooksRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateBooksRequest $request)
    {
        $input   = $request->all();
        $book = $this->booksRepository->findWithoutFail($id);

        if (empty($book)) {
            Flash::error('电子书未找到');
            return redirect(route('backend.books.index'));
        }

        $book_covers_location = Config::get('shaoshing_lifelong_learning_system.uploads.book_covers_folder');
        $books_location       = Config::get('shaoshing_lifelong_learning_system.uploads.books_folder');
        $createTime = strtotime($book->created_at);
        $coverImageUrl = null;
        $path = Config::get('shaoshing_lifelong_learning_system.media_path');

        if ($request->file('download_url')) {
            $bookFileName = "book_file_".$createTime.'.'.$request->download_url->getClientOriginalExtension();
            $request->download_url->move($path.$books_location.$input['subject_id'].'/', $bookFileName);
            $input                = array_merge($input, array('download_url' => $books_location.$input['subject_id'].'/'.$bookFileName));

            $bookFileExtension = $request->download_url->getClientOriginalExtension();

            if(strtolower($bookFileExtension) === 'epub') {
                $coverImagePath = $book_covers_location.$input['subject_id'].'/'.$createTime.'/';
                $epubfile = $path.$books_location.$input['subject_id'].'/'.$bookFileName;
                ZipArchiveHelper::extractCoverImage($epubfile, $path.$coverImagePath);
                $coverImageUrl = $coverImagePath.'cover.jpeg';
                $input = array_merge($input, array('cover_image_url' => $coverImageUrl));
            }
        }

        if ($request->file('cover_image_url')) {
            $bookCoverName = "cover_image_".$createTime.'.'.$request->cover_image_url->getClientOriginalExtension();
            $coverImagePath = $book_covers_location.$input['subject_id'].'/'.$createTime.'/';
            $request->cover_image_url->move($path.$coverImagePath, $bookCoverName);
            $coverImageUrl = $coverImagePath.$bookCoverName;
            $input = array_merge($input, array('cover_image_url' => $coverImageUrl));
        }

        $book = $this->booksRepository->update($input, $id);
        if ($coverImageUrl) {
            Forum::find($book->forum_id)->update(array('cover' => $coverImageUrl));
        }

        Flash::success('Book updated successfully.');
        if ($input['page']) {
            return redirect(route('backend.books.index')."?page=".$input['page']);
        } else {
            return redirect(route('backend.books.index'));
        }
    }

    /**
     * Remove the specified Books from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $books = $this->booksRepository->findWithoutFail($id);

        if (empty($books)) {
            Flash::error('Books not found');

            return redirect(route('backend.books.index'));
        }
        
        // First delete the relation
        Book::find($id)->users()->detach();
        
        $this->booksRepository->delete($id);
        
        Flash::success('Books deleted successfully.');
        
        return redirect(route('backend.books.index'));
    }
}
