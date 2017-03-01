<?php

namespace App\Repositories\Backend;

use App\Models\UserProfile;
use InfyOm\Generator\Common\BaseRepository;

class UserProfilesRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'gender',
        'avatar',
        'real_name',
        'nick_name',
        'coin',
        'level'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return UserProfile::class;
    }
}
