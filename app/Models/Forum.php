<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Traits\TableName;

/**
 * Class Forum
 * @package App\Models
 * @version November 24, 2016, 1:53 pm CST
 */
class Forum extends Model
{
    use SoftDeletes;
    use TableName;

    public $fillable = [
        'name',
        'desc',
        'cover',
        'is_top'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'desc' => 'string',
        'cover' => 'string',
        'is_top' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    public function members()
    {
        return $this->hasMany('App\Models\UsersForums', 'forum_id');
    }

    public function posts()
    {
        return $this->hasMany('App\Models\ForumPost', 'forum_id');
    }

    public function comments()
    {
        return $this->hasManyThrough('App\Models\ForumComment', 'App\Models\ForumPost', 'forum_id', 'post_id');
    }
}
