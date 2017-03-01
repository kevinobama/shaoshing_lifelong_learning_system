<?php

namespace App\Repositories\Backend;

use App\Models\CourseChapter;
use InfyOm\Generator\Common\BaseRepository;

class CourseChaptersRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'course_id',
        'chapter_name'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return CourseChapter::class;
    }
}
