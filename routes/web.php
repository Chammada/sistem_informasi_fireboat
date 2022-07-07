<?php

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

Route::get('/', [App\Http\Controllers\UserController::class, 'loginPage'])->name('login_page')->middleware('guest');
Route::post('/login_data', [App\Http\Controllers\UserController::class, 'loginData'])->name('login_data');
Route::get('/test', [App\Http\Controllers\BerkasController::class, 'test'])->name('test');
Route::get('/register', [App\Http\Controllers\UserController::class, 'registrationPage'])->name('registration_page');
Route::post('/register_data', [App\Http\Controllers\UserController::class, 'registrationData'])->name('registration_data');

Route::group(['middleware' => ['auth']], function () {

  Route::group(['prefix' => 'user', 'middleware' => ['rolecheck:3']], function () {

    Route::get('/', [App\Http\Controllers\UserController::class, 'index'])->name('read_user');
    Route::get('/detail', [App\Http\Controllers\UserController::class, 'detailUser'])->name('detail_user');
    Route::get('/edit_page', [App\Http\Controllers\UserController::class, 'editUserPage'])->name('edit_user_page');
    Route::post('/edit_data', [App\Http\Controllers\UserController::class, 'editUserData'])->name('edit_user_data');
    Route::post('/change_status', [App\Http\Controllers\UserController::class, 'changeStatus'])->name('change_user_status');
    Route::post('/reset_password', [App\Http\Controllers\UserController::class, 'resetPassword'])->name('reset_user_password');
  });

  Route::get('/setup_profile', [App\Http\Controllers\UserController::class, 'setup_profile'])->name('setup_profile');
  Route::post('/setup_profile_data', [App\Http\Controllers\UserController::class, 'setup_profile_data'])->name('setup_profile_data');
  Route::post('/logout', [App\Http\Controllers\UserController::class, 'logout'])->name('logout');

  Route::group(['prefix' => 'berkas'], function () {

    Route::get('/', [App\Http\Controllers\BerkasController::class, 'index'])->name('dashboard');
    Route::get('/read_berkas', [App\Http\Controllers\BerkasController::class, 'readData'])->name('read_berkas');
    Route::get('/choose_category', [App\Http\Controllers\BerkasController::class, 'chooseCategory'])->name('choose_category');
    Route::get('/create_berkas', [App\Http\Controllers\BerkasController::class, 'createBerkasPage'])->name('create_berkas_page');
    Route::post('/create_berkas_data', [App\Http\Controllers\BerkasController::class, 'createBerkasData'])->name('create_berkas_data');
    Route::get('/detail_data', [App\Http\Controllers\BerkasController::class, 'detailData'])->name('detail_data_berkas');
    Route::get('/download', [App\Http\Controllers\BerkasController::class, 'downloadFile'])->name('download_file');
    Route::get('/edit_berkas_page', [App\Http\Controllers\BerkasController::class, 'editBerkasPage'])->name('edit_berkas_page');
    Route::post('/edit_data', [App\Http\Controllers\BerkasController::class, 'editBerkasData'])->name('edit_berkas_data');
    Route::post('/delete_berkas', [App\Http\Controllers\BerkasController::class, 'deleteData'])->name('delete_data_berkas');
    Route::get('/validate_berkas', [App\Http\Controllers\BerkasController::class, 'validateBerkas'])->name('validate_berkas');
    Route::get('/approved_berkas', [App\Http\Controllers\BerkasController::class, 'approvedBerkas'])->name('approved_berkas');
    Route::get('/unapproved_berkas', [App\Http\Controllers\BerkasController::class, 'unApprovedBerkas'])->name('unapproved_berkas');
    Route::get('/view_file', [App\Http\Controllers\BerkasController::class, 'viewFile'])->name('view_file');
  });
});
