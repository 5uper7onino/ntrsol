<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\SpaShell;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/phpinfo', function () {
    phpinfo();
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', SpaShell::class)->name('dashboard');
});
