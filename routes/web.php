<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

use App\Http\Controllers\FrontendController;

Route::get('/', [FrontendController::class, 'index'])->name('website.home');
Route::get('/category/{slug}', [FrontendController::class, 'category'])->name('website.category');
Route::get('/product/{id}', [FrontendController::class, 'product'])->name('website.product');