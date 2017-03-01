<?php

namespace App\Repositories\Backend;

use App\Models\UserCourseBookmark;
use InfyOm\Generator\Common\BaseRepository;

class UserCourseBookmarksRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'course_id',
        'user_id',
        'user_name'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return UserCourseBookmark::class;
    }
}
