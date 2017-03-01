<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::group(['middleware' => ['auth:api']], function () {

    Route::resource('forums', 'Api\ForumsController', [
        'only' => ['store']
    ]);
    Route::get('forum/{forum_id}/posts/{column?}/{direction?}', 'Api\ForumPostsController@index');
    Route::get('my/forums', 'Api\UsersForumsController@index');
    Route::post('join/forum', 'Api\UsersForumsController@store');
    Route::delete('quit/forum/{forum_id}', 'Api\UsersForumsController@destroy');

    Route::post('like/post', 'Api\LikePostController@store');
    Route::delete('dislike/post/{post_id}', 'Api\LikePostController@destroy');

    Route::resource('forum/posts', 'Api\ForumPostsController', [
        'except' => ['index', 'create', 'edit']
    ]);

    Route::delete('forum/remove/attachment/{attachment_id}', 'Api\ForumPostsController@remove');

    Route::resource('forum/comments', 'Api\ForumCommentsController', [
        'except' => ['index', 'create', 'edit']
    ]);

    Route::get('/users/info', ['uses' => 'Api\UsersController@show']);
    Route::post('users/update-profile', ['as'=> 'api.users.updateUserProfile', 'uses' => 'Api\UsersController@updateUserProfile']);
    Route::post('/users/logout', ['uses' => 'Api\UsersController@logout']);

    Route::resource('user-checkins', 'Api\UserCheckinsController', [
        'only' => ['store', 'show']
    ]);

    Route::resource('forum-Bulletins', 'Api\ForumBulletinsController', [
        'only' => ['index']
    ]);

    Route::post('feedbacks/post-feedback', ['as' => 'api.feedbacks.postFeedback', 'uses' => 'Api\FeedbacksController@addFeedback']);


    Route::resource('reports', 'Api\ReportsController', [
        'only' => ['store']
    ]);
});

Route::post('/users/register', ['uses' => 'Api\UsersController@register']);
Route::post('/qiniu/token', ['uses' => 'Api\QiniuController@token']);

Route::resource('forums', 'Api\ForumsController', [
    'only' => ['index', 'show']
]);
Route::get('forum/posts/{post_id}/comments/{column?}/{direction?}', 'Api\ForumCommentsController@index');

Route::get('messages/banner', 'Api\MessagesController@banner');
Route::get('message-types', 'Api\MessageTypesController@index');
Route::get('messages/type/{type?}', 'Api\MessagesController@index');
Route::get('messages/{id}', 'Api\MessagesController@show');
Route::get('messages', 'Api\MessagesController@index');

Route::post('advertisements/get-advertisment', ['as' => 'api.advertisements.getAdvertisement', 'uses' => 'Api\AdvertisementsController@getAdvertisement']);
Route::post('subjects/get-subjects', ['as' => 'api.subjects.getSubjects', 'uses' => 'Api\SubjectsController@getSubjects']);

Route::post('courses', ['as'=> 'api.courses.index', 'uses' => 'Api\CoursesController@index']);
Route::get('courses/show/{id}', ['as'=> 'api.courses.show', 'uses' => 'Api\CoursesController@show']);
Route::resource('user-courses', 'Api\UserCourseBookmarksController', [
    'only' => ['index', 'store', 'destroy']
]);

Route::post('books/browse', ['as' => 'api.books.browse', 'uses' => 'Api\BooksController@browse']);
Route::post('books/get-list', ['as' => 'api.books.getMyList', 'uses' => 'Api\BooksController@getMyList']);
Route::post('books/delete-from-list', ['as' => 'api.books.deleteFromMylist', 'uses' => 'Api\BooksController@deleteFromMylist']);
Route::post('books/add-to-list', ['as' => 'api.books.addToMylist', 'uses' => 'Api\BooksController@addToMylist']);
