<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Course;
use DB;
use App\Helpers\Utility;
use App\Models\CourseChapter;
use App\Models\UsersForums;
use Illuminate\Support\Facades\Auth;
use Config;

class CoursesController extends Controller
{
    public function __construct()
    {
        if (array_key_exists('HTTP_AUTHORIZATION', $_SERVER) && !empty($_SERVER['HTTP_AUTHORIZATION'])) {
            $this->middleware('auth:api');
        }
    }

    /**
     * Display a listing of the Courses.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $input = $request->all();
        $name= isset($input['name']) ? $input['name']: null;
        $perPage= isset($input['per_page']) ? $input['per_page']: 50;
        $subjectId= isset($input['subject_id']) ? $input['subject_id']: null;

        $courses = Course::select(DB::raw('id, name, introduction, type, user_id, user_name, cover_image, new_post_count,bookmark_count,forum_id'))
            ->when($name, function ($query) use ($name) {
                return $query->with('chapters')->where("name",'like', "%{$name}%");
            })
            ->when($subjectId, function ($query) use ($subjectId) {
                return $query->where("subject_id", $subjectId);
            })
            ->with(array('bookmarksByUserId' => function($query)
            {
                return $query->select('id as bookmark_id','course_id');
            }))
            ->orderBy('id', 'DESC')
            ->paginate($perPage);

        $courses =Utility::cleanPage($courses);
        $courses['fileUrl'] = Config::get('shaoshing_lifelong_learning_system.media_host');
        unset($courses['media_host']);

        return $courses;
    }

    /**
     * Display the specified Courses.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $course = Course::select('id', 'name', 'introduction', 'type', 'user_id', 'user_name', 'cover_image', 'new_post_count', 'forum_id', 'bookmark_count')->findOrFail($id);

        if (empty($course)) {
            return response()->json([
                'error' => "Course not found"
            ], 400);
        }

        $forums = UsersForums::select('forum_id', 'created_at', 'last_read_at')
            ->withCount('newPosts')
            ->where('forum_id', $course->forum_id)
            ->first();

        if ($forums) {
            $course->new_post_count = $forums->new_posts_count;
        }

        $courseChapters = CourseChapter::select('id', 'chapter_name')
            ->where('course_id', $id)
            ->with('files')
            ->get();

        $fileUrl = Config::get('shaoshing_lifelong_learning_system.media_host');

        return array('course' => $course, 'courseChapters'=>$courseChapters, 'fileUrl' => $fileUrl);
    }
}
