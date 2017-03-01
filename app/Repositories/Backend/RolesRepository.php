<?php

namespace App\Repositories\Backend;

use App\Models\Role;
use InfyOm\Generator\Common\BaseRepository;

class RolesRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Role::class;
    }
}
