<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Backend\CreateUserCourseBookmarksRequest;
use App\Http\Requests\Backend\UpdateUserCourseBookmarksRequest;
use App\Repositories\Backend\UserCourseBookmarksRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Illuminate\Support\Facades\Auth;
use App\Helpers\Utility;
use Config;
use App\Models\Course;

class UserCourseBookmarksController extends AppBaseController
{
    /** @var  UserCourseBookmarksRepository */
    private $userCourseBookmarksRepository;

    public function __construct(UserCourseBookmarksRepository $userCourseBookmarksRepo)
    {
        if (array_key_exists('HTTP_AUTHORIZATION', $_SERVER)) {
            $this->middleware('auth:api');
        } else {
            $this->middleware('auth:api', ['only' => ['store']]);
        }
        $this->userCourseBookmarksRepository = $userCourseBookmarksRepo;
    }

    /**
     * Display a listing of the UserCourseBookmarks.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $userId = Auth::id();
        $request->merge(array('search' => 'user_id:'.$userId));
        $this->userCourseBookmarksRepository->pushCriteria(new RequestCriteria($request));
        $userCourseBookmarks = $this->userCourseBookmarksRepository->with('course')
            ->orderBy('created_at', 'DESC')
            ->paginate(50,['id','course_id']);

        $fileUrl = Config::get('shaoshing_lifelong_learning_system.media_host');

        $userCourseBookmarks =Utility::cleanPage($userCourseBookmarks);
        $userCourseBookmarks['fileUrl'] = $fileUrl;
        unset($userCourseBookmarks['media_host']);

        return $userCourseBookmarks;
    }


    /**
     * Store a newly created UserCourseBookmarks in storage.
     *
     * @param CreateUserCourseBookmarksRequest $request
     *
     * @return Response
     */
    public function store(CreateUserCourseBookmarksRequest $request)
    {
        $userId = Auth::id();
        $userName =Auth::user()->name;
        $input = $request->all();
        $input = array_merge($input,array('user_id' => $userId, 'user_name' => $userName));
        $count = $this->userCourseBookmarksRepository->findWhere(['user_id'=>$userId, 'course_id'=> $input['course_id']])->count();

        if($count === 0) {
            $userCourseBookmark = $this->userCourseBookmarksRepository->create($input);
            Course::find($input['course_id'])->increment('bookmark_count');
            if($userCourseBookmark) {
                return response()->json(['msg' => '选课成功', 'userCourseBookmark'=> $userCourseBookmark], 200);
            } else {
                return response()->json(['error' => '选课失败'], 400);
            }
        } else {
            return response()->json(['error' => '已经加入你的课程'], 400);
        }
    }

    /**
     * Remove the specified UserCourseBookmarks from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $userCourseBookmarks = $this->userCourseBookmarksRepository->findWithoutFail($id);

        if (empty($userCourseBookmarks)) {
            return response()->json(['error' => '用户的课程找不到'], 400);
        }

        $userCourseBookmark = $this->userCourseBookmarksRepository->delete($id);
        if($userCourseBookmark) {
            $course = Course::find($userCourseBookmarks->course_id);
            if($course->bookmark_count > 0) {
                $course->decrement('bookmark_count');
            }
            return response()->json(['msg' => 'success'], 200);;
        } else {
            return response()->json(['error' => 'failed'], 400);;
        }
    }
}
