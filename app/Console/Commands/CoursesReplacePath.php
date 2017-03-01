<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Course;
use App\Models\CourseFile;
use Config;

class CoursesReplacePath extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'CoursesReplacePath:run';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Courses Replace Path';

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
     * php artisan CoursesReplacePath:run
     * @return mixed
     */
    public function handle()
    {
        //$this->coverImage();
        echo('success');
    }

    public function coverImage()
    {
        //$courseCoverImage = Config::get('shaoshing_lifelong_learning_system.uploads.courseCoverImage');
        $courses = Course::all();
        foreach($courses as $key => $course) {
            //$coverImage  = '/uploads/courses/files/'.$course->cover_image;
            $coverImage  = str_replace("/uploads/courses/files/","/uploads/courses/coverImages/",$course->cover_image);
            $course->update(array('cover_image' => $coverImage));
        }
    }

    public function courseUrl()
    {
        $coursefiles = Config::get('shaoshing_lifelong_learning_system.uploads.coursefiles');

        $courseFiles = CourseFile::all();
        foreach($courseFiles as $key => $courseFile) {
            $url  = $coursefiles.$courseFile->url;
            $courseFile->update(array('url' => $url));
        }
    }
}
