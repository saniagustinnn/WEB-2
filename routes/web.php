<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Counter;
use App\Livewire\Ruang\ListRuang;
use App\Livewire\Ruang\CreateRuang;
use App\Livewire\Ruang\EditRuang;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/counter', Counter::class);

Route::get('/ruang', ListRuang::class)->name('ruang.index');

Route::get('/ruang/create', CreateRuang::class)->name('ruang.create'); 

Route::get('/ruang/edit/{ruang}', EditRuang::class)->name('ruang.edit');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
