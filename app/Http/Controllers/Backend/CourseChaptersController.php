<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\Backend\CreateCourseChaptersRequest;
use App\Http\Requests\Backend\UpdateCourseChaptersRequest;
use App\Repositories\Backend\CourseChaptersRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class CourseChaptersController extends AppBaseController
{
    /** @var  CourseChaptersRepository */
    private $courseChaptersRepository;

    public function __construct(CourseChaptersRepository $courseChaptersRepo)
    {
        $this->middleware('auth');
        $this->courseChaptersRepository = $courseChaptersRepo;
    }

    /**
     * Display a listing of the CourseChapters.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->courseChaptersRepository->pushCriteria(new RequestCriteria($request));
        $courseChapters = $this->courseChaptersRepository->all();

        return view('backend.course_chapters.index')
            ->with('courseChapters', $courseChapters);
    }

    /**
     * Show the form for creating a new CourseChapters.
     *
     * @return Response
     */
    public function create()
    {
        return view('backend.course_chapters.create');
    }

    /**
     * Store a newly created CourseChapters in storage.
     *
     * @param CreateCourseChaptersRequest $request
     *
     * @return Response
     */
    public function store(CreateCourseChaptersRequest $request)
    {
        $input = $request->all();

        $courseChapters = $this->courseChaptersRepository->create($input);

        Flash::success('Course Chapters saved successfully.');

        return redirect(route('backend.courseChapters.index'));
    }

    /**
     * Display the specified CourseChapters.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $courseChapters = $this->courseChaptersRepository->findWithoutFail($id);

        if (empty($courseChapters)) {
            Flash::error('Course Chapters not found');

            return redirect(route('backend.courseChapters.index'));
        }

        return view('backend.course_chapters.show')->with('courseChapters', $courseChapters);
    }

    /**
     * Show the form for editing the specified CourseChapters.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $courseChapters = $this->courseChaptersRepository->findWithoutFail($id);

        if (empty($courseChapters)) {
            Flash::error('Course Chapters not found');

            return redirect(route('backend.courseChapters.index'));
        }

        return view('backend.course_chapters.edit')->with('courseChapters', $courseChapters);
    }

    /**
     * Update the specified CourseChapters in storage.
     *
     * @param  int              $id
     * @param UpdateCourseChaptersRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCourseChaptersRequest $request)
    {
        $courseChapters = $this->courseChaptersRepository->findWithoutFail($id);

        if (empty($courseChapters)) {
            Flash::error('Course Chapters not found');

            return redirect(route('backend.courseChapters.index'));
        }

        $courseChapters = $this->courseChaptersRepository->update($request->all(), $id);

        Flash::success('Course Chapters updated successfully.');

        return redirect(route('backend.courseChapters.index'));
    }

    /**
     * Remove the specified CourseChapters from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $courseChapters = $this->courseChaptersRepository->findWithoutFail($id);

        if (empty($courseChapters)) {
            Flash::error('Course Chapters not found');

            return redirect(route('backend.courseChapters.index'));
        }

        $this->courseChaptersRepository->delete($id);

        Flash::success('Course Chapters deleted successfully.');

        return redirect(route('backend.courseChapters.index'));
    }
}
