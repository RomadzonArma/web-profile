<?php

use App\Http\Controllers\Front\LandingController;
use Illuminate\Support\Facades\Route;

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
Route::get('/', [LandingController::class, 'index'])->name('index');
Route::get('/visi-misi', [LandingController::class, 'visi_misi'])->name('visi-misi');
Route::get('/berita', [LandingController::class, 'berita'])->name('berita');
Route::get('/berita/detail/{id}', [LandingController::class, 'beritaDetail'])->name('berita.detail');
Route::get('/detail', [LandingController::class, 'detail'])->name('detail');
Route::get('/galeri', [LandingController::class, 'galeri'])->name('galeri');
Route::get('/agenda/list', [LandingController::class, 'agenda'])->name('agenda.list');
Route::get('/agenda/detail/{id}', [LandingController::class, 'agendaDetail'])->name('agenda.detail');
Route::get('/unduhan/list', [LandingController::class, 'unduhan'])->name('unduhan.list');
Route::get('/panduan', [LandingController::class, 'panduan'])->name('panduan');
Route::get('/panduan/detail/{id}', [LandingController::class, 'panduanDetail'])->name('panduan.detail');
Route::get('/pengumumans', [LandingController::class, 'pengumuman'])->name('pengumuman.list');
Route::get('/pengumumans/detail/{id}', [LandingController::class, 'pengumumanDetail'])->name('pengumuman.list');
Route::get('/regulasis', [LandingController::class, 'regulasi'])->name('regulasis');
Route::get('/regulasis/detail/{id}', [LandingController::class, 'regulasiDetail'])->name('regulasis.list');

//PROGRAM LAYANAN
Route::get('/sekolah-penggerak', [LandingController::class, 'sekolahPenggerak'])->name('sekolah-penggerak');
Route::get('/sekolah-penggerak/detail/{id}', [LandingController::class, 'sekolahPenggerakDetail'])->name('sekolah-penggerak-detail');
Route::get('/guru-penggerak', [LandingController::class, 'guruPenggerak'])->name('guru-penggerak');
Route::get('/guru-penggerak/detail/{slug}', [LandingController::class, 'guruPenggerakDetail'])->name('guru-penggerak-detail');




Route::get('/login', function () {
    return redirect()->route('login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/check-access', 'HomeController@rbacCheck')->name('check-access');
Route::post('/check-access', 'HomeController@chooseRole')->name('choose-role');
Route::get('/menus', 'HomeController@loadMenu')->name('load-menu');

// Route::middleware('auth')->group(function () {
//     Route::prefix('dashboard')->group(function () {
//     });

//     Route::prefix('users')->group(function () {
//     });

//     Route::prefix('manajemen-menu')->group(function () {
//     });

//     Route::prefix('otoritas')->group(function () {
//     });
// });
