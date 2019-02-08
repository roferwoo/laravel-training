<?php

use Illuminate\Routing\Router;

Admin::registerAuthRoutes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
], function (Router $router) {

    $router->get('/', 'HomeController@index');
    // 用户管理
    $router->get('users', 'UsersController@index');

    // 商品管理
    $router->get('products', 'ProductsController@index');// 列表
    $router->get('products/create', 'ProductsController@create');// 添加页面
    $router->post('products', 'ProductsController@store');// 添加保存
    $router->get('products/{id}/edit', 'ProductsController@edit');// 编辑页面
    $router->put('products/{id}', 'ProductsController@update');// 编辑保存

    // 订单管理
    $router->get('orders', 'OrdersController@index')->name('admin.orders.index');// 列表
    $router->get('orders/{order}', 'OrdersController@show')->name('admin.orders.show');// 详情
    $router->post('orders/{order}/ship', 'OrdersController@ship')->name('admin.orders.ship');// 发货

    // 退款
    $router->post('orders/{order}/refund', 'OrdersController@handleRefund')->name('admin.orders.handle_refund');

    // 优惠券
    $router->get('coupon_codes', 'CouponCodesController@index');// 列表

});
