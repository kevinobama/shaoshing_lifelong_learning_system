<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

//Route::get('/', function () {
//    return view('welcome');
//});


Auth::routes();

Route::get('/', 'Frontend\HomeController@index');
Route::get('/home', 'HomeController@index');
Route::post('login', ['as' => 'signin', 'uses' => 'Auth\LoginController@doLogin']);
Route::get('frontend/home', ['as'=> 'frontend.homes.index', 'uses' => 'Frontend\HomeController@index']);

Route::get('backend/roles', ['as'=> 'backend.roles.index', 'uses' => 'Backend\RolesController@index']);
Route::post('backend/roles', ['as'=> 'backend.roles.store', 'uses' => 'Backend\RolesController@store']);
Route::get('backend/roles/create', ['as'=> 'backend.roles.create', 'uses' => 'Backend\RolesController@create']);
Route::put('backend/roles/{roles}', ['as'=> 'backend.roles.update', 'uses' => 'Backend\RolesController@update']);
Route::patch('backend/roles/{roles}', ['as'=> 'backend.roles.update', 'uses' => 'Backend\RolesController@update']);
Route::delete('backend/roles/{roles}', ['as'=> 'backend.roles.destroy', 'uses' => 'Backend\RolesController@destroy']);
Route::get('backend/roles/{roles}', ['as'=> 'backend.roles.show', 'uses' => 'Backend\RolesController@show']);
Route::get('backend/roles/{roles}/edit', ['as'=> 'backend.roles.edit', 'uses' => 'Backend\RolesController@edit']);



Route::get('backend/users', ['as'=> 'backend.users.index', 'uses' => 'Backend\UsersController@index']);
Route::post('backend/users', ['as'=> 'backend.users.store', 'uses' => 'Backend\UsersController@store']);
Route::get('backend/users/create', ['as'=> 'backend.users.create', 'uses' => 'Backend\UsersController@create']);
Route::put('backend/users/{users}', ['as'=> 'backend.users.update', 'uses' => 'Backend\UsersController@update']);
Route::patch('backend/users/{users}', ['as'=> 'backend.users.update', 'uses' => 'Backend\UsersController@update']);
Route::delete('backend/users/{users}', ['as'=> 'backend.users.destroy', 'uses' => 'Backend\UsersController@destroy']);
Route::get('backend/users/{users}', ['as'=> 'backend.users.show', 'uses' => 'Backend\UsersController@show']);
Route::get('backend/users/{users}/edit', ['as'=> 'backend.users.edit', 'uses' => 'Backend\UsersController@edit']);


Route::get('backend/userProfiles', ['as'=> 'backend.userProfiles.index', 'uses' => 'Backend\UserProfilesController@index']);
Route::post('backend/userProfiles', ['as'=> 'backend.userProfiles.store', 'uses' => 'Backend\UserProfilesController@store']);
Route::get('backend/userProfiles/create', ['as'=> 'backend.userProfiles.create', 'uses' => 'Backend\UserProfilesController@create']);
Route::put('backend/userProfiles/{userProfiles}', ['as'=> 'backend.userProfiles.update', 'uses' => 'Backend\UserProfilesController@update']);
Route::patch('backend/userProfiles/{userProfiles}', ['as'=> 'backend.userProfiles.update', 'uses' => 'Backend\UserProfilesController@update']);
Route::delete('backend/userProfiles/{userProfiles}', ['as'=> 'backend.userProfiles.destroy', 'uses' => 'Backend\UserProfilesController@destroy']);
Route::get('backend/userProfiles/{userProfiles}', ['as'=> 'backend.userProfiles.show', 'uses' => 'Backend\UserProfilesController@show']);
Route::get('backend/userProfiles/{userProfiles}/edit', ['as'=> 'backend.userProfiles.edit', 'uses' => 'Backend\UserProfilesController@edit']);


