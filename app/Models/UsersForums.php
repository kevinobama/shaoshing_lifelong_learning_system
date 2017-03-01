<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Support\Facades\DB;
use Traits\TableName;

/**
 * Class UsersForums
 * @package App\Models
 * @version November 29, 2016, 9:14 am CST
 */
class UsersForums extends Model
{
    use TableName;

    public $fillable = [
        'user_id',
        'forum_id',
        'last_read_at'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'user_id' => 'integer',
        'forum_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [

    ];

    public function forum()
    {
        return $this->belongsTo('App\Models\Forum', 'forum_id');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function newPosts()
    {
        return $this->hasMany('App\Models\ForumPost', 'forum_id', 'forum_id')
                    ->where('forum_posts.created_at', '>', DB::raw('edu_users_forums.last_read_at'));
    }
}
