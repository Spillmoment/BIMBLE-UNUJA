<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();
Route::get('/admin', function () {
    $data['user'] = "M Hafidz M";
    return view('admin.dashboard.index', $data);
});

Route::match(['GET', 'POST'], '/register', function () {
    return redirect('/login');
})->name('register');

Route::resource("users", "UserController");


// Landing

Route::get('/', 'Web\FrontController@index')->name('front.home');
