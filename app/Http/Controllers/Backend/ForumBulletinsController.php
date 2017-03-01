<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\Backend\CreateForumBulletinsRequest;
use App\Http\Requests\Backend\UpdateForumBulletinsRequest;
use App\Repositories\Backend\ForumBulletinsRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class ForumBulletinsController extends AppBaseController
{
    /** @var  ForumBulletinsRepository */
    private $forumBulletinsRepository;

    public function __construct(ForumBulletinsRepository $forumBulletinsRepo)
    {
        $this->middleware('auth');
        $this->forumBulletinsRepository = $forumBulletinsRepo;
    }

    /**
     * Display a listing of the ForumBulletins.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->forumBulletinsRepository->pushCriteria(new RequestCriteria($request));
        $forumBulletins = $this->forumBulletinsRepository->all();

        return view('backend.forum_bulletins.index')
            ->with('forumBulletins', $forumBulletins);
    }

    /**
     * Show the form for creating a new ForumBulletins.
     *
     * @return Response
     */
    public function create()
    {
        return view('backend.forum_bulletins.create');
    }

    /**
     * Store a newly created ForumBulletins in storage.
     *
     * @param CreateForumBulletinsRequest $request
     *
     * @return Response
     */
    public function store(CreateForumBulletinsRequest $request)
    {
        $input = $request->all();

        $forumBulletins = $this->forumBulletinsRepository->create($input);

        Flash::success('Forum Bulletins saved successfully.');

        return redirect(route('backend.forumBulletins.index'));
    }

    /**
     * Display the specified ForumBulletins.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $forumBulletins = $this->forumBulletinsRepository->findWithoutFail($id);

        if (empty($forumBulletins)) {
            Flash::error('Forum Bulletins not found');

            return redirect(route('backend.forumBulletins.index'));
        }

        return view('backend.forum_bulletins.show')->with('forumBulletins', $forumBulletins);
    }

    /**
     * Show the form for editing the specified ForumBulletins.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $forumBulletins = $this->forumBulletinsRepository->findWithoutFail($id);

        if (empty($forumBulletins)) {
            Flash::error('Forum Bulletins not found');

            return redirect(route('backend.forumBulletins.index'));
        }

        return view('backend.forum_bulletins.edit')->with('forumBulletins', $forumBulletins);
    }

    /**
     * Update the specified ForumBulletins in storage.
     *
     * @param  int              $id
     * @param UpdateForumBulletinsRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateForumBulletinsRequest $request)
    {
        $forumBulletins = $this->forumBulletinsRepository->findWithoutFail($id);

        if (empty($forumBulletins)) {
            Flash::error('Forum Bulletins not found');

            return redirect(route('backend.forumBulletins.index'));
        }

        $forumBulletins = $this->forumBulletinsRepository->update($request->all(), $id);

        Flash::success('Forum Bulletins updated successfully.');

        return redirect(route('backend.forumBulletins.index'));
    }

    /**
     * Remove the specified ForumBulletins from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $forumBulletins = $this->forumBulletinsRepository->findWithoutFail($id);

        if (empty($forumBulletins)) {
            Flash::error('Forum Bulletins not found');

            return redirect(route('backend.forumBulletins.index'));
        }

        $this->forumBulletinsRepository->delete($id);

        Flash::success('Forum Bulletins deleted successfully.');

        return redirect(route('backend.forumBulletins.index'));
    }
}
