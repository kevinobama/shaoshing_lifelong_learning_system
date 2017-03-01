<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\Backend\CreateReportsRequest;
use App\Http\Requests\Backend\UpdateReportsRequest;
use App\Repositories\Backend\ReportsRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class ReportsController extends AppBaseController
{
    /** @var  ReportsRepository */
    private $reportsRepository;

    public function __construct(ReportsRepository $reportsRepo)
    {
        $this->middleware('auth');
        $this->reportsRepository = $reportsRepo;
    }

    /**
     * Display a listing of the Reports.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->reportsRepository->pushCriteria(new RequestCriteria($request));
        $reports = $this->reportsRepository->all();

        return view('backend.reports.index')
            ->with('reports', $reports);
    }

    /**
     * Show the form for creating a new Reports.
     *
     * @return Response
     */
    public function create()
    {
        return view('backend.reports.create');
    }

    /**
     * Store a newly created Reports in storage.
     *
     * @param CreateReportsRequest $request
     *
     * @return Response
     */
    public function store(CreateReportsRequest $request)
    {
        $input = $request->all();

        $reports = $this->reportsRepository->create($input);

        Flash::success('Reports saved successfully.');

        return redirect(route('backend.reports.index'));
    }

    /**
     * Display the specified Reports.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $reports = $this->reportsRepository->findWithoutFail($id);

        if (empty($reports)) {
            Flash::error('Reports not found');

            return redirect(route('backend.reports.index'));
        }

        return view('backend.reports.show')->with('reports', $reports);
    }

    /**
     * Show the form for editing the specified Reports.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $reports = $this->reportsRepository->findWithoutFail($id);

        if (empty($reports)) {
            Flash::error('Reports not found');

            return redirect(route('backend.reports.index'));
        }

        return view('backend.reports.edit')->with('reports', $reports);
    }

    /**
     * Update the specified Reports in storage.
     *
     * @param  int              $id
     * @param UpdateReportsRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateReportsRequest $request)
    {
        $reports = $this->reportsRepository->findWithoutFail($id);

        if (empty($reports)) {
            Flash::error('Reports not found');

            return redirect(route('backend.reports.index'));
        }

        $reports = $this->reportsRepository->update($request->all(), $id);

        Flash::success('Reports updated successfully.');

        return redirect(route('backend.reports.index'));
    }

    /**
     * Remove the specified Reports from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $reports = $this->reportsRepository->findWithoutFail($id);

        if (empty($reports)) {
            Flash::error('Reports not found');

            return redirect(route('backend.reports.index'));
        }

        $this->reportsRepository->delete($id);

        Flash::success('Reports deleted successfully.');

        return redirect(route('backend.reports.index'));
    }
}
