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

    // Route Kursus
    Route::delete('kursus/{id}/delete-permanent', 'KursusController@deletePermanent')
        ->name('kursus.delete-permanent');
    Route::get('kursus/{id}/restore', 'KursusController@restore')->name('kursus.restore');
    Route::get('kursus/trash', 'KursusController@trash')->name('kursus.trash');
    Route::resource('kursus', 'KursusController');

    // Route Tutor
    Route::resource('tutor', 'TutorController');

    // Route Pendaftar
    Route::get('pendaftar/trash', 'PendaftarController@trash')->name('pendaftar.trash');
    Route::resource('pendaftar', 'PendaftarController');
});


// Route Home
Route::get('/', 'Web\FrontController@index')->name('front.index');

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/user/logout', 'Auth\LoginController@logoutUser')->name('user.logout');

Route::group(['prefix' => 'manager'], function(){
    Route::get('/login', 'AuthManager\LoginController@showLoginForm')->name('manager.login');
    Route::post('/login', 'AuthManager\LoginController@login')->name('manager.login.submit');
    Route::get('/', 'ManagerController@index')->name('manager.home');
    Route::get('/logout', 'AuthManager\LoginController@logoutManager')->name('manager.logout');
    Route::get('/password/reset', 'AuthManager\ForgotPasswordController@showLinkRequestForm')->name('manager.password.request');
    Route::post('/password/email', 'AuthManager\ForgotPasswordController@sendResetLinkEmail')->name('manager.password.email');    
    Route::get('/password/reset/{token}', 'AuthManager\ResetPasswordController@showResetForm')->name('manager.password.reset');    
    Route::post('/password/reset', 'AuthManager\ResetPasswordController@reset');    
});
