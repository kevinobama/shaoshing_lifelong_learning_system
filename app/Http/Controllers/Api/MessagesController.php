<?php

namespace App\Http\Controllers\Api;

use App\Helpers\Utility;
use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class MessagesController extends Controller
{
    public function __construct()
    {
        if (array_key_exists('HTTP_AUTHORIZATION', $_SERVER) && !empty($_SERVER['HTTP_AUTHORIZATION'])) {
            $this->middleware('auth:api');
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($typeId = null, $isBanner = false)
    {
        try {
            $messages = Message::select('id', 'title', 'content', 'content_type', 'created_at', DB::raw('0 is_unread'))
                               ->when($typeId !== null, function ($query) use ($typeId) {
                                   return $query->where('type_id', $typeId);
                               })
                               ->where('is_banner', (int)$isBanner)
                               ->when($isBanner !== false, function ($query) {
                                   $host = Config::get('shaoshing_lifelong_learning_system.media_host');
                                   return $query->addSelect(DB::raw('IF(image IS NULL, "", concat("' . $host . '",image)) image'));
                               }, function ($query) {
                                   return $query->addSelect('type_id')->with([
                                       'type' => function ($query) {
                                           $query->select('id', 'name');
                                       }
                                   ]);
                               })
                               ->orderBy('created_at', 'desc')
                               ->paginate(20);
            $messages = Utility::cleanPage($messages);
            if (Auth::check()) {
                $messages = Utility::setUnread($messages, Auth::user()->id);
            }
            return response()->json($messages, 200, [], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        } catch (\InvalidArgumentException $exception) {
            return response()->json(['error' => 'No Content'], 204);
        }

    }

    public function banner()
    {
        return $this->index(null, true);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $message = Message::select('id', 'type_id', 'title', 'content', 'content_type', 'created_at')->with([
            'type' => function ($query) {
                $query->select('id', 'name');
            }
        ])->where('id', $id)->first();
        if (Auth::check()) {
            Utility::setRead($message, Auth::user()->id);
        }
        return response()->json($message, 200, [], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
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
