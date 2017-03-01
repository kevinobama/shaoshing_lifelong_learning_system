<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Post
 * @package App\Models
 * @version November 22, 2016, 1:28 am UTC
 * @property integer $id
 * @property integer $forum_id
 * @property integer $user_id
 * @property string $title
 * @property string $content
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 */
class ForumPost extends Model
{
    use SoftDeletes;

    public function __construct(array $attributes = [])
    {
        $this->fillable = [
            'forum_id',
            'user_id',
            'title',
            'content'
        ];
        $this->casts    = [
            'id' => 'integer',
            'forum_id' => 'integer',
            'user_id' => 'integer',
            'title' => 'string',
            'content' => 'string'
        ];
        parent::__construct($attributes);
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function forum()
    {
        return $this->belongsTo('App\Models\Forum');
    }

    public function likes()
    {
        return $this->hasMany('App\Models\ForumLike', 'post_id');
    }

    public function isLike()
    {
        return $this->likes();
    }

    public function comments()
    {
        return $this->hasMany('App\Models\ForumComment', 'post_id');
    }

    public function attachments()
    {
        return $this->hasMany('App\Models\ForumAttachment', 'post_id');
    }
}
