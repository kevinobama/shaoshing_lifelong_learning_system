<?php

namespace App\Repositories\Backend;

use App\Models\User;
use InfyOm\Generator\Common\BaseRepository;

class UsersRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'email',
        'password',
        'remember_token'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return User::class;
    }
}
