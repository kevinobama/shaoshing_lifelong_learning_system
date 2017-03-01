<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\Backend\CreateForumCommentRequest;
use App\Http\Requests\Backend\UpdateForumCommentRequest;
use App\Models\Forum;
use App\Models\ForumComment;
use App\Models\ForumPost;
use App\Repositories\Backend\ForumCommentRepository;
use Flash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Response;

class ForumCommentController extends AppBaseController
{
    /** @var  ForumCommentRepository */
    private $forumCommentRepository;

    public function __construct(ForumCommentRepository $forumCommentRepo)
    {
        $this->middleware('auth');
        $this->forumCommentRepository = $forumCommentRepo;
    }

    /**
     * Display a listing of the ForumComment.
     *
     * @param Request $request
     * @return Response
     */
    public function index($post_id, $column = 'created_at', $direction = 'desc')
    {
        $mediaHost     = Config::get('shaoshing_lifelong_learning_system.media_host');
        $post          = ForumPost::select('id', 'forum_id', 'user_id', 'title', 'content')->with([
            'user' => function ($query) use ($mediaHost) {
                $query->select('id', 'name')->with([
                    'profile' => function ($query) use ($mediaHost) {
                        $query->select('user_id', DB::raw('concat("' . $mediaHost . '",avatar) avatar'));
                    }
                ]);
            },
            'attachments' => function ($query) use ($mediaHost) {
                $query->select('id', 'post_id', DB::raw('concat("' . $mediaHost . '",filename) filename'));
            }
        ])->withCount('likes')->withCount('comments')->where('id', $post_id)->first();
        $forumComments = ForumComment::select('id', 'post_id', 'user_id', 'content', 'created_at', 'updated_at')->with([
            'user' => function ($query) {
                $query->select('id', 'name')->with([
                    'profile' => function ($query) {
                        $query->select('user_id', 'avatar');
                    }
                ]);
            }
        ])->where('post_id', $post_id)->orderBy($column, $direction)->paginate(20);
        $forum         = Forum::select('id', 'name', 'desc', 'cover')
                              ->withCount('members')
                              ->withCount('posts')
                              ->withCount('comments')
                              ->where('id', $post->forum_id)
                              ->first();
        if (strpos($forum['cover'], '/') === 0) {
            $forum['cover'] = $mediaHost . $forum['cover'];
        }
        return view('backend.forum_comments.index')
            ->with('forum', $forum)
            ->with('post', $post)
            ->with('forumComments', $forumComments);
    }

    /**
     * Show the form for creating a new ForumComment.
     *
     * @return Response
     */
    public function create()
    {
        return view('backend.forum_comments.create');
    }

    /**
     * Store a newly created ForumComment in storage.
     *
     * @param CreateForumCommentRequest $request
     *
     * @return Response
     */
    public function store(CreateForumCommentRequest $request)
    {
        $input = $request->all();

        $forumComment = $this->forumCommentRepository->create($input);

        Flash::success('Forum Comment saved successfully.');

        return redirect(route('backend.forumComments.index'));
    }

    /**
     * Display the specified ForumComment.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $forumComment = $this->forumCommentRepository->findWithoutFail($id);

        if (empty($forumComment)) {
            Flash::error('Forum Comment not found');

            return redirect(route('backend.forumComments.index'));
        }

        return view('backend.forum_comments.show')->with('forumComment', $forumComment);
    }

    /**
     * Show the form for editing the specified ForumComment.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $forumComment = $this->forumCommentRepository->findWithoutFail($id);

        if (empty($forumComment)) {
            Flash::error('Forum Comment not found');

            return redirect(route('backend.forumComments.index'));
        }

        return view('backend.forum_comments.edit')->with('forumComment', $forumComment);
    }

    /**
     * Update the specified ForumComment in storage.
     *
     * @param  int              $id
     * @param UpdateForumCommentRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateForumCommentRequest $request)
    {
        $forumComment = $this->forumCommentRepository->findWithoutFail($id);

        if (empty($forumComment)) {
            Flash::error('Forum Comment not found');

            return redirect(route('backend.forumComments.index'));
        }

        $forumComment = $this->forumCommentRepository->update($request->all(), $id);

        Flash::success('Forum Comment updated successfully.');

        return redirect(route('backend.forumComments.index'));
    }

    /**
     * Remove the specified ForumComment from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $forumComment = $this->forumCommentRepository->findWithoutFail($id);

        if (empty($forumComment)) {
            Flash::error('Forum Comment not found');

            return redirect(route('backend.forumComments.index'));
        }

        $this->forumCommentRepository->delete($id);

        Flash::success('Forum Comment deleted successfully.');

        return redirect(route('backend.forumComments.index'));
    }
}
