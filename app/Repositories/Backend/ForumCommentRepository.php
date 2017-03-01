<?php

namespace App\Repositories\Backend;

use App\Models\ForumComment;
use InfyOm\Generator\Common\BaseRepository;

class ForumCommentRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'post_id',
        'user_id',
        'content'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return ForumComment::class;
    }
}
