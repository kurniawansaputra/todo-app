<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::group(['prefix' => 'v1'], function () {
    Route::post('/login', 'App\Http\Controllers\Api\UserController@login');
    Route::post('/register', 'App\Http\Controllers\Api\UserController@register');
    Route::post('/logout', 'App\Http\Controllers\Api\UserController@logout')->middleware('auth:sanctum');
    Route::apiResource('/todos', 'App\Http\Controllers\Api\TodoController')->middleware('auth:sanctum');
    Route::get('/search-todos', 'App\Http\Controllers\Api\TodoController@search')->middleware('auth:sanctum');
});
