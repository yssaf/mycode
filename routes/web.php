<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


//Route::get('/post/{id}','AdminPostController@post');

Route::get('/post/{id}',['as'=>'home.post', 'uses'=>'AdminPostsController@post']);




Route::group(['middleware'=>'admin'], function (){

    Route::get('/admin', function(){

        return view('admin.index');

    });

    Route::resource('admin/users', 'AdminUsersController', ['as' => 'admin']);
    Route::resource('admin/posts', 'AdminPostsController', ['as' => 'admin']);
    Route::resource('admin/categories', 'AdminCategoriesController', ['as' => 'admin']);

    Route::resource('admin/media', 'AdminMediasController', ['as' => 'admin']);


    Route::resource('admin/comments', 'PostCommentsController', ['as' => 'admin']);

    Route::resource('admin/comment/replies', 'CommentRepliesController', ['as' => 'admin']);

});

Route::delete('admin/delete/media', 'AdminMediasController@deleteMedia');


Route::group(['middleware'=>'auth'], function (){

    Route::post('comment/reply', 'CommentRepliesController@createReply');

});