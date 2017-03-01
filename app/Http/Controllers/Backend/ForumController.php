<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\Backend\CreateForumRequest;
use App\Http\Requests\Backend\UpdateForumRequest;
use App\Models\Forum;
use App\Repositories\Backend\ForumRepository;
use Flash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Storage;
use Response;

class ForumController extends AppBaseController
{
    /** @var  ForumRepository */
    private $forumRepository;

    public function __construct(ForumRepository $forumRepo)
    {
        $this->middleware('auth');
        $this->forumRepository = $forumRepo;
    }

    /**
     * Display a listing of the Forum.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $forums = Forum::select('id', 'name', 'cover', 'updated_at')
                       ->withCount('members')
                       ->withCount('posts')
                       ->withCount('comments')
                       ->orderBy('is_top', 'desc')
                       ->orderBy('updated_at', 'desc')
                       ->paginate(20);

        $mediaHost = Config::get('shaoshing_lifelong_learning_system.media_host');
        return view('backend.forums.index')->with('forums', $forums)->with('mediaHost', $mediaHost);
    }

    /**
     * Show the form for creating a new Forum.
     *
     * @return Response
     */
    public function create()
    {
        return view('backend.forums.create');
    }

    /**
     * Store a newly created Forum in storage.
     *
     * @param CreateForumRequest $request
     *
     * @return Response
     */
    public function store(CreateForumRequest $request)
    {
        $input = $request->all();
        $file  = $request->file('cover');
        if ($file !== null) {
            $filepath = Config::get('shaoshing_lifelong_learning_system.uploads.forums_cover');
            $path = Config::get('shaoshing_lifelong_learning_system.media_path') . $filepath;
            if (!is_dir($path)) {
                Storage::makeDirectory($path, 0775, true);
            }
            $filename      = sha1($file->getClientOriginalName() . microtime(true)) . '.' . $file->getClientOriginalExtension();

            $file->move($path, $filename);
            $input['cover'] = $filepath . $filename;
        }
        $input['is_top'] = 1;

        $this->forumRepository->create($input);

        Flash::success('Forum saved successfully.');

        return redirect(route('backend.forums.index'));
    }

    /**
     * Display the specified Forum.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $forum = $this->forumRepository->findWithoutFail($id);

        if (empty($forum)) {
            Flash::error('Forum not found');

            return redirect(route('backend.forums.index'));
        }

        return view('backend.forums.show')->with('forum', $forum);
    }

    /**
     * Show the form for editing the specified Forum.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $forum = $this->forumRepository->findWithoutFail($id);

        if (empty($forum)) {
            Flash::error('Forum not found');

            return redirect(route('backend.forums.index'));
        }

        return view('backend.forums.edit')->with('forum', $forum);
    }

    /**
     * Update the specified Forum in storage.
     *
     * @param  int $id
     * @param UpdateForumRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateForumRequest $request)
    {
        $forum = $this->forumRepository->findWithoutFail($id);

        if (empty($forum)) {
            Flash::error('Forum not found');

            return redirect(route('backend.forums.index'));
        }
        $input = $request->all();
        $file  = $request->file('cover');
        if ($file !== null) {
            $filepath = Config::get('shaoshing_lifelong_learning_system.uploads.forums_cover');
            $path = Config::get('shaoshing_lifelong_learning_system.media_path') . $filepath;
            if (!is_dir($path)) {
                Storage::makeDirectory($path, 0775, true);
            }
            $filename      = sha1($file->getClientOriginalName() . microtime(true)) . '.' . $file->getClientOriginalExtension();

            $file->move($path, $filename);
            $input['cover'] = $filepath . $filename;
        }
        $forum = $this->forumRepository->update($input, $id);

        Flash::success('Forum updated successfully.');

        return redirect(route('backend.forums.index'));
    }

    /**
     * Remove the specified Forum from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $forum = $this->forumRepository->findWithoutFail($id);

        if (empty($forum)) {
            Flash::error('Forum not found');

            return redirect(route('backend.forums.index'));
        }

        $this->forumRepository->delete($id);

        Flash::success('Forum deleted successfully.');

        return redirect(route('backend.forums.index'));
    }
}
