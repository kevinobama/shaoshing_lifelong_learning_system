<?php

namespace App\Repositories\Backend;

use App\Models\UserCheckin;
use InfyOm\Generator\Common\BaseRepository;

class UserCheckinsRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'user_id',
        'signed_date_time',
        'signed_days'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return UserCheckin::class;
    }
}
