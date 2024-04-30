<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;

Route::get('/', function () {
    return view('pages.auth.login');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('pages.dashboard.index');
    })->name('dashboard');

    Route::resource('todos', TodoController::class);

    Route::get('todos/{todo}/done', [TodoController::class, 'markAsDone'])->name('todos.markAsDone');
});
