<?php

namespace App\Http\Controllers\Api;

use App\Helpers\Utility;
use App\Http\Controllers\Controller;
use App\Models\BadWord;
use App\Models\ForumComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;

class ForumCommentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($post_id, $column = 'created_at', $direction = 'desc')
    {
        $mediaHost = Config::get('shaoshing_lifelong_learning_system.media_host');
        try {
            $comments = ForumComment::select('id', 'post_id', 'user_id', 'content', 'created_at', 'updated_at')->with([
                'user' => function ($query) use ($mediaHost) {
                    $query->select('id', 'name')->with([
                        'profile' => function ($query) use ($mediaHost) {
                            $query->select('user_id', 'avatar');
                        }
                    ]);
                }
            ])->where('post_id', $post_id)->orderBy($column, $direction)->paginate(20);
            $comments = Utility::cleanPage($comments);
            return response()->json($comments, 200, [], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
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
        $user_id = Auth::user()->id;
        $comment = new ForumComment($request->input());
        $comment->setAttribute('user_id', $user_id);
        $comment->setAttribute('content', BadWord::clean($request->input('content')));
        $comment->save();
        //$member = UsersForums::where([['forum_id', $comment->forum->id], ['user_id', $user_id]])->first();
        //if (null === $member) {
        //    $member = new UsersForums();
        //    $member->setAttribute('forum_id', $forum_id);
        //    $member->setAttribute('user_id', $user_id);
        //    $member->save();
        //}
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
        $comment   = ForumComment::select('id', 'post_id', 'user_id', 'content')->with([
            'user' => function ($query) use ($mediaHost) {
                $query->select('id', 'name')->with([
                    'profile' => function ($query) use ($mediaHost) {
                        $query->select('user_id', 'avatar');
                    }
                ]);
            }
        ])->where('id', $id)->first();
        return response()->json($comment, 200, [], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     */
    public function update(Request $request, $id)
    {
        $comment = ForumComment::where([['id', $id], ['user_id', Auth::user()->id]])->first();
        foreach ((array)$request->input() as $key => $value) {
            $comment->setAttribute($key, $value);
        }
        $comment->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     */
    public function destroy($id)
    {
        ForumComment::where([['id', $id], ['user_id', Auth::user()->id]])->delete();
    }
}
