<?php

namespace App\Repositories\Backend;

use App\Models\Message;
use InfyOm\Generator\Common\BaseRepository;

class MessageRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'title',
        'content',
        'content_type'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Message::class;
    }
}
