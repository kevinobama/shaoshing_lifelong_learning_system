<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\Backend\CreateCoursesRequest;
use App\Http\Requests\Backend\UpdateCoursesRequest;
use App\Models\CourseChapter;
use App\Models\CourseFile;
use App\Models\Forum;
use App\Repositories\Backend\CoursesRepository;
use Config;
use Flash;
use Illuminate\Http\Request;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use App\Models\Subject;
use Log;
use Session;

class CoursesController extends AppBaseController
{
    /** @var  CoursesRepository */
    private $coursesRepository;

    public function __construct(CoursesRepository $coursesRepo)
    {
        $this->middleware('auth');
        $this->coursesRepository = $coursesRepo;
    }

    /**
     * Display a listing of the Courses.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->coursesRepository->pushCriteria(new RequestCriteria($request));
        $courses        = $this->coursesRepository->with('users')
            ->orderBy('id', 'desc')
            ->paginate(20);

        $coverImagePath = Config::get('shaoshing_lifelong_learning_system.uploads.courseCoverImage');
        Session::put('page', $request->page);
        return view('backend.courses.index')->with('courses', $courses)->with('coverImagePath', $coverImagePath);
    }

    /**
     * Show the form for creating a new Courses.
     *
     * @return Response
     */
    public function create()
    {
        $createdAt = time();
        $subjects = Subject::where(['module' => 'course'])->pluck('name', 'id');

        return view('backend.courses.create')
            ->with('createdAt', $createdAt)
            ->with('subjects', $subjects)
            ->with('count', 1)
            ->with('lesson_file_count', 2);
    }

    /**
     * Store a newly created Courses in storage.
     *
     * @param CreateCoursesRequest $request
     *
     * @return Response
     */
    public function store(CreateCoursesRequest $request)
    {
        $input = $request->all();
        $createTime = $request->created_at;
        $coverImageUrl = null;
        $input = array_merge($input, array('created_at' => date("Y-m-d H:i:s", $createTime)));

        if ($request->file('cover_image')) {
            $imageName      = "cover_image_".$createTime . '.' . $request->file('cover_image')->getClientOriginalExtension();
            $coverImagePath = Config::get('shaoshing_lifelong_learning_system.uploads.courseCoverImage').$createTime.'/';
            $path = Config::get('shaoshing_lifelong_learning_system.media_path');
            $request->file('cover_image')->move($path.$coverImagePath, $imageName);
            $coverImageUrl = $coverImagePath.$imageName;
            $input                = array_merge($input, array('cover_image' => $coverImageUrl));
        }

        $course = $this->coursesRepository->create($input);
        $forum = new Forum(['name' => $input['name'], 'desc' => $input['introduction']]);
        if ($coverImageUrl) {
            $forum->cover = $coverImageUrl;
        }
        $forum->save();
        $course->forum_id = $forum->id;
        $course->save();

        if ($input['chapter_name']) {
            foreach($input['chapter_name'] as $key => $chapter ) {
                if(empty($chapter) && empty($input['lesson_name'][$key])) continue;
                $courseChapter = CourseChapter::create(array('course_id'=>$course->id, 'chapter_name' => $chapter));
                CourseFile::create(array('course_chapter_id'=>$courseChapter->id,
                                         'lesson_name' => $input['lesson_name'][$key],
                                         'url' => $input['text_lesson_file'.($key+1).'1']));
            }
        }

        Flash::success('课程已成功保存.');

        return redirect(route('backend.courses.index'));
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
        $courses = $this->coursesRepository->findWithoutFail($id);


        if (empty($courses)) {
            Flash::error('Courses not found');

            return redirect(route('backend.courses.index'));
        }
        $coverImagePath  = Config::get('shaoshing_lifelong_learning_system.uploads.courseCoverImage');
        $coursefilesPath = Config::get('shaoshing_lifelong_learning_system.uploads.coursefiles');
        $courseChapters  = CourseChapter::where('course_id', $id)->with('files')->get();

        return view('backend.courses.show')->with('courses', $courses)
            ->with('courseChapters', $courseChapters)
            ->with('coverImagePath', $coverImagePath)
            ->with('coursefilesPath', $coursefilesPath);
    }

