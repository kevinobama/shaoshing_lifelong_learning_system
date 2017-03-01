<?php

namespace App\Repositories\Backend;

use App\Models\Advertisement;
use InfyOm\Generator\Common\BaseRepository;

class AdvertisementsRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'priority',
        'image_link',
        'redirect_link',
        'content',
        'click_count',
        'is_active'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Advertisement::class;
    }
}
