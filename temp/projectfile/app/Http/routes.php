<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::post('/', ['middleware' => ['apiverify'], 'uses' => 'Test@index']);
Route::get('/1/{controller}/{view}', ['middleware' => ['apiverify'], 'uses' => 'Foobar@index']);
Route::get('/m/{controller}/{view}',function($c,$v){
    return view('wap.'.$c.'.'.$v);
});

// API
Route::group(['prefix' => 'api','middleware'=>['apiverify']], function()
{
    Route::controller('user', 'Api\User\UserController');
    Route::controller('topic', 'Api\Post\TopicController');
    Route::controller('advert', 'Api\System\AdvertController');
});

// 后台
Route::group(['prefix' => 'admin','middleware' => ['auth','session']], function()
{
    Route::group(['prefix' => 'user'], function()
    {
        Route::controller('a', 'Admin\User\UserController');
    });

    Route::group(['prefix' => 'topic'], function()
    {
        Route::controller('auditing', 'Admin\Topic\AuditingController');
        Route::controller('manage', 'Admin\Topic\ManageController');
    });

    Route::group(['prefix' => 'posts'], function()
    {
        Route::controller('auditing', 'Admin\Posts\PostsAuditingController');
        Route::controller('reviewauditing', 'Admin\Posts\ReviewAuditingController');
        Route::controller('sensitive', 'Admin\Posts\SensitiveController');
        Route::controller('report', 'Admin\Posts\PostsReportController');
    });

    Route::controller('user', 'Admin\User\UserController');
});

//H5页面
Route::group(['prefix' => 'wap'], function()
{
        Route::controller('user', 'Wap\User\UserController');

});

// 后台登录
Route::get('admin/login',['middleware' => 'session','uses'=>'Admin\System\LoginController@index']);
Route::post('admin/login',['middleware' => 'session','uses'=>'Admin\System\LoginController@doLogin']);