    /**
     * Show the form for editing the specified Courses.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $courses = $this->coursesRepository->findWithoutFail($id);

        if (empty($courses)) {
            Flash::error('Courses not found');

            return redirect(route('backend.courses.index'));
        }

        $courseChapters = CourseChapter::where('course_id', $id)->with('files')->get();
        $createdAt = strtotime($courses->created_at);
        $subjects = Subject::where(['module' => 'course'])->pluck('name', 'id');
        $lessonFileCount = $count = count($courseChapters)+1;

        return view('backend.courses.edit')->with('courses', $courses)
            ->with('courseChapters', $courseChapters)
            ->with('createdAt', $createdAt)
            ->with('subjects', $subjects)
            ->with('count', $count)
            ->with('lesson_file_count', $lessonFileCount);
    }

    /**
     * Update the specified Courses in storage.
     *
     * @param  int              $id
     * @param UpdateCoursesRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCoursesRequest $request)
    {
        $course = $this->coursesRepository->findWithoutFail($id);
        $createTime = strtotime($course->created_at);
        $input   = $request->all();
        $coverImageUrl = null;

        if (empty($course)) {
            Flash::error('Course not found');
            return redirect(route('backend.courses.index'));
        }

        if ($request->file('cover_image')) {
            $imageName      = "cover_image_".$createTime.'.'.$request->file('cover_image')->getClientOriginalExtension();
            $coverImagePath = Config::get('shaoshing_lifelong_learning_system.uploads.courseCoverImage').$createTime.'/';
            $path = Config::get('shaoshing_lifelong_learning_system.media_path');
            $request->file('cover_image')->move($path .$coverImagePath, $imageName);
            $coverImageUrl = $coverImagePath.$imageName;
            $input                = array_merge($input, array('cover_image' => $coverImageUrl));
        }
        if($input['subject_id']) {
            $subject = Subject::find($input['subject_id']);
            $input = array_merge($input, array('subject_name' => $subject->name));
        }

        $course = $this->coursesRepository->update($input, $id);
        if ($coverImageUrl) {
            Forum::find($course->forum_id)->update(array('cover' => $coverImageUrl));
        }
        $courseChapters = CourseChapter::where('course_id', $id)->with('files')->get();
        if ($courseChapters) {
            foreach($courseChapters as $key => $chapter) {
                $chapter->update(array('chapter_name' => $input['chapter_name'.$chapter->id]));
                foreach($chapter->files as $file) {
                    $file->update(array(
                        'lesson_name' => $input['lesson_name'.$file->id],
                        'url' => $input['text_lesson_file'.($key+1).'1']
                    ));
                }
            }
        }

        if ($input['chapter_name']) {
            foreach($input['chapter_name'] as $key => $chapter ) {
                if(empty($chapter) && empty($input['lesson_name'][$key])) continue;
                $courseChapter = CourseChapter::create(array('course_id'=>$course->id, 'chapter_name' => $chapter));
                CourseFile::create(array('course_chapter_id'=>$courseChapter->id,
                    'lesson_name' => $input['lesson_name'][$key],
                    'url' => $input['text_lesson_file'.($key+1).'1']));
            }
        }

        Flash::success('课程已成功更新.');
        $page = Session("page");
        return redirect(route('backend.courses.index')."?page=".$page);
    }

    /**
     * Remove the specified Courses from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $courses = $this->coursesRepository->findWithoutFail($id);

        if (empty($courses)) {
            Flash::error('Courses not found');

            return redirect(route('backend.courses.index'));
        }

        $this->coursesRepository->delete($id);

        Flash::success('Courses deleted successfully.');

        return redirect(route('backend.courses.index'));
    }

    /**
     * @param Request $request
     * @return mixed
     * //file input name = $fileKeys[1]
     */
    public function upload(Request $request)
    {
        $input    = $request->all();
        try {
            if ($request->file('file')) {
                $filePath = Config::get('shaoshing_lifelong_learning_system.uploads.coursefiles').$input['createdAt'].'/';
                $fileName = $input['inputName'].'_'.$input['createdAt'].'.'.$request->file('file')->getClientOriginalExtension();
                $path = Config::get('shaoshing_lifelong_learning_system.media_path');

                $request->file('file')->move(
                    $path.$filePath, $fileName
                );
            }
        } catch (Exception $e) {
            Log::debug($e->getMessage());
            return response()->json(['msg' => "error"], 200);
        }

        return response()->json(['msg' => "success", 'fileName' => $filePath.$fileName, 'inputName' => $input['inputName']], 200);
    }
}
