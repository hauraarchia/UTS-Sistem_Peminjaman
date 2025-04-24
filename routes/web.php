<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\RentalController;

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

// Route::get('/', function () {
//     return view('welcome');
Route::get('/', [WelcomeController::class, 'index']);
//route kategori
Route::group(['prefix' => 'kategori'], function () {
    Route::get('/', [KategoriController::class, 'index']); //menampilkan halamann awal user
    Route::post('/list', [KategoriController::class, 'list']); //menampilkan data user dalam bentuk json untuk datatables
    Route::get('/create_ajax', [KategoriController::class, 'create_ajax']); //menampilkan halaman form tambah user ajax
    Route::post('/ajax', [KategoriController::class, 'store_ajax']); //menyimpan data user baru ajax
    Route::get('/{id}/edit_ajax', [KategoriController::class, 'edit_ajax']); //menampilkan halaman form edit user ajax
    Route::put('/{id}/update_ajax', [KategoriController::class, 'update_ajax']); //menyimpan perubahan data user ajax
    Route::get('/{id}/delete_ajax', [KategoriController::class, 'confirm_ajax']); //untuk menampilkan form confirm delete user ajax
    Route::delete('/{id}/delete_ajax', [KategoriController::class, 'delete_ajax']); //menghapus data user ajax
    Route::get('/{id}/show_ajax', [KategoriController::class, 'show_ajax']); //detail user ajax
}); 

//route rental
Route::group(['prefix' => 'rental'], function () {
    Route::get('/', [RentalController::class, 'index']); //menampilkan halamann awal user
    Route::post('/list', [RentalController::class, 'list']); //menampilkan data user dalam bentuk json untuk datatables
    Route::get('/create_ajax', [RentalController::class, 'create_ajax']); //menampilkan halaman form tambah user ajax
    Route::post('/ajax', [RentalController::class, 'store_ajax']); //menyimpan data user baru ajax
    Route::get('/{id}/edit_ajax', [RentalController::class, 'edit_ajax']); //menampilkan halaman form edit user ajax
    Route::put('/{id}/update_ajax', [RentalController::class, 'update_ajax']); //menyimpan perubahan data user ajax
    Route::get('/{id}/delete_ajax', [RentalController::class, 'confirm_ajax']); //untuk menampilkan form confirm delete user ajax
    Route::delete('/{id}/delete_ajax', [RentalController::class, 'delete_ajax']); //menghapus data user ajax
    Route::get('/{id}/show_ajax', [RentalController::class, 'show_ajax']); //detail user ajaxRoute::delete('/{id}/show_ajax'
});

//route mahasiswa
Route::group(['prefix' => 'mahasiswa'], function () {
    Route::get('/', [MahasiswaController::class, 'index']); //menampilkan halamann awal user
    Route::post('/list', [MahasiswaController::class, 'list']); //menampilkan data user dalam bentuk json untuk datatables
    Route::get('/create_ajax', [MahasiswaController::class, 'create_ajax']); //menampilkan halaman form tambah user ajax
    Route::post('/ajax', [MahasiswaController::class, 'store_ajax']); //menyimpan data user baru ajax
    Route::get('/{id}/edit_ajax', [MahasiswaController::class, 'edit_ajax']); //menampilkan halaman form edit user ajax
    Route::put('/{id}/update_ajax', [MahasiswaController::class, 'update_ajax']); //menyimpan perubahan data user ajax
    Route::get('/{id}/delete_ajax', [MahasiswaController::class, 'confirm_ajax']); //untuk menampilkan form confirm delete user ajax
    Route::delete('/{id}/delete_ajax', [MahasiswaController::class, 'delete_ajax']); //menghapus data user ajax
    Route::get('/{id}/show_ajax', [MahasiswaController::class, 'show_ajax']); 
});


