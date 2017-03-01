<?php

namespace App\Repositories\Backend;

use App\Models\CourseComment;
use InfyOm\Generator\Common\BaseRepository;

class CourseCommentsRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'course_id',
        'user_id',
        'user_name',
        'content'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return CourseComment::class;
    }
}
