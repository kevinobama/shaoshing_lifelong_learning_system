<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\Backend\CreateForumPostRequest;
use App\Http\Requests\Backend\UpdateForumPostRequest;
use App\Models\Forum;
use App\Models\ForumPost;
use App\Repositories\Backend\ForumPostRepository;
use Flash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Response;

class ForumPostController extends AppBaseController
{
    /** @var  ForumPostRepository */
    private $forumPostRepository;

    public function __construct(ForumPostRepository $forumPostRepo)
    {
        $this->middleware('auth');
        $this->forumPostRepository = $forumPostRepo;
    }

    /**
     * Display a listing of the ForumPost.
     *
     * @param Request $request
     * @return Response
     */
    public function index($forum_id)
    {
        $forum      = Forum::select('id', 'name', 'desc', 'cover')
                           ->withCount('members')
                           ->withCount('posts')
                           ->withCount('comments')
                           ->where('id', $forum_id)
                           ->first();
        $mediaHost  = Config::get('shaoshing_lifelong_learning_system.media_host');
        $forumPosts = ForumPost::select('id', 'forum_id', 'user_id', 'title', 'content', 'created_at', 'updated_at')
                               ->with([
                                   'user' => function ($query) {
                                       $query->select('id', 'name')->with([
                                           'profile' => function ($query) {
                                               $query->select('user_id', 'avatar');
                                           }
                                       ]);
                                   }
                               ])
                               ->withCount('likes')
                               ->withCount('comments')
                               ->with([
                                   'attachments' => function ($query) use ($mediaHost) {
                                       $query->select('id', 'post_id', DB::raw('concat("' . $mediaHost . '",filename) filename'));
                                   }
                               ])
                               ->where('forum_id', $forum_id)
                               ->orderBy('updated_at', 'desc')
                               ->paginate(20);


        return view('backend.forum_posts.index')->with('forum', $forum)->with('forumPosts', $forumPosts);
    }

    /**
     * Show the form for creating a new ForumPost.
     *
     * @return Response
     */
    public function create()
    {
        return view('backend.forum_posts.create');
    }

    /**
     * Store a newly created ForumPost in storage.
     *
     * @param CreateForumPostRequest $request
     *
     * @return Response
     */
    public function store(CreateForumPostRequest $request)
    {
        $input = $request->all();

        $forumPost = $this->forumPostRepository->create($input);

        Flash::success('Forum Post saved successfully.');

        return redirect(route('backend.forumPosts.index'));
    }

    /**
     * Display the specified ForumPost.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $forumPost = $this->forumPostRepository->findWithoutFail($id);

        if (empty($forumPost)) {
            Flash::error('Forum Post not found');

            return redirect(route('backend.forumPosts.index'));
        }

        return view('backend.forum_posts.show')->with('forumPost', $forumPost);
    }

    /**
     * Show the form for editing the specified ForumPost.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $forumPost = $this->forumPostRepository->findWithoutFail($id);

        if (empty($forumPost)) {
            Flash::error('Forum Post not found');

            return redirect(route('backend.forumPosts.index'));
        }

        return view('backend.forum_posts.edit')->with('forumPost', $forumPost);
    }

    /**
     * Update the specified ForumPost in storage.
     *
     * @param  int $id
     * @param UpdateForumPostRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateForumPostRequest $request)
    {
        $forumPost = $this->forumPostRepository->findWithoutFail($id);

        if (empty($forumPost)) {
            Flash::error('Forum Post not found');

            return redirect(route('backend.forumPosts.index'));
        }

        $forumPost = $this->forumPostRepository->update($request->all(), $id);

        Flash::success('Forum Post updated successfully.');

        return redirect(route('backend.forumPosts.index'));
    }

    /**
     * Remove the specified ForumPost from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $forumPost = $this->forumPostRepository->findWithoutFail($id);

        if (empty($forumPost)) {
            Flash::error('Forum Post not found');

            return redirect(route('backend.forumPosts.index'));
        }

        $this->forumPostRepository->delete($id);

        Flash::success('Forum Post deleted successfully.');

        return redirect(route('backend.forumPosts.index', $forumPost['forum_id']));
    }
}
