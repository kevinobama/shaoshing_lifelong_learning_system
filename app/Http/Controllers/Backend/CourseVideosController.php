<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\Backend\CreateCourseVideosRequest;
use App\Http\Requests\Backend\UpdateCourseVideosRequest;
use App\Repositories\Backend\CourseVideosRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class CourseVideosController extends AppBaseController
{
    /** @var  CourseVideosRepository */
    private $courseVideosRepository;

    public function __construct(CourseVideosRepository $courseVideosRepo)
    {
        $this->middleware('auth');
        $this->courseVideosRepository = $courseVideosRepo;
    }

    /**
     * Display a listing of the CourseVideos.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->courseVideosRepository->pushCriteria(new RequestCriteria($request));
        $courseVideos = $this->courseVideosRepository->all();

        return view('backend.course_videos.index')
            ->with('courseVideos', $courseVideos);
    }

    /**
     * Show the form for creating a new CourseVideos.
     *
     * @return Response
     */
    public function create()
    {
        return view('backend.course_videos.create');
    }

    /**
     * Store a newly created CourseVideos in storage.
     *
     * @param CreateCourseVideosRequest $request
     *
     * @return Response
     */
    public function store(CreateCourseVideosRequest $request)
    {
        $input = $request->all();

        $courseVideos = $this->courseVideosRepository->create($input);

        Flash::success('Course Videos saved successfully.');

        return redirect(route('backend.courseVideos.index'));
    }

    /**
     * Display the specified CourseVideos.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $courseVideos = $this->courseVideosRepository->findWithoutFail($id);

        if (empty($courseVideos)) {
            Flash::error('Course Videos not found');

            return redirect(route('backend.courseVideos.index'));
        }

        return view('backend.course_videos.show')->with('courseVideos', $courseVideos);
    }

    /**
     * Show the form for editing the specified CourseVideos.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $courseVideos = $this->courseVideosRepository->findWithoutFail($id);

        if (empty($courseVideos)) {
            Flash::error('Course Videos not found');

            return redirect(route('backend.courseVideos.index'));
        }

        return view('backend.course_videos.edit')->with('courseVideos', $courseVideos);
    }

    /**
     * Update the specified CourseVideos in storage.
     *
     * @param  int              $id
     * @param UpdateCourseVideosRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCourseVideosRequest $request)
    {
        $courseVideos = $this->courseVideosRepository->findWithoutFail($id);

        if (empty($courseVideos)) {
            Flash::error('Course Videos not found');

            return redirect(route('backend.courseVideos.index'));
        }

        $courseVideos = $this->courseVideosRepository->update($request->all(), $id);

        Flash::success('Course Videos updated successfully.');

        return redirect(route('backend.courseVideos.index'));
    }

    /**
     * Remove the specified CourseVideos from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $courseVideos = $this->courseVideosRepository->findWithoutFail($id);

        if (empty($courseVideos)) {
            Flash::error('Course Videos not found');

            return redirect(route('backend.courseVideos.index'));
        }

        $this->courseVideosRepository->delete($id);

        Flash::success('Course Videos deleted successfully.');

        return redirect(route('backend.courseVideos.index'));
    }
}
