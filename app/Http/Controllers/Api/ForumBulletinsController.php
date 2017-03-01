<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Flash;
use Response;
use App\Helpers\Utility;
use App\Models\ForumBulletin;

class ForumBulletinsController extends Controller
{

    /**
     * Display a listing of the ForumBulletins.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $input = $request->all();
        $forumId= isset($input['forum_id']) ? $input['forum_id']: null;

        $forumBulletins = ForumBulletin::select('id', 'title', 'forum_id', 'forum_name')
            ->when($forumId, function ($query) use ($forumId) {
                return $query->where("forum_id",$forumId);
            })
            ->orderBy('id', 'DESC')
            ->paginate(50);

        return Utility::cleanPage($forumBulletins);
    }
}
