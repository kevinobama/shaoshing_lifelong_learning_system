<?php

namespace App\Repositories\Backend;

use App\Models\CourseFile;
use InfyOm\Generator\Common\BaseRepository;

class CourseFilesRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'course_chapter_id',
        'lesson_name',
        'url',
        'type',
        'duration'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return CourseFile::class;
    }
}
