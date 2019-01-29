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

});