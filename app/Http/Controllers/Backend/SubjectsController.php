<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\Backend\CreateSubjectsRequest;
use App\Http\Requests\Backend\UpdateSubjectsRequest;
use App\Repositories\Backend\SubjectsRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class SubjectsController extends AppBaseController
{
    /** @var  SubjectsRepository */
    private $subjectsRepository;

    public function __construct(SubjectsRepository $subjectsRepo)
    {
        $this->subjectsRepository = $subjectsRepo;
    }

    /**
     * Display a listing of the Subjects.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->subjectsRepository->pushCriteria(new RequestCriteria($request));
        $subjects = $this->subjectsRepository->all();

        return view('backend.subjects.index')
            ->with('subjects', $subjects);
    }

    /**
     * Show the form for creating a new Subjects.
     *
     * @return Response
     */
    public function create()
    {
        return view('backend.subjects.create');
    }

    /**
     * Store a newly created Subjects in storage.
     *
     * @param CreateSubjectsRequest $request
     *
     * @return Response
     */
    public function store(CreateSubjectsRequest $request)
    {
        $input = $request->all();

        $subjects = $this->subjectsRepository->create($input);

        Flash::success('Subjects saved successfully.');

        return redirect(route('subjects.index'));
    }

    /**
     * Display the specified Subjects.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $subjects = $this->subjectsRepository->findWithoutFail($id);

        if (empty($subjects)) {
            Flash::error('Subjects not found');

            return redirect(route('subjects.index'));
        }

        return view('backend.subjects.show')->with('subjects', $subjects);
    }

    /**
     * Show the form for editing the specified Subjects.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $subjects = $this->subjectsRepository->findWithoutFail($id);

        if (empty($subjects)) {
            Flash::error('Subjects not found');

            return redirect(route('subjects.index'));
        }

        return view('backend.subjects.edit')->with('subjects', $subjects);
    }

    /**
     * Update the specified Subjects in storage.
     *
     * @param  int              $id
     * @param UpdateSubjectsRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateSubjectsRequest $request)
    {
        $subjects = $this->subjectsRepository->findWithoutFail($id);

        if (empty($subjects)) {
            Flash::error('Subjects not found');

            return redirect(route('subjects.index'));
        }

        $subjects = $this->subjectsRepository->update($request->all(), $id);

        Flash::success('Subjects updated successfully.');

        return redirect(route('subjects.index'));
    }

    /**
     * Remove the specified Subjects from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $subjects = $this->subjectsRepository->findWithoutFail($id);

        if (empty($subjects)) {
            Flash::error('Subjects not found');

            return redirect(route('subjects.index'));
        }

        $this->subjectsRepository->delete($id);

        Flash::success('Subjects deleted successfully.');

        return redirect(route('subjects.index'));
    }
}
