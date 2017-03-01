<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class Roles
 * @package App\Models\Backen
 * @version November 21, 2016, 3:20 am UTC
 */
class Role extends Model
{


    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';



    public $fillable = [
        'name'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    /**
     * The Role belongs to the User.
     */
    public function users()
    {
        return $this->belongsToMany('App\Models\User', 'RolesUser');// check if edu needed
    }
}
