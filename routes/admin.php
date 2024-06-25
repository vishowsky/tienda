<?php

Route::prefix('/admin')->group(function () {
    Route::get('/','Admin\DashboardController@getDashboard')->name('dashboard');

    Route::get('/users/{status}','Admin\UserController@getUsers')->name('user_list');
    Route::get('/user/{id}/edit','Admin\UserController@getUserEdit')->name('user_edit');
    Route::post('/user/{id}/edit','Admin\UserController@postUserEdit')->name('user_edit');

    Route::get('/user/{id}/banned','Admin\UserController@getUserBanned')->name('user_banned');
    Route::get('/user/{id}/permissions','Admin\UserController@getUserPermissions')->name('user_permissions');
    Route::post('/user/{id}/permissions','Admin\UserController@postUserPermissions')->name('user_permissions');


    Route::get('/products/{status}','Admin\ProductController@getHome')->name('products');
    Route::get('/product/add','Admin\ProductController@getProductAdd')->name('product_add');

    Route::post('/product/search','Admin\ProductController@postProductSearch')->name('product_search');


    Route::get('/product/{id}/edit','Admin\ProductController@getProductEdit')->name('product_edit');
    Route::post('/product/add','Admin\ProductController@postProductAdd')->name('product_add');
    Route::post('/product/{id}/edit','Admin\ProductController@postProductEdit')->name('product_edit');
    Route::get('/product/{id}/inventory','Admin\ProductController@getProductInventory')->name('product_inventory');
    Route::post('/product/{id}/inventory','Admin\ProductController@postProductInventory')->name('product_inventory');
    Route::get('/product/inventory/{id}/edit' , 'Admin\ProductController@getProductInventoryEdit')->name('product_inventory');
    Route::post('/product/inventory/{id}/edit' , 'Admin\ProductController@postProductInventoryEdit')->name('product_inventory');
    Route::get('/product/inventory/{id}/delete' , 'Admin\ProductController@getProductInventoryDelete')->name('product_inventory');
    Route::post('/product/inventory/{id}/variant' , 'Admin\ProductController@postProductInventoryVariantAdd')->name('product_inventory');

    Route::get('/product/variant/{id}/delete' , 'Admin\ProductController@getProductInventoryVariantDelete')->name('product_inventory');


    Route::get('/product/{id}/delete','Admin\ProductController@getProductDelete')->name('product_delete');
    Route::get('/product/{id}/restore','Admin\ProductController@getProductRestore')->name('product_delete');


    Route::post('/product/{id}/gallery/add','Admin\ProductController@postProductGalleryAdd')->name('product_gallery_add');
    Route::get('/product/{id}/gallery/{gid}/delete','Admin\ProductController@getProductGalleryDelete')->name('product_gallery_delete');


    Route::get('/categories/{module}','Admin\CategoriesController@getHome')->name('categories');
    Route::post('/category/add/{module}','Admin\CategoriesController@postCategorieAdd')->name('category_add');
    Route::get('/category/{id}/edit','Admin\CategoriesController@getCategoryEdit')->name('category_edit');

    Route::get('/category/{id}/subs','Admin\CategoriesController@getSubCategories')->name('category_edit');

    Route::post('/category/{id}/edit','Admin\CategoriesController@postCategoryEdit')->name('category_edit');
    Route::get('/category/{id}/delete','Admin\CategoriesController@getCategoryDelete')->name('category_delete');

    Route::get('/settings', 'Admin\SettingsController@getHome')->name('settings');
    Route::post('/settings', 'Admin\SettingsController@postHome')->name('settings');

    Route::get('/sliders', 'Admin\SliderController@getHome')->name('sliders_list');
    Route::post('/slider/add', 'Admin\SliderController@postSliderAdd')->name('slider_add');
    Route::get('/slider/{id}/edit', 'Admin\SliderController@getSliderEdit')->name('slider_edit');
    Route::post('/slider/{id}/edit', 'Admin\SliderController@postSliderEdit')->name('slider_edit');
    Route::get('/slider/{id}/delete', 'Admin\SliderController@getSliderDelete')->name('slider_delete');


    Route::get('/js/api/load/subcategories/{parent}','Admin\ApiController@getSubCategories');

});
