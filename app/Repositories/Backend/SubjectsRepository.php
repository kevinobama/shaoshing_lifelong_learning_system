<?php

namespace App\Repositories\Backend;

use App\Models\Subject;
use InfyOm\Generator\Common\BaseRepository;

class SubjectsRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'name_en',
        'position',
        'module',
        'upaated_at'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Subject::class;
    }
}
