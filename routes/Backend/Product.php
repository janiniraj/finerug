<?php
/*
 * Product Management
 */
Route::group(['namespace' => 'Product'], function () {
    Route::resource('product', 'ProductController', ['except' => ['show']]);

    //For DataTables
    Route::post('product/get', 'ProductTableController')->name('product.get');

    Route::post('product/upload-sheet', 'ProductController@uploadSheet')->name('product.upload-sheet');

    Route::get('product/download-sheet', 'ProductController@downloadSheet')->name('product.download-sheet');

    Route::get('product/export-products', 'ProductController@exportProducts')->name('product.export-products');

    Route::get('product/get-sku-by-type/{type}', 'ProductController@getSkuByType')->name('product.get-sku-by-type');

    Route::get('product/get-barcode-with-details/{id}', 'ProductController@getBarcodeWithDetails')->name('product.get-barcode-with-details');

    Route::post('product/get-barcode-multiple', 'ProductController@getBarcodeMultiple')->name('product.get-barcode-multiple');

    Route::get('product/price-management', 'ProductController@priceManagement')->name('product.price-management');

    Route::post('product/price-management-store', 'ProductController@priceManagementStore')->name('product.price-management-store');

    Route::get('product/inventory-management', 'ProductController@inventoryManagement')->name('product.inventory-management');

    Route::post('product/inventory-management-store', 'ProductController@inventoryManagementStore')->name('product.inventory-management-store');
});