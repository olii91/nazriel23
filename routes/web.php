<?php

use App\Http\Middleware\Admin;
use App\Http\Middleware\Role;
use Illuminate\Support\Facades\Auth;
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

Auth::routes();

Route::get('/', function () {
    return view('welcome');
})->name('welcome');
Route::get('/pilihlogin', function () {
    return view('pilih');
})->name('pilih');

Route::get('/home', [
    App\Http\Controllers\HomeController::class, 'index'
])->name('home');

Route::get('/masyarakat/login', [
    'uses' => 'App\Http\Controllers\MasyarakatLoginController@index',
    'as' => 'masyarakat.login'
]);

Route::get('/masyarakat/register', [
    'uses' => 'App\Http\Controllers\MasyarakatLoginController@register',
    'as' => 'masyarakat.register'
]);

Route::post('/masyarakat/action-login', [
    'uses' => 'App\Http\Controllers\MasyarakatLoginController@actionlogin',
    'as' => 'masyarakat.action-login'
]);

Route::post('/masyarakat/action-register', [
    'uses' => 'App\Http\Controllers\MasyarakatLoginController@actionregister',
    'as' => 'masyarakat.action-register'
]);

Route::resource('pengaduan',App\Http\Controllers\PengaduanController::class)->middleware(['isMasyarakat']);
Route::resource('pengaduansaya',App\Http\Controllers\PengaduanSayaController::class)->middleware(['isMasyarakat']);
Route::resource('masyarakat',App\Http\Controllers\MasyarakatController::class)->middleware(['isAdmin']);
Route::resource('user',App\Http\Controllers\UserController::class)->middleware(['isAdmin']);
Route::resource('pengaduanadmin',App\Http\Controllers\PengaduanAdminController::class);

Route::post('/tanggapan/createOrUpdate', [
    App\Http\Controllers\TanggapanController::class, 'createOrUpdate'
])->name('tanggapan.createOrUpdate');

Route::get('/laporan', [
    App\Http\Controllers\LaporanController::class, 'index'
])->middleware(['isAdmin'])->name('laporan.index');

Route::get('/cetak/{from}/{to}', [
    App\Http\Controllers\LaporanController::class, 'cetak'
])->middleware(['isAdmin'])->name('laporan.cetak');

