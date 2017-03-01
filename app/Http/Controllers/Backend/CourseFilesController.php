<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\Backend\CreateCourseFilesRequest;
use App\Http\Requests\Backend\UpdateCourseFilesRequest;
use App\Repositories\Backend\CourseFilesRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class CourseFilesController extends AppBaseController
{
    /** @var  CourseFilesRepository */
    private $courseFilesRepository;

    public function __construct(CourseFilesRepository $courseFilesRepo)
    {
        $this->middleware('auth');
        $this->courseFilesRepository = $courseFilesRepo;
    }

    /**
     * Display a listing of the CourseFiles.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->courseFilesRepository->pushCriteria(new RequestCriteria($request));
        $courseFiles = $this->courseFilesRepository->all();

        return view('backend.course_files.index')
            ->with('courseFiles', $courseFiles);
    }

    /**
     * Show the form for creating a new CourseFiles.
     *
     * @return Response
     */
    public function create()
    {
        return view('backend.course_files.create');
    }

    /**
     * Store a newly created CourseFiles in storage.
     *
     * @param CreateCourseFilesRequest $request
     *
     * @return Response
     */
    public function store(CreateCourseFilesRequest $request)
    {
        $input = $request->all();

        $courseFiles = $this->courseFilesRepository->create($input);

        Flash::success('Course Files saved successfully.');

        return redirect(route('backend.courseFiles.index'));
    }

    /**
     * Display the specified CourseFiles.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $courseFiles = $this->courseFilesRepository->findWithoutFail($id);

        if (empty($courseFiles)) {
            Flash::error('Course Files not found');

            return redirect(route('backend.courseFiles.index'));
        }

        return view('backend.course_files.show')->with('courseFiles', $courseFiles);
    }

    /**
     * Show the form for editing the specified CourseFiles.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $courseFiles = $this->courseFilesRepository->findWithoutFail($id);

        if (empty($courseFiles)) {
            Flash::error('Course Files not found');

            return redirect(route('backend.courseFiles.index'));
        }

        return view('backend.course_files.edit')->with('courseFiles', $courseFiles);
    }

    /**
     * Update the specified CourseFiles in storage.
     *
     * @param  int              $id
     * @param UpdateCourseFilesRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCourseFilesRequest $request)
    {
        $courseFiles = $this->courseFilesRepository->findWithoutFail($id);

        if (empty($courseFiles)) {
            Flash::error('Course Files not found');

            return redirect(route('backend.courseFiles.index'));
        }

        $courseFiles = $this->courseFilesRepository->update($request->all(), $id);

        Flash::success('Course Files updated successfully.');

        return redirect(route('backend.courseFiles.index'));
    }

    /**
     * Remove the specified CourseFiles from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $courseFiles = $this->courseFilesRepository->findWithoutFail($id);

        if (empty($courseFiles)) {
            Flash::error('Course Files not found');

            return redirect(route('backend.courseFiles.index'));
        }

        $this->courseFilesRepository->delete($id);

        Flash::success('Course Files deleted successfully.');

        return redirect(route('backend.courseFiles.index'));
    }
}