Route::get('backend/courses', ['as'=> 'backend.courses.index', 'uses' => 'Backend\CoursesController@index']);
Route::post('backend/courses', ['as'=> 'backend.courses.store', 'uses' => 'Backend\CoursesController@store']);
Route::get('backend/courses/create', ['as'=> 'backend.courses.create', 'uses' => 'Backend\CoursesController@create']);
Route::put('backend/courses/{courses}', ['as'=> 'backend.courses.update', 'uses' => 'Backend\CoursesController@update']);
Route::patch('backend/courses/{courses}', ['as'=> 'backend.courses.update', 'uses' => 'Backend\CoursesController@update']);
Route::delete('backend/courses/{courses}', ['as'=> 'backend.courses.destroy', 'uses' => 'Backend\CoursesController@destroy']);
Route::get('backend/courses/{courses}', ['as'=> 'backend.courses.show', 'uses' => 'Backend\CoursesController@show']);
Route::get('backend/courses/{courses}/edit', ['as'=> 'backend.courses.edit', 'uses' => 'Backend\CoursesController@edit']);

Route::post('backend/courses/upload', ['as'=> 'backend.courses.upload', 'uses' => 'Backend\CoursesController@upload']);


Route::get('backend/userCourseBookmarks', ['as'=> 'backend.userCourseBookmarks.index', 'uses' => 'Backend\UserCourseBookmarksController@index']);
Route::post('backend/userCourseBookmarks', ['as'=> 'backend.userCourseBookmarks.store', 'uses' => 'Backend\UserCourseBookmarksController@store']);
Route::get('backend/userCourseBookmarks/create', ['as'=> 'backend.userCourseBookmarks.create', 'uses' => 'Backend\UserCourseBookmarksController@create']);
Route::put('backend/userCourseBookmarks/{userCourseBookmarks}', ['as'=> 'backend.userCourseBookmarks.update', 'uses' => 'Backend\UserCourseBookmarksController@update']);
Route::patch('backend/userCourseBookmarks/{userCourseBookmarks}', ['as'=> 'backend.userCourseBookmarks.update', 'uses' => 'Backend\UserCourseBookmarksController@update']);
Route::delete('backend/userCourseBookmarks/{userCourseBookmarks}', ['as'=> 'backend.userCourseBookmarks.destroy', 'uses' => 'Backend\UserCourseBookmarksController@destroy']);
Route::get('backend/userCourseBookmarks/{userCourseBookmarks}', ['as'=> 'backend.userCourseBookmarks.show', 'uses' => 'Backend\UserCourseBookmarksController@show']);
Route::get('backend/userCourseBookmarks/{userCourseBookmarks}/edit', ['as'=> 'backend.userCourseBookmarks.edit', 'uses' => 'Backend\UserCourseBookmarksController@edit']);


Route::get('backend/userCheckins', ['as'=> 'backend.userCheckins.index', 'uses' => 'Backend\UserCheckinsController@index']);
Route::post('backend/userCheckins', ['as'=> 'backend.userCheckins.store', 'uses' => 'Backend\UserCheckinsController@store']);
Route::get('backend/userCheckins/create', ['as'=> 'backend.userCheckins.create', 'uses' => 'Backend\UserCheckinsController@create']);
Route::put('backend/userCheckins/{userCheckins}', ['as'=> 'backend.userCheckins.update', 'uses' => 'Backend\UserCheckinsController@update']);
Route::patch('backend/userCheckins/{userCheckins}', ['as'=> 'backend.userCheckins.update', 'uses' => 'Backend\UserCheckinsController@update']);
Route::delete('backend/userCheckins/{userCheckins}', ['as'=> 'backend.userCheckins.destroy', 'uses' => 'Backend\UserCheckinsController@destroy']);
Route::get('backend/userCheckins/{userCheckins}', ['as'=> 'backend.userCheckins.show', 'uses' => 'Backend\UserCheckinsController@show']);
Route::get('backend/userCheckins/{userCheckins}/edit', ['as'=> 'backend.userCheckins.edit', 'uses' => 'Backend\UserCheckinsController@edit']);

