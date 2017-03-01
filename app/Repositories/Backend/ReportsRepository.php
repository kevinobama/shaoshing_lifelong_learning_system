<?php

namespace App\Repositories\Backend;

use App\Models\Report;
use InfyOm\Generator\Common\BaseRepository;

class ReportsRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'user_id',
        'forum_id',
        'report_id',
        'report_module',
        'content'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Report::class;
    }
}
