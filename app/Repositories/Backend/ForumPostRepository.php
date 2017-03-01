<?php

namespace App\Repositories\Backend;

use App\Models\ForumPost;
use InfyOm\Generator\Common\BaseRepository;

class ForumPostRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'forum_id',
        'user_id',
        'title',
        'content'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return ForumPost::class;
    }
}
