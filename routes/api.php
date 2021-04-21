<?php

use Illuminate\Http\Request;

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

Route::group(['middleware' => 'api'], function() {
    Route::post('/register', 'Auth\RegisterController@register');
    Route::post('/login', 'Auth\LoginController@login');
    Route::get('/refresh', 'Auth\LoginController@refresh');
    Route::post('/password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail');
    Route::post('/password/reset/{token}', 'Auth\ResetPasswordController@reset');
    Route::get('email/verify/{id}', 'Auth\VerificationController@verify')->name('verification.verify');
    Route::post('email/resend', 'Auth\VerificationController@resend')->name('verification.resend');

    Route::get('/category_tree', 'AppController@categoryTree');
    Route::get('/sns', 'AppController@sns');
    Route::resource('/users', 'UserController', ['except' => ['create', 'edit', 'update']]);
    Route::get('/users/{userId}/posts', 'PostController@postsCreatedBySpecificUser');
    Route::get('/users/{userId}/posts/all', 'PostController@allPostsCreatedBySpecificUser');
    Route::get('/users/{userId}/marks', 'PostController@postsMarkedBySpecificUser');
    Route::get('/users/{userId}/relations/followings', 'RelationController@followings');
    Route::get('/users/{userId}/relations/followers', 'RelationController@followers');
    Route::get('/users/{userId}/relations/followers/{followerUserId}', 'RelationController@show');
    Route::put('/users/{userId}/relations/followers/{followerUserId}', 'RelationController@update');

    Route::resource('/posts', 'PostController', ['except' => ['create', 'edit']]);
    Route::put('/posts/{postId}/eye_catch', 'PostController@updateEyeCatch');
    Route::get('/posts/{postId}/comments', 'CommentController@commentsByPostId');
    Route::post('/posts/{postId}/comments', 'CommentController@store');
    Route::delete('/posts/{postId}/comments/{commentId}', 'CommentController@destroy');
    Route::put('/posts/{postId}/marks/{userId}', 'MarkController@update');
    Route::get('/posts/{postId}/marks/{userId}', 'MarkController@show');
    Route::put('/posts/{postId}/likes/{userId}', 'LikeController@update');
    Route::get('/posts/{postId}/likes/{userId}', 'LikeController@show');


    Route::group(['middleware' => ['jwt.auth']], function() {
        Route::put('/users/{userId}', 'UserController@update');
        Route::put('/users/{userId}/icon', 'UserController@updateIcon');
        Route::get('/home', 'AppController@home');
        Route::get('/user', 'Auth\LoginController@getUserByToken');
    });
});
