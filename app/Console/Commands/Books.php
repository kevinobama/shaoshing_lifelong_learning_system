<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Book;
use Config;
use ZipArchive;
use App\Helpers\ZipArchiveHelper;

class Books extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'Books:run';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Books';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     * php artisan Books:run
     * @return mixed
     */
    public function handle()
    {
        //
        $this->extractCoverImage();
    }

    public function extractCoverImage()
    {

        $book_covers_location = Config::get('shaoshing_lifelong_learning_system.uploads.book_covers_folder');
        $books = Book::all();

        foreach($books as $key => $book) {
            $bookFile = base_path() . '/public'.$book->download_url;
            $createTime = $timestamp = strtotime($book->created_at);

            $coverImage = base_path() . '/public'.$book_covers_location.$book->subject_id.'/'.$createTime.'/';

            ZipArchiveHelper::extractCoverImage($bookFile, $coverImage);
//            $zip = new ZipArchive;
//            if ($zip->open($bookfile) === TRUE) {
//                $zip->extractTo($coverImage, array('cover.jpeg'));
//                $zip->close();
//                echo 'ok:'.$coverImage.PHP_EOL;
//                echo($book->id.':'.date("Y-m-d H:i:s",$createTime)).PHP_EOL;
//            } else {
//                echo 'failed:'.$coverImage.PHP_EOL;
//            }
//            unset($zip);

            //$coverImageUrl = $book_covers_location.$book->subject_id.'/'.$createTime.'/'.'cover.jpeg';
            //$book->update(array('cover_image_url' => $coverImageUrl));
        }
    }

}
