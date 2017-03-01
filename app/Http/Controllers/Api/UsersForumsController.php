<?php

namespace App\Http\Controllers\Api;

use App\Helpers\Utility;
use App\Http\Controllers\Controller;
use App\Models\Forum;
use App\Models\UsersForums;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;

class UsersForumsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $topForums = Forum::where('is_top', 1)->pluck('id');
            $userId    = Auth::user()->id;
            $hasForums = UsersForums::where('user_id', $userId)->whereIn('forum_id', $topForums)->pluck('forum_id');
            $yetForums = array_diff($topForums->toArray(), $hasForums->toArray());
            $data      = [];
            foreach ($yetForums as $yetForum) {
                $data[] = [
                    'user_id' => $userId,
                    'forum_id' => $yetForum
                ];
            }
            if (count($data) > 0) {
                UsersForums::insert($data);
            }
            $forums    = UsersForums::select('forum_id', UsersForums::tableName() . '.created_at', 'last_read_at')
                                    ->with([
                                        'forum' => function ($query) {
                                            $query->select('id', 'name', 'desc', 'cover')
                                                  ->withCount('members')
                                                  ->withCount('posts')
                                                  ->withCount('comments');
                                        }
                                    ])
                                    ->withCount('newPosts')
                                    ->join(Forum::tableName(), Forum::tableName() . '.id', '=', UsersForums::tableName() . '.forum_id')
                                    ->where('user_id', $userId)
                                    ->whereNull(Forum::tableName() . '.deleted_at')
                                    ->orderBy('is_top', 'desc')
                                    ->orderBy(Forum::tableName() . '.updated_at', 'desc')
                                    ->paginate(20);
            $forums    = Utility::cleanPage($forums);
            $mediaHost = Config::get('shaoshing_lifelong_learning_system.media_host');
            foreach ($forums['data'] as &$forum) {
                if (strpos($forum['forum']['cover'], '/') === 0) {
                    $forum['forum']['cover'] = $mediaHost . $forum['forum']['cover'];
                }
            }
            return response()->json($forums, 200, [], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        } catch (\InvalidArgumentException $exception) {
            return response()->json(['error' => 'No Content'], 204);
        }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $member = new UsersForums($request->input());
        $member->setAttribute('user_id', Auth::user()->id);
        $member->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($forum_id)
    {
        UsersForums::where([['forum_id', $forum_id], ['user_id', Auth::user()->id]])->delete();
    }
}
