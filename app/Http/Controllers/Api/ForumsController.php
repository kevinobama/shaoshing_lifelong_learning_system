<?php

namespace App\Http\Controllers\Api;

use App\Helpers\Utility;
use App\Http\Controllers\Controller;
use App\Models\Forum;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class ForumsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $forums    = Forum::select('id', 'name', 'desc', 'cover')
                              ->withCount('members')
                              ->withCount('posts')
                              ->withCount('comments')
                              ->orderBy('is_top', 'desc')
                              ->paginate(20);
            $forums    = Utility::cleanPage($forums);
            $mediaHost = Config::get('shaoshing_lifelong_learning_system.media_host');
            foreach ($forums['data'] as &$forum) {
                if (strpos($forum['cover'], '/') === 0) {
                    $forum['cover'] = $mediaHost . $forum['cover'];
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
        $forum = new Forum($request->input());
        $forum->save();
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
        $forum     = Forum::select('id', 'name', 'desc', 'cover')
                          ->withCount('members')
                          ->withCount('posts')
                          ->withCount('comments')
                          ->where('id', $id)
                          ->first();
        if (strpos($forum['cover'], '/') === 0) {
            $forum['cover'] = $mediaHost . $forum['cover'];
        }
        return response()->json($forum, 200, [], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
