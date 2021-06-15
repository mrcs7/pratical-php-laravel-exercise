<?php
Route::group(['prefix' => 'customer'], function () {;
    Route::get('/', 'CustomerController@index');
});
