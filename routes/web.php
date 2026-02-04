<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

Route::get('/', function () {
    $homeContent = \App\Models\HomeContent::first() ?? new \App\Models\HomeContent();
    return view('home', compact('homeContent'));
});

Route::get('/admin/home', [AdminController::class, 'index'])->name('admin.home');
Route::post('/admin/home', [AdminController::class, 'update'])->name('admin.home.update');
