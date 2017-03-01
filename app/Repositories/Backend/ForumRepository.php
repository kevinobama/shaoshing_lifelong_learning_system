<?php

namespace App\Repositories\Backend;

use App\Models\Forum;
use InfyOm\Generator\Common\BaseRepository;

class ForumRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'desc',
        'cover'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Forum::class;
    }
}
