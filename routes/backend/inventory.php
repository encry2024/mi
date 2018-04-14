<?php

/**
 * All route names are prefixed with 'admin.auth'.
 */
Route::group([
    'prefix'     => 'inventory',
    'as'         => 'inventory.',
    'namespace'  => 'Inventory'
], function () {

    Route::get('item/deleted', 'InventoryStatusController@getDeleted')->name('item.deleted');

    Route::patch('item/{item}/request', 'InventoryController@request')->name('item.request');

    Route::resource('item', 'InventoryController');

    Route::group(['prefix' => 'item/{deletedItem}'], function () {
        Route::get('delete', 'InventoryStatusController@delete')->name('item.delete-permanently');
        Route::get('restore', 'InventoryStatusController@restore')->name('item.restore');
    });

    Route::group([
        'as'        =>  'item.'
    ], function() {
        Route::resource('size', 'SizeController');
    });

});
