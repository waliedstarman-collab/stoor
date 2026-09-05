<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

use App\Http\Controllers\FrontendController;

Route::get('/', [FrontendController::class, 'index'])->name('website.home');
Route::get('/category/{slug}', [FrontendController::class, 'category'])->name('website.category');
Route::get('/product/{id}', [FrontendController::class, 'product'])->name('website.product');

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

Route::get('/simple-login', function () {
    return view('simple-login');
});

Route::post('/simple-login', function (Request $request) {
    $credentials = $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    if (Auth::attempt($credentials, true)) {
        $request->session()->regenerate();
        return redirect('/simple-dashboard');
    }

    return back()->withErrors(['email' => 'Invalid credentials']);
});

Route::get('/simple-dashboard', function () {
    if (auth()->check()) {
        return '✅ Logged in as: ' . auth()->user()->email;
    }
    return '❌ Not logged in';
})->middleware('auth');