Route::get('backend/forums', ['as' => 'backend.forums.index', 'uses' => 'Backend\ForumController@index']);
Route::post('backend/forums', ['as' => 'backend.forums.store', 'uses' => 'Backend\ForumController@store']);
Route::get('backend/forums/create', ['as' => 'backend.forums.create', 'uses' => 'Backend\ForumController@create']);
Route::put('backend/forums/{forums}', ['as' => 'backend.forums.update', 'uses' => 'Backend\ForumController@update']);
Route::patch('backend/forums/{forums}', ['as' => 'backend.forums.update', 'uses' => 'Backend\ForumController@update']);
Route::delete('backend/forums/{forums}', [
    'as' => 'backend.forums.destroy',
    'uses' => 'Backend\ForumController@destroy'
]);
Route::get('backend/forums/{forums}', ['as' => 'backend.forums.show', 'uses' => 'Backend\ForumController@show']);
Route::get('backend/forums/{forums}/edit', ['as' => 'backend.forums.edit', 'uses' => 'Backend\ForumController@edit']);


Route::get('backend/forum/{forum?}/posts/', [
    'as' => 'backend.forumPosts.index',
    'uses' => 'Backend\ForumPostController@index'
]);
Route::post('backend/forum-posts', ['as' => 'backend.forumPosts.store', 'uses' => 'Backend\ForumPostController@store']);
Route::get('backend/forum-posts/create', [
    'as' => 'backend.forumPosts.create',
    'uses' => 'Backend\ForumPostController@create'
]);
Route::put('backend/forum-posts/{forumPosts}', [
    'as' => 'backend.forumPosts.update',
    'uses' => 'Backend\ForumPostController@update'
]);
Route::patch('backend/forum-posts/{forumPosts}', [
    'as' => 'backend.forumPosts.update',
    'uses' => 'Backend\ForumPostController@update'
]);
Route::delete('backend/forum-posts/{forumPosts}', [
    'as' => 'backend.forumPosts.destroy',
    'uses' => 'Backend\ForumPostController@destroy'
]);
Route::get('backend/forum-posts/{forumPosts}', [
    'as' => 'backend.forumPosts.show',
    'uses' => 'Backend\ForumPostController@show'
]);
Route::get('backend/forum-posts/{forumPosts}/edit', [
    'as' => 'backend.forumPosts.edit',
    'uses' => 'Backend\ForumPostController@edit'
]);


Route::get('backend/post/{post}/comments', [
    'as' => 'backend.forumComments.index',
    'uses' => 'Backend\ForumCommentController@index'
]);
Route::post('backend/post-comments', [
    'as' => 'backend.forumComments.store',
    'uses' => 'Backend\ForumCommentController@store'
]);
Route::get('backend/post-comments/create', [
    'as' => 'backend.forumComments.create',
    'uses' => 'Backend\ForumCommentController@create'
]);
Route::put('backend/post-comments/{forumComments}', [
    'as' => 'backend.forumComments.update',
    'uses' => 'Backend\ForumCommentController@update'
]);
Route::patch('backend/post-comments/{forumComments}', [
    'as' => 'backend.forumComments.update',
    'uses' => 'Backend\ForumCommentController@update'
]);
Route::delete('backend/post-comments/{forumComments}', [
    'as' => 'backend.forumComments.destroy',
    'uses' => 'Backend\ForumCommentController@destroy'
]);
Route::get('backend/post-comments/{forumComments}', [
    'as' => 'backend.forumComments.show',
    'uses' => 'Backend\ForumCommentController@show'
]);
Route::get('backend/post-comments/{forumComments}/edit', [
    'as' => 'backend.forumComments.edit',
    'uses' => 'Backend\ForumCommentController@edit'
]);


