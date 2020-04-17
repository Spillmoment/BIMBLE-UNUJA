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

// Route::match(['GET', 'POST'], '/register', function () {
//     return redirect('/login');
// })->name('register');

// Ajax Kategori Search
Route::get('/ajax/kategori/search', 'KategoriController@ajaxSearch');

Route::group(['prefix' => 'admin'], function () {

    Route::get('/', 'DashboardController@index')->name('dashboard.index');

    // Route Users
    Route::resource("users", "UserController");

    // Route Kategori
    Route::delete('kategori/{id}/delete-permanent', 'KategoriController@deletePermanent')
        ->name('kategori.delete-permanent');
    Route::get('kategori/{id}/restore', 'KategoriController@restore')->name('kategori.restore');
    Route::get('kategori/trash', 'KategoriController@trash')->name('kategori.trash');
    Route::resource('kategori', 'KategoriController');
});

Route::get('/', 'Web\FrontController@index')->name('front.home');

Route::get('/home', 'HomeController@index')->name('home');
