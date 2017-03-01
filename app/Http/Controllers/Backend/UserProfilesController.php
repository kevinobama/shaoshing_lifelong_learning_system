<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\Backend\CreateUserProfilesRequest;
use App\Http\Requests\Backend\UpdateUserProfilesRequest;
use App\Repositories\Backend\UserProfilesRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class UserProfilesController extends AppBaseController
{
    /** @var  UserProfilesRepository */
    private $userProfilesRepository;

    public function __construct(UserProfilesRepository $userProfilesRepo)
    {
        $this->middleware('auth');
        $this->userProfilesRepository = $userProfilesRepo;
    }

    /**
     * Display a listing of the UserProfiles.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->userProfilesRepository->pushCriteria(new RequestCriteria($request));
        $userProfiles = $this->userProfilesRepository->all();

        return view('backend.user_profiles.index')
            ->with('userProfiles', $userProfiles);
    }

    /**
     * Show the form for creating a new UserProfiles.
     *
     * @return Response
     */
    public function create()
    {
        return view('backend.user_profiles.create');
    }

    /**
     * Store a newly created UserProfiles in storage.
     *
     * @param CreateUserProfilesRequest $request
     *
     * @return Response
     */
    public function store(CreateUserProfilesRequest $request)
    {
        $input = $request->all();

        $userProfiles = $this->userProfilesRepository->create($input);

        Flash::success('User Profiles saved successfully.');

        return redirect(route('backend.userProfiles.index'));
    }

    /**
     * Display the specified UserProfiles.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $userProfiles = $this->userProfilesRepository->findWithoutFail($id);

        if (empty($userProfiles)) {
            Flash::error('User Profiles not found');

            return redirect(route('backend.userProfiles.index'));
        }

        return view('backend.user_profiles.show')->with('userProfiles', $userProfiles);
    }

    /**
     * Show the form for editing the specified UserProfiles.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $userProfiles = $this->userProfilesRepository->findWithoutFail($id);

        if (empty($userProfiles)) {
            Flash::error('User Profiles not found');

            return redirect(route('backend.userProfiles.index'));
        }

        return view('backend.user_profiles.edit')->with('userProfiles', $userProfiles);
    }

    /**
     * Update the specified UserProfiles in storage.
     *
     * @param  int              $id
     * @param UpdateUserProfilesRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateUserProfilesRequest $request)
    {
        $userProfiles = $this->userProfilesRepository->findWithoutFail($id);

        if (empty($userProfiles)) {
            Flash::error('User Profiles not found');

            return redirect(route('backend.userProfiles.index'));
        }

        $userProfiles = $this->userProfilesRepository->update($request->all(), $id);

        Flash::success('User Profiles updated successfully.');

        return redirect(route('backend.userProfiles.index'));
    }

    /**
     * Remove the specified UserProfiles from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $userProfiles = $this->userProfilesRepository->findWithoutFail($id);

        if (empty($userProfiles)) {
            Flash::error('User Profiles not found');

            return redirect(route('backend.userProfiles.index'));
        }

        $this->userProfilesRepository->delete($id);

        Flash::success('User Profiles deleted successfully.');

        return redirect(route('backend.userProfiles.index'));
    }
}