Route::get('backend/forumBulletins', ['as'=> 'backend.forumBulletins.index', 'uses' => 'Backend\ForumBulletinsController@index']);
Route::post('backend/forumBulletins', ['as'=> 'backend.forumBulletins.store', 'uses' => 'Backend\ForumBulletinsController@store']);
Route::get('backend/forumBulletins/create', ['as'=> 'backend.forumBulletins.create', 'uses' => 'Backend\ForumBulletinsController@create']);
Route::put('backend/forumBulletins/{forumBulletins}', ['as'=> 'backend.forumBulletins.update', 'uses' => 'Backend\ForumBulletinsController@update']);
Route::patch('backend/forumBulletins/{forumBulletins}', ['as'=> 'backend.forumBulletins.update', 'uses' => 'Backend\ForumBulletinsController@update']);
Route::delete('backend/forumBulletins/{forumBulletins}', ['as'=> 'backend.forumBulletins.destroy', 'uses' => 'Backend\ForumBulletinsController@destroy']);
Route::get('backend/forumBulletins/{forumBulletins}', ['as'=> 'backend.forumBulletins.show', 'uses' => 'Backend\ForumBulletinsController@show']);
Route::get('backend/forumBulletins/{forumBulletins}/edit', ['as'=> 'backend.forumBulletins.edit', 'uses' => 'Backend\ForumBulletinsController@edit']);


Route::get('backend/books', ['as'=> 'backend.books.index', 'uses' => 'Backend\BooksController@index']);
Route::post('backend/books', ['as'=> 'backend.books.store', 'uses' => 'Backend\BooksController@store']);
Route::get('backend/books/create', ['as'=> 'backend.books.create', 'uses' => 'Backend\BooksController@create']);
Route::put('backend/books/{books}', ['as'=> 'backend.books.update', 'uses' => 'Backend\BooksController@update']);
Route::patch('backend/books/{books}', ['as'=> 'backend.books.update', 'uses' => 'Backend\BooksController@update']);
Route::delete('backend/books/{books}', ['as'=> 'backend.books.destroy', 'uses' => 'Backend\BooksController@destroy']);
Route::get('backend/books/{books}', ['as'=> 'backend.books.show', 'uses' => 'Backend\BooksController@show']);
Route::get('backend/books/{books}/edit', ['as'=> 'backend.books.edit', 'uses' => 'Backend\BooksController@edit']);

Route::get('backend/logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index')->middleware('auth');

Route::get('backend/courseChapters', ['as'=> 'backend.courseChapters.index', 'uses' => 'Backend\CourseChaptersController@index']);
Route::post('backend/courseChapters', ['as'=> 'backend.courseChapters.store', 'uses' => 'Backend\CourseChaptersController@store']);
Route::get('backend/courseChapters/create', ['as'=> 'backend.courseChapters.create', 'uses' => 'Backend\CourseChaptersController@create']);
Route::put('backend/courseChapters/{courseChapters}', ['as'=> 'backend.courseChapters.update', 'uses' => 'Backend\CourseChaptersController@update']);
Route::patch('backend/courseChapters/{courseChapters}', ['as'=> 'backend.courseChapters.update', 'uses' => 'Backend\CourseChaptersController@update']);
Route::delete('backend/courseChapters/{courseChapters}', ['as'=> 'backend.courseChapters.destroy', 'uses' => 'Backend\CourseChaptersController@destroy']);
Route::get('backend/courseChapters/{courseChapters}', ['as'=> 'backend.courseChapters.show', 'uses' => 'Backend\CourseChaptersController@show']);
Route::get('backend/courseChapters/{courseChapters}/edit', ['as'=> 'backend.courseChapters.edit', 'uses' => 'Backend\CourseChaptersController@edit']);


Route::get('backend/reports', ['as'=> 'backend.reports.index', 'uses' => 'Backend\ReportsController@index']);
Route::post('backend/reports', ['as'=> 'backend.reports.store', 'uses' => 'Backend\ReportsController@store']);
Route::get('backend/reports/create', ['as'=> 'backend.reports.create', 'uses' => 'Backend\ReportsController@create']);
Route::put('backend/reports/{reports}', ['as'=> 'backend.reports.update', 'uses' => 'Backend\ReportsController@update']);
Route::patch('backend/reports/{reports}', ['as'=> 'backend.reports.update', 'uses' => 'Backend\ReportsController@update']);
Route::delete('backend/reports/{reports}', ['as'=> 'backend.reports.destroy', 'uses' => 'Backend\ReportsController@destroy']);
Route::get('backend/reports/{reports}', ['as'=> 'backend.reports.show', 'uses' => 'Backend\ReportsController@show']);
Route::get('backend/reports/{reports}/edit', ['as'=> 'backend.reports.edit', 'uses' => 'Backend\ReportsController@edit']);


