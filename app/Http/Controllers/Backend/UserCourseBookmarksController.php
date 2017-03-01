<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\Backend\CreateUserCourseBookmarksRequest;
use App\Http\Requests\Backend\UpdateUserCourseBookmarksRequest;
use App\Repositories\Backend\UserCourseBookmarksRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class UserCourseBookmarksController extends AppBaseController
{
    /** @var  UserCourseBookmarksRepository */
    private $userCourseBookmarksRepository;

    public function __construct(UserCourseBookmarksRepository $userCourseBookmarksRepo)
    {
        $this->middleware('auth');
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
        $this->userCourseBookmarksRepository->pushCriteria(new RequestCriteria($request));
        $userCourseBookmarks = $this->userCourseBookmarksRepository->all();

        return view('backend.user_course_bookmarks.index')
            ->with('userCourseBookmarks', $userCourseBookmarks);
    }

    /**
     * Show the form for creating a new UserCourseBookmarks.
     *
     * @return Response
     */
    public function create()
    {
        return view('backend.user_course_bookmarks.create');
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
        $input = $request->all();

        $userCourseBookmarks = $this->userCourseBookmarksRepository->create($input);

        Flash::success('User Course Bookmarks saved successfully.');

        return redirect(route('backend.userCourseBookmarks.index'));
    }

    /**
     * Display the specified UserCourseBookmarks.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $userCourseBookmarks = $this->userCourseBookmarksRepository->findWithoutFail($id);

        if (empty($userCourseBookmarks)) {
            Flash::error('User Course Bookmarks not found');

            return redirect(route('backend.userCourseBookmarks.index'));
        }

        return view('backend.user_course_bookmarks.show')->with('userCourseBookmarks', $userCourseBookmarks);
    }

    /**
     * Show the form for editing the specified UserCourseBookmarks.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $userCourseBookmarks = $this->userCourseBookmarksRepository->findWithoutFail($id);

        if (empty($userCourseBookmarks)) {
            Flash::error('User Course Bookmarks not found');

            return redirect(route('backend.userCourseBookmarks.index'));
        }

        return view('backend.user_course_bookmarks.edit')->with('userCourseBookmarks', $userCourseBookmarks);
    }

    /**
     * Update the specified UserCourseBookmarks in storage.
     *
     * @param  int              $id
     * @param UpdateUserCourseBookmarksRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateUserCourseBookmarksRequest $request)
    {
        $userCourseBookmarks = $this->userCourseBookmarksRepository->findWithoutFail($id);

        if (empty($userCourseBookmarks)) {
            Flash::error('User Course Bookmarks not found');

            return redirect(route('backend.userCourseBookmarks.index'));
        }

        $userCourseBookmarks = $this->userCourseBookmarksRepository->update($request->all(), $id);

        Flash::success('User Course Bookmarks updated successfully.');

        return redirect(route('backend.userCourseBookmarks.index'));
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
            Flash::error('User Course Bookmarks not found');

            return redirect(route('backend.userCourseBookmarks.index'));
        }

        $this->userCourseBookmarksRepository->delete($id);

        Flash::success('User Course Bookmarks deleted successfully.');

        return redirect(route('backend.userCourseBookmarks.index'));
    }
}
