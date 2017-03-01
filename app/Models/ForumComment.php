<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Comment
 * @package App\Models
 * @version November 22, 2016, 4:51 am UTC
 * @property integer $id
 * @property integer $post_id
 * @property integer $user_id
 * @property string $content
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 */
class ForumComment extends Model
{
    use SoftDeletes;

    public function __construct(array $attributes = [])
    {
        $this->fillable = [
            'post_id',
            'user_id',
            'content'
        ];
        $this->casts    = [
            'id' => 'integer',
            'post_id' => 'integer',
            'user_id' => 'integer',
            'content' => 'string'
        ];
        $this->touches  = ['post'];
        parent::__construct($attributes);
    }

    public function post()
    {
        return $this->belongsTo('App\Models\ForumPost');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function forum()
    {
        return $this->post->forum();
    }
}