Route::get('backend/courseFiles', ['as'=> 'backend.courseFiles.index', 'uses' => 'Backend\CourseFilesController@index']);
Route::post('backend/courseFiles', ['as'=> 'backend.courseFiles.store', 'uses' => 'Backend\CourseFilesController@store']);
Route::get('backend/courseFiles/create', ['as'=> 'backend.courseFiles.create', 'uses' => 'Backend\CourseFilesController@create']);
Route::put('backend/courseFiles/{courseFiles}', ['as'=> 'backend.courseFiles.update', 'uses' => 'Backend\CourseFilesController@update']);
Route::patch('backend/courseFiles/{courseFiles}', ['as'=> 'backend.courseFiles.update', 'uses' => 'Backend\CourseFilesController@update']);
Route::delete('backend/courseFiles/{courseFiles}', ['as'=> 'backend.courseFiles.destroy', 'uses' => 'Backend\CourseFilesController@destroy']);
Route::get('backend/courseFiles/{courseFiles}', ['as'=> 'backend.courseFiles.show', 'uses' => 'Backend\CourseFilesController@show']);
Route::get('backend/courseFiles/{courseFiles}/edit', ['as'=> 'backend.courseFiles.edit', 'uses' => 'Backend\CourseFilesController@edit']);


Route::get('social-shares', ['as'=> 'backend.socialShares.index', 'uses' => 'Backend\SocialSharesController@index']);

Route::get('backend/messages', ['as' => 'backend.messages.index', 'uses' => 'Backend\MessageController@index']);
Route::post('backend/messages', ['as' => 'backend.messages.store', 'uses' => 'Backend\MessageController@store']);
Route::get('backend/messages/create', [
    'as' => 'backend.messages.create',
    'uses' => 'Backend\MessageController@create'
]);
Route::put('backend/messages/{messages}', [
    'as' => 'backend.messages.update',
    'uses' => 'Backend\MessageController@update'
]);
Route::patch('backend/messages/{messages}', [
    'as' => 'backend.messages.update',
    'uses' => 'Backend\MessageController@update'
]);
Route::delete('backend/messages/{messages}', [
    'as' => 'backend.messages.destroy',
    'uses' => 'Backend\MessageController@destroy'
]);
Route::get('backend/messages/{messages}', [
    'as' => 'backend.messages.show',
    'uses' => 'Backend\MessageController@show'
]);
Route::get('backend/messages/{messages}/edit', [
    'as' => 'backend.messages.edit',
    'uses' => 'Backend\MessageController@edit'
]);
Route::post('backend/messages/upload', 'Backend\MessageController@upload');


Route::get('backend/advertisements', ['as'=> 'backend.advertisements.index', 'uses' => 'Backend\AdvertisementsController@index']);
Route::post('backend/advertisements', ['as'=> 'backend.advertisements.store', 'uses' => 'Backend\AdvertisementsController@store']);
Route::get('backend/advertisements/create', ['as'=> 'backend.advertisements.create', 'uses' => 'Backend\AdvertisementsController@create']);
Route::put('backend/advertisements/{advertisements}', ['as'=> 'backend.advertisements.update', 'uses' => 'Backend\AdvertisementsController@update']);
Route::patch('backend/advertisements/{advertisements}', ['as'=> 'backend.advertisements.update', 'uses' => 'Backend\AdvertisementsController@update']);
Route::delete('backend/advertisements/{advertisements}', ['as'=> 'backend.advertisements.destroy', 'uses' => 'Backend\AdvertisementsController@destroy']);
Route::get('backend/advertisements/{advertisements}', ['as'=> 'backend.advertisements.show', 'uses' => 'Backend\AdvertisementsController@show']);
Route::get('backend/advertisements/{advertisements}/edit', ['as'=> 'backend.advertisements.edit', 'uses' => 'Backend\AdvertisementsController@edit']);

Route::resource('backend/fileApilogs', 'Backend\FileApilogsController');
Route::resource('backend/subjects', 'Backend\SubjectsController');





