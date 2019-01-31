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

// Laravel 在匹配路由的时候会按定义的顺序依次查找，找到第一个匹配的路由就返回

// Route::get('alipay', function() {
//     return app('alipay')->web([
//         'out_trade_no' => time(),
//         'total_amount' => '1',
//         'subject' => 'test subject - 测试',
//     ]);
// });

// Route::get('/', 'PagesController@root')->name('root');
Route::redirect('/', '/products')->name('root');

// 商品列表
Route::get('products', 'ProductsController@index')->name('products.index');
// 商品详情
// Route::get('products/{product}', 'ProductsController@show')->name('products.show');
Route::get('products/{product}', 'ProductsController@show')->name('products.show')->where(['product' => '[0-9]+']);

// Laravel 的用户认证路由
Auth::routes();

Route::group([
    'middleware' => 'auth'
], function() {

    // 验证邮箱提示
    Route::get('/email_verify_notice', 'PagesController@emailVerifyNotice')->name('email_verify_notice');
    // 激活邮箱
    Route::get('/email_verification/verify', 'EmailVerificationController@verify')->name('email_verification.verify');
    // 发送激活邮件
    Route::get('/email_verification/send', 'EmailVerificationController@send')->name('email_verification.send');

    Route::group(['middleware' => 'email_verified'], function() {

        // 收货地址列表
        Route::get('user_addresses', 'UserAddressesController@index')->name('user_addresses.index');
        // 新增收货地址页面
        Route::get('user_addresses/create', 'UserAddressesController@create')->name('user_addresses.create');
        // 创建收货地址
        Route::post('user_addresses', 'UserAddressesController@store')->name('user_addresses.store');
        // 编辑收货地址页面
        Route::get('user_addresses/{user_address}', 'UserAddressesController@edit')->name('user_addresses.edit');
        // 更新收货地址
        Route::put('user_addresses/{user_address}', 'UserAddressesController@update')->name('user_addresses.update');
        // 删除收货地址
        Route::delete('user_addresses/{user_address}', 'UserAddressesController@destroy')->name('user_addresses.destroy');

        // 收藏商品
        Route::post('products/{product}/favorite', 'ProductsController@favor')->name('products.favor');
        // 取消收藏
        Route::delete('products/{product}/favorite', 'ProductsController@disfavor')->name('products.disfavor');
        // 收藏商品列表
        Route::get('products/favorites', 'ProductsController@favorites')->name('products.favorites');

        // 添加购物车
        Route::post('cart', 'CartController@add')->name('cart.add');
        // 查看购物车
        Route::get('cart', 'CartController@index')->name('cart.index');
        // 从购物车中移除商品
        Route::delete('cart/{sku}', 'CartController@remove')->name('cart.remove');

        // 提交订单
        Route::post('orders', 'OrdersController@store')->name('orders.store');
        // 订单列表
        Route::get('orders', 'OrdersController@index')->name('orders.index');
        // 订单详请
        Route::get('orders/{order}', 'OrdersController@show')->name('orders.show');



        // 测试中间件 email_verified
        Route::get('/test', function() {
            return 'Your email is verified';
        });
    });
});



