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

// Auth User
Auth::routes();

// Auth Manager
Route::group(['prefix' => 'manager'], function () {

    // Route Auth
    Route::get('/login', 'AuthManager\LoginController@showLoginForm')->name('manager.login');
    Route::post('/login', 'AuthManager\LoginController@login')->name('manager.login.submit');
    Route::get('/logout', 'AuthManager\LoginController@logoutManager')->name('manager.logout');
    Route::get('/user/logout', 'Auth\LoginController@logoutUser')->name('user.logout');
    Route::get('/password/reset', 'AuthManager\ForgotPasswordController@showLinkRequestForm')->name('manager.password.request');
    Route::post('/password/email', 'AuthManager\ForgotPasswordController@sendResetLinkEmail')->name('manager.password.email');
    Route::get('/password/reset/{token}', 'AuthManager\ResetPasswordController@showResetForm')->name('manager.password.reset');
    Route::post('/password/reset', 'AuthManager\ResetPasswordController@reset');
});

// Auth Tutor
Route::group(['prefix' => 'tutor'], function () {
    Route::get('/login', 'AuthTutor\LoginController@showLoginForm')->name('tutor.login');
    Route::post('/login', 'AuthTutor\LoginController@login')->name('tutor.login.submit');

    Route::get('/logout', 'AuthTutor\LoginController@logoutTutor')->name('tutor.logout');
    Route::get('/password/reset', 'AuthTutor\ForgotPasswordController@showLinkRequestForm')->name('tutor.password.request');
    Route::post('/password/email', 'AuthTutor\ForgotPasswordController@sendResetLinkEmail')->name('tutor.password.email');
    Route::get('/password/reset/{token}', 'AuthTutor\ResetPasswordController@showResetForm')->name('tutor.password.reset');
    Route::post('/password/reset', 'AuthTutor\ResetPasswordController@reset');
});

Route::prefix('tutor')
    ->middleware('auth:tutor')
    ->group(function () {

        Route::get('/', 'Tutor\DashboardController@index')->name('tutor.home');
        Route::put('siswa/nilai', 'Tutor\SiswaController@add_nilai')->name('siswa.add');
        Route::get('siswa/nilai/{id}', 'Tutor\SiswaController@nilai')->name('siswa.nilai');
        Route::resource('siswa', 'Tutor\SiswaController');
        Route::resource('nilai', 'Tutor\NilaiController');
    });

// Route Manager
Route::prefix('manager')
    ->middleware('auth:manager')
    ->group(function () {

        // Route Dashboard
        Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

        // Route Tutor
        Route::resource('tutor', 'TutorController');

        // Route Kategori
        Route::resource('kategori', 'KategoriController');

        // Route Kursus
        Route::delete('kursus/{id}/delete-permanent', 'KursusController@deletePermanent')
            ->name('kursus.delete-permanent');
        Route::get('kursus/{id}/restore', 'KursusController@restore')->name('kursus.restore');
        Route::get('kursus/trash', 'KursusController@trash')->name('kursus.trash');
        Route::get('kursus/{id}/gallery', 'KursusController@gallery')
            ->name('kursus.gallery');
        Route::resource('kursus', 'KursusController');

        // Route Pendaftar
        Route::get('pendaftar/trash', 'PendaftarController@trash')->name('pendaftar.trash');
        Route::resource('pendaftar', 'PendaftarController');

        // Route Gallery
        Route::resource('gallery', 'GalleryController');

        // Route Order
        Route::get('order/{id}/set-status', 'OrderController@setStatus')
            ->name('order.status');
        Route::resource('order', 'OrderController');
    });


// Route Front
Route::get('/', 'Web\FrontController@index')->name('front.index');
Route::get('/kursus', 'Web\FrontController@kursus')->name('front.kursus');
Route::get('/kursus/{slug}', 'Web\FrontController@show')->name('front.detail');


// Route Order
Route::post('/order/post', 'Web\OrderController@orderPost')->name('order.post');
Route::get('/order/success', 'Web\OrderController@success')->name('order.success');
Route::get('/order/cart', 'Web\OrderController@view')->name('order.view');
Route::get('/order/cart/pending', 'Web\OrderController@updateToPending')->name('order.update.cancel');
Route::delete('/order/cart/{id}', 'Web\OrderController@updateToDelete')->name('order.delete.pesanan');
Route::post('/order/cart/upload_bukti', 'Web\OrderController@uploadFile')->name('order.post.pembayaran');
Route::patch('/order/cart/upload_bukti', 'Web\OrderController@updateFile')->name('order.patch.pembayaran');
Route::delete('/order/checkout/{id}', 'Web\OrderController@deleteCheckout')->name('order.delete.checkout');

Route::get('/user/kursus', 'Web\KursusUserController@kursus_success')->name('user.kursus.success');
Route::get('/user/kursus/{slug}', 'Web\KursusUserController@kursusKelas')->middleware('user.kursus')->name('user.kursus.kelas');
// Route::get('/user/kursus/{slug}/komentar', 'Web\KursusUserController@kursusKelasKomentar')->name('user.kursus.komentar');
Route::post('/user/kursus/{slug}', 'Web\KursusUserController@kursusKelasKomentar')->name('user.kursus.komentar');
