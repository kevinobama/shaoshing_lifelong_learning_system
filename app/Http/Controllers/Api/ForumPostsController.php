<?php

namespace App\Http\Controllers\Api;

use App\Helpers\Utility;
use App\Http\Controllers\Controller;
use App\Models\BadWord;
use App\Models\ForumAttachment;
use App\Models\ForumPost;
use App\Models\UsersForums;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ForumPostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($forum_id, $column = 'updated_at', $direction = 'desc')
    {
        $mediaHost = Config::get('shaoshing_lifelong_learning_system.media_host');
        try {
            $posts = ForumPost::select('id', 'forum_id', 'user_id', 'title', 'content', 'created_at', 'updated_at')
                              ->with([
                                  'user' => function ($query) use ($mediaHost) {
                                      $query->select('id', 'name')->with([
                                          'profile' => function ($query) use ($mediaHost) {
                                              $query->select('user_id', 'avatar');
                                          }
                                      ]);
                                  },
                                  'isLike' => function ($query) {
                                      $query->select('post_id')->where('forum_likes.user_id', Auth::user()->id);
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
                              ->orderBy($column, $direction)
                              ->paginate(20);
            $posts = Utility::cleanPage($posts);
            if (null !== Auth::user()) {
                $record = UsersForums::where(['user_id' => Auth::user()->id], ['forum_id' => $forum_id])->first();
                $record->setAttribute('last_read_at', Carbon::now()->format('Y-m-d H:i:s'));
                $record->save();
            }
            return response()->json($posts, 200, [], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        } catch (\InvalidArgumentException $exception) {
            return response()->json(['error' => 'No Content'], 204);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     */
    public function store(Request $request)
    {
        $userId = Auth::user()->id;
        $post   = new ForumPost($request->input());
        $post->setAttribute('user_id', $userId);
        $post->setAttribute('content', BadWord::clean($request->input('content')));
        $post->save();
        $this->storeFile($request, $request->input('forum_id'), $post->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $mediaHost = Config::get('shaoshing_lifelong_learning_system.media_host');
        $post      = ForumPost::select('id', 'forum_id', 'user_id', 'title', 'content')->with([
            'user' => function ($query) use ($mediaHost) {
                $query->select('id', 'name')->with([
                    'profile' => function ($query) use ($mediaHost) {
                        $query->select('user_id', 'avatar');
                    }
                ]);
            },
            'attachments' => function ($query) use ($mediaHost) {
                $query->select('id', 'post_id', DB::raw('concat("' . $mediaHost . '",filename) filename'));
            }
        ])->withCount('likes')->withCount('comments')->where('id', $id)->first();
        return response()->json($post, 200, [], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     */
    public function update(Request $request, $id)
    {
        $post = ForumPost::where([['id', $id], ['user_id', Auth::user()->id]])->first();
        foreach ((array)$request->input() as $key => $value) {
            $post->setAttribute($key, $value);
        }
        $post->save();
        $this->storeFile($request, $post->forum_id, $id);
    }

    /** Remove the specified attachment
     * @param $id
     * @author grg
     */
    public function remove($id)
    {
        ForumAttachment::where([['id', $id], ['user_id', Auth::user()->id]])->delete();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     */
    public function destroy($id)
    {
        ForumPost::where([['id', $id], ['user_id', Auth::user()->id]])->delete();
    }

    private function storeFile(Request $request, $forumId, $postId)
    {
        $userId = Auth::user()->id;
        $files  = $request->file('img');
        if ($files !== null) {
            $filepath = Config::get('shaoshing_lifelong_learning_system.uploads.forums_attachments') . $forumId . '/' . $postId;
            $path = Config::get('shaoshing_lifelong_learning_system.media_path') . $filepath;
            if (!is_dir($path)) {
                Storage::makeDirectory($path, 0775, true);
            }
            $attachments = [];
            foreach ($files as $file) {
                $filename      = sha1($file->getClientOriginalName() . microtime(true)) . '.' . $file->getClientOriginalExtension();
                $attachments[] = [
                    'user_id' => $userId,
                    'post_id' => $postId,
                    'filename' => $filepath . '/' . $filename,
                    'filesize' => $file->getSize()
                ];
                $file->move($path, $filename);
            }
            if (count($attachments) > 0) {
                ForumAttachment::insert($attachments);
            }
        }
    }
}
