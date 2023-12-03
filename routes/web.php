<?php

use Illuminate\Support\Facades\Route;

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
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionsController;
// 
use App\Http\Controllers\JurusanController;
use App\Http\Controllers\ProdiController;
use App\Http\Controllers\BobotController;
use App\Http\Controllers\KriteriaController;
use App\Http\Controllers\PerhitunganController;

            

Route::get('/',[WelcomeController::class, 'index'])->middleware('guest')->name('welcome');
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth')->name('dashboard');
Route::get('sign-up', [RegisterController::class, 'create'])->middleware('guest')->name('register');
Route::post('sign-up', [RegisterController::class, 'store'])->middleware('guest');
Route::get('sign-in', [SessionsController::class, 'create'])->middleware('guest')->name('login');
Route::post('sign-in', [SessionsController::class, 'store'])->middleware('guest');
Route::post('sign-out', [SessionsController::class, 'destroy'])->middleware('auth')->name('logout');

Route::get('profile', [ProfileController::class, 'create'])->middleware('auth')->name('profile');
Route::post('user-profile', [ProfileController::class, 'update'])->middleware('auth');

// perhitungan guest
Route::post('perhitungan/spk-electre', [PerhitunganController::class, 'spkElectre'])->name('spk-perhitungan');
Route::get('perhitungan/result/{id_perhitungan}', [PerhitunganController::class, 'result'])->name('result-perhitungan');

// jurusan and prodi view
Route::get('show-jurusan/{id_jurusan}', [JurusanController::class, 'show'])->name('show-jurusan');
Route::get('show-prodi/{id_prodi}', [ProdiController::class, 'show'])->name('show-prodi');


Route::group(['middleware' => 'auth'], function () {
	Route::get('user-management', function () {
		return view('pages.akun.user-management');
	})->name('user-management');
	Route::get('user-profile', function () {
		return view('pages.akun.user-profile');
	})->name('user-profile');

	// Jurusan
	Route::get('jurusan', [JurusanController::class, 'index'])->middleware('auth')->name('jurusan');
	Route::get('create-jurusan', [JurusanController::class, 'create'])->middleware('auth')->name('create-jurusan');
	Route::post('create-jurusan', [JurusanController::class, 'store'])->middleware('auth')->name('create-jurusan');
	Route::get('edit-jurusan/{id_jurusan}', [JurusanController::class, 'edit'])->middleware('auth')->name('edit-jurusan');
	Route::post('edit-jurusan/{id_jurusan}', [JurusanController::class, 'update'])->middleware('auth')->name('edit-jurusan');
	Route::get('delete-jurusan/{id_jurusan}', [JurusanController::class, 'delete'])->middleware('auth')->name('delete-jurusan');
	
	// Prodi
	Route::get('prodi', [ProdiController::class, 'index'])->middleware('auth')->name('prodi');
	Route::get('create-prodi', [ProdiController::class, 'create'])->middleware('auth')->name('create-prodi');
	Route::post('create-prodi', [ProdiController::class, 'store'])->middleware('auth')->name('create-prodi');
	Route::get('edit-prodi/{id_prodi}', [ProdiController::class, 'edit'])->middleware('auth')->name('edit-prodi');
	Route::post('edit-prodi/{id_prodi}', [ProdiController::class, 'update'])->middleware('auth')->name('edit-prodi');
	Route::get('delete-prodi/{id_prodi}', [ProdiController::class, 'delete'])->middleware('auth')->name('delete-prodi');


	// Kriteria
	Route::get('bobot', [BobotController::class, 'index'])->middleware('auth')->name('bobot');
	Route::get('create-bobot', [BobotController::class, 'create'])->middleware('auth')->name('create-bobot');
	Route::post('create-bobot', [BobotController::class, 'store'])->middleware('auth')->name('create-bobot');
	Route::get('edit-bobot/{id_bobot}', [BobotController::class, 'edit'])->middleware('auth')->name('edit-bobot');
	Route::post('edit-bobot/{id_bobot}', [BobotController::class, 'update'])->middleware('auth')->name('edit-bobot');
	Route::get('delete-bobot/{id_bobot}', [BobotController::class, 'delete'])->middleware('auth')->name('delete-bobot');

	// Kriteria
	Route::get('kriteria', [KriteriaController::class, 'index'])->middleware('auth')->name('kriteria');
	Route::get('create-kriteria', [KriteriaController::class, 'create'])->middleware('auth')->name('create-kriteria');
	Route::post('create-kriteria', [KriteriaController::class, 'store'])->middleware('auth')->name('create-kriteria');
	Route::get('edit-kriteria/{id_kriteria}', [KriteriaController::class, 'edit'])->middleware('auth')->name('edit-kriteria');
	Route::post('edit-kriteria/{id_kriteria}', [KriteriaController::class, 'update'])->middleware('auth')->name('edit-kriteria');
	Route::get('delete-kriteria/{id_kriteria}', [KriteriaController::class, 'delete'])->middleware('auth')->name('delete-kriteria');

	// Perhitungan
	Route::get('perhitungan', [PerhitunganController::class, 'index'])->middleware('auth')->name('perhitungan');
	Route::get('perhitungan/form', [PerhitunganController::class, 'form'])->middleware('auth')->name('form-perhitungan');
	Route::get('perhitungan/detail/{id_perhitungan}', [PerhitunganController::class, 'result_detail'])->middleware('auth')->name('detail-perhitungan');
	Route::get('delete-perhitungan/{id_perhitungan}', [PerhitunganController::class, 'delete'])->middleware('auth')->name('delete-perhitungan');


});
