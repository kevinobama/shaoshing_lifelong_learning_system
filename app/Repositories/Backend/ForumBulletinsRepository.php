<?php

namespace App\Repositories\Backend;

use App\Models\ForumBulletin;
use InfyOm\Generator\Common\BaseRepository;

class ForumBulletinsRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'title',
        'forum_id',
        'forum_name'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return ForumBulletin::class;
    }
}
