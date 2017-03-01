<?php

namespace App\Repositories\Backend;

use App\Models\Book;
use InfyOm\Generator\Common\BaseRepository;

class BooksRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'title',
        'author',
        'subject_id',
        'price',
        'download_count',
        'download_url',
        'filesize',
        'cover_image_url',
        'forum_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Book::class;
    }
}
