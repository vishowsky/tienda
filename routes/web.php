
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

Route::get('/', 'ContentController@getHome')->name('home');

//Route tienda
Route::get('/store','StoreController@getStore')->name('store');

//Route login
Route::get('/login', 'ConnectController@getLogin')->name('login');
//Route login post
Route::post('/login', 'ConnectController@postLogin')->name('login');
//Route Recuperar contraseña
Route::get('/recover', 'ConnectController@getRecover')->name('Recover');
Route::post('/recover', 'ConnectController@postRecover')->name('Recover');
Route::get('/reset', 'ConnectController@getReset')->name('reset');
Route::post('/reset', 'ConnectController@postReset')->name('reset');

//Route registro
Route::get('/register', 'ConnectController@getRegister')->name('register');
//Route registro post
Route::post('/register', 'ConnectController@postRegister')->name('register');
//Route cerrar sesion
Route::get('/logout','ConnectController@getLogout')->name('logout');

//editar perfil de usuario
Route::get('/account/edit', 'UserController@getAccountEdit')->name('account_edit');
Route::post('/account/edit/avatar', 'UserController@postAccountAvatar')->name('account_avatar_edit');
Route::post('/account/edit/password', 'UserController@postAccountPassword')->name('account_password_edit');
Route::post('/account/edit/info', 'UserController@postAccountInfo')->name('account_info_edit');

//modulo productos
Route::get('/product/{id}/{slug}', 'ProductController@getProduct')->name('product_single');
//Route ajax api

Route::get('/js/api/load/products/{section}','ApiJsController@getProductsSection');
Route::post('/js/api/favorites/add/{object}/{module}','ApiJsController@postFavoriteAdd');
Route::post('/js/api/load/user/favorites','ApiJsController@postUserFavorites');

Route::post('/js/api/load/product/inventory/{inv}/variants','ApiJsController@postProductInventoryVariants');
