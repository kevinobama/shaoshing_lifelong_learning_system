<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\Backend\CreateUserCheckinsRequest;
use App\Http\Requests\Backend\UpdateUserCheckinsRequest;
use App\Repositories\Backend\UserCheckinsRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class UserCheckinsController extends AppBaseController
{
    /** @var  UserCheckinsRepository */
    private $userCheckinsRepository;

    public function __construct(UserCheckinsRepository $userCheckinsRepo)
    {
        $this->middleware('auth');
        $this->userCheckinsRepository = $userCheckinsRepo;
    }

    /**
     * Display a listing of the UserCheckins.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->userCheckinsRepository->pushCriteria(new RequestCriteria($request));
        $userCheckins = $this->userCheckinsRepository->all();

        return view('backend.user_checkins.index')
            ->with('userCheckins', $userCheckins);
    }

    /**
     * Show the form for creating a new UserCheckins.
     *
     * @return Response
     */
    public function create()
    {
        return view('backend.user_checkins.create');
    }

    /**
     * Store a newly created UserCheckins in storage.
     *
     * @param CreateUserCheckinsRequest $request
     *
     * @return Response
     */
    public function store(CreateUserCheckinsRequest $request)
    {
        $input = $request->all();

        $userCheckins = $this->userCheckinsRepository->create($input);

        Flash::success('User Checkins saved successfully.');

        return redirect(route('backend.userCheckins.index'));
    }

    /**
     * Display the specified UserCheckins.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $userCheckins = $this->userCheckinsRepository->findWithoutFail($id);

        if (empty($userCheckins)) {
            Flash::error('User Checkins not found');

            return redirect(route('backend.userCheckins.index'));
        }

        return view('backend.user_checkins.show')->with('userCheckins', $userCheckins);
    }

    /**
     * Show the form for editing the specified UserCheckins.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $userCheckins = $this->userCheckinsRepository->findWithoutFail($id);

        if (empty($userCheckins)) {
            Flash::error('User Checkins not found');

            return redirect(route('backend.userCheckins.index'));
        }

        return view('backend.user_checkins.edit')->with('userCheckins', $userCheckins);
    }

    /**
     * Update the specified UserCheckins in storage.
     *
     * @param  int              $id
     * @param UpdateUserCheckinsRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateUserCheckinsRequest $request)
    {
        $userCheckins = $this->userCheckinsRepository->findWithoutFail($id);

        if (empty($userCheckins)) {
            Flash::error('User Checkins not found');

            return redirect(route('backend.userCheckins.index'));
        }

        $userCheckins = $this->userCheckinsRepository->update($request->all(), $id);

        Flash::success('User Checkins updated successfully.');

        return redirect(route('backend.userCheckins.index'));
    }

    /**
     * Remove the specified UserCheckins from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $userCheckins = $this->userCheckinsRepository->findWithoutFail($id);

        if (empty($userCheckins)) {
            Flash::error('User Checkins not found');

            return redirect(route('backend.userCheckins.index'));
        }

        $this->userCheckinsRepository->delete($id);

        Flash::success('User Checkins deleted successfully.');

        return redirect(route('backend.userCheckins.index'));
    }
}
