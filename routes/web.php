<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\AlatController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::controller(AdminController::class)->group(function () {
    route::post('admin', 'admin')->name('admin');
    route::post('profile/{id}', 'updateData')->name('updateData');
    route::post('data-user', 'updateAdmin')->name('updateAdmin');
    route::get('profile', 'show');
    route::get('/', 'login');
    route::get('index', 'indexAdmin');
    route::get('indexC', 'indexAdmin')->name('index');
    route::get('getLatestData', 'getLatestData');
    route::get('tabelIndex', 'tabelIndex');
    route::get('data-user', 'list');
    // route::get('/login', 'login')->name('login');
    route::get('admin.index', 'indexAdmin')->name('indexAdmin');
});

Route::controller(AlatController::class)->group(function () {
    route::get('/mlantai', 'monitoringLantai');
    route::get('/malat', 'monitoringPeralat');
    // route::get('/mlantai', 'fetchData')->name('fetchData');
    Route::get('/cari{floor}', 'cariData');
    Route::get('/alat{code}', 'Alat');
    Route::get('/get-data', 'getData');
    Route::get('/get-lantai', 'getLantai');
    route::get('/current', 'monitoringCurrent');
    route::get('/power', 'monitoringPower');
    route::get('/voltage', 'monitoringVolt');
    route::get('cari', 'cari');
    route::get('/perangkat', 'monitoringAlat');
    route::get('tambah-perangkat', 'store');
    route::get('hapus/{id_alat}', 'hapus');
    route::post('edit/{id_alat}', 'edit')->name('edit');
    route::post('update/{id_alat}', 'update')->name('update');
    route::post('tambah', 'tambah')->name('tambah');
});

Route::controller(ApiController::class)->group(function() {

});
Route::middleware(['auth', 'checkSessionExpiration'])->group(function () {
    // Routes that require authentication and session expiration check
});

// Route::get('/', function () {
//     return view('landing');
// });

Route::get('/log', function () {
    return view('admin.laporan/log');
});






// Route::get('/kalkulasi', function () {
//     return view('monitoring/kalkulasi');
// });

// ;


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
