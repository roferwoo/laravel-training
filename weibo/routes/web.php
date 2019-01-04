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

// Route::get('/', function () {
//     return view('welcome');
// });

// 静态页
Route::get('/', 'StaticPagesController@home')->name('home');
Route::get('/help', 'StaticPagesController@help')->name('help');
Route::get('/about', 'StaticPagesController@about')->name('about');
Route::get('/test', 'StaticPagesController@t')->name('test');

// 用户注册
Route::get('signup', 'UsersController@create')->name('signup');
// 用户资源路由
Route::resource('users', 'UsersController');
// 等同于
// Route::get('/users', 'UsersController@index')->name('users.index');// 显示所有用户列表的页面
// Route::get('/users/create', 'UsersController@create')->name('users.create');// 创建用户的页面
// Route::get('/users/{user}', 'UsersController@show')->name('users.show');// 显示用户个人信息的页面
// Route::post('/users', 'UsersController@store')->name('users.store');// 创建用户
// Route::get('/users/{user}/edit', 'UsersController@edit')->name('users.edit');// 编辑用户个人资料的页面
// Route::patch('/users/{user}', 'UsersController@update')->name('users.update');// 更新用户
// Route::delete('/users/{user}', 'UsersController@destroy')->name('users.destroy');// 删除用户

Route::get('login', 'SessionsController@create')->name('login');// 显示登录页面
Route::post('login', 'SessionsController@store')->name('login');// 创建新会话（登录）
Route::delete('logout', 'SessionsController@destroy')->name('logout');// 销毁会话（退出登录）

// 邮箱激活
Route::get('signup/confirm/{token}', 'UsersController@confirmEmail')->name('confirm_email');

// 重置密码
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');// 显示重置密码的邮箱发送页面
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');// 邮箱发送重设链接
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');// 密码更新页面
Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');// 执行密码更新操作

// 微博相关操作
Route::resource('/statuses', 'StatusesController', ['only' => ['store', 'destroy']]);
// 等同于
// Route::post('/statuses', 'StatusesController@store');// 处理创建微博请求
// Route::delete('/statuses/{status}', 'StatusesController@destroy');// 处理删除微博请求

// 关注 粉丝
Route::get('/users/{user}/followings', 'UsersController@followings')->name('users.followings');// 显示用户的关注人列表
Route::get('/users/{user}/followers', 'UsersController@followers')->name('users.followers');// 显示用户的粉丝列表

Route::post('/users/followers/{user}', 'FollowersController@store')->name('followers.store');// 关注
Route::delete('/users/followers/{user}', 'FollowersController@destroy')->name('followers.destroy');// 取消关注




















