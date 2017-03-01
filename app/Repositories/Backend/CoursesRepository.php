<?php

namespace App\Repositories\Backend;

use App\Models\Course;
use InfyOm\Generator\Common\BaseRepository;

class CoursesRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'introduction',
        'type',
        'user_id',
        'user_name',
        'teacher_introduction',
        'cover_image',
        'comment_count'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Course::class;
    }
}
