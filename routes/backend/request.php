<?php

/**
 * All route names are prefixed with 'admin.auth'.
 */
Route::group([
    'namespace'  => 'Request'
], function () {

    Route::resource('request', 'RequestController');
});
