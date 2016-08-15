<?php

/**
 * |--------------------------------------------------------------------------
 * | Route group for ADMIN only.
 * |--------------------------------------------------------------------------
 */
Route::group(['middleware' => ['role:admin']], function () {
    /**
     * |--------------------------------------------------------------------------
     * | Create staff
     * |--------------------------------------------------------------------------
     */

    Route::group(['prefix' => 'products', 'namespace' => '\Klsandbox\ProductRoute\Http\Controllers'], function () {

        /**
         * Products
         */
        Route::post('{product}/units', 'ProductManagementController@storeUnits');
        Route::delete('{product}/units/{product_unit}', 'ProductManagementController@deleteUnits');
        Route::get('{product}/units', 'ProductManagementController@units');
        Route::get('{product}/units/{product_unit}', 'ProductManagementController@viewUnits');
        Route::put('{product}/units/{product_unit}', 'ProductManagementController@updateUnits');
        Route::get('create-product', 'ProductManagementController@getCreateProduct');
        Route::post('create-product', 'ProductManagementController@postCreateProduct');
        Route::get('delete/{product}', 'ProductManagementController@getDelete');
        Route::get('edit/{product}', 'ProductManagementController@getEdit');
        Route::get('list', 'ProductManagementController@getList');
        Route::get('all', 'ProductManagementController@getListAll');
        Route::post('update/{product}', 'ProductManagementController@postUpdate');
        Route::get('export', 'ProductManagementController@export');

        /**
         * Product Units
         */
        Route::get('units', 'ProductUnitController@getList');
        Route::post('units', 'ProductUnitController@store');
        Route::get('units/create', 'ProductUnitController@create');
        Route::get('units/{productUnitId}', 'ProductUnitController@view');
        Route::put('units/{productUnitId}', 'ProductUnitController@update');
        Route::delete('units/{productUnitId}', 'ProductUnitController@destroy');

    });
});
