<?php

use App\Http\Controllers\AlternatifController;
use App\Http\Controllers\FaktorController;
use App\Http\Controllers\HakAksesController;
use App\Http\Controllers\KriteriaController;
use App\Http\Controllers\SubkriteriaController;
use App\Models\AlternativeData;
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

Route::get('/', function () {
    return view('auth.loginNew');
})->name('/');
Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->group(function () {

    Route::resource('faktor', FaktorController::class)->only('index');
    Route::resource('criteria', KriteriaController::class)->only('index');
    Route::resource('subkriteria', SubkriteriaController::class)->only('index');
    Route::resource('alternatif', AlternatifController::class);
    Route::get('/laporan-alternatif', [AlternatifController::class, 'laporan'])->name('laporan-alternatif');
    Route::get('/manage-checked', [AlternatifController::class, 'ManageChecked'])->name('manage-checked');
    Route::get('/multiple-manage-checked', [AlternatifController::class, 'MultipleManageChecked'])->name('multiple-manage-checked');

    Route::get('/export-excel', [AlternatifController::class, 'exportExcel'])->name('export.excel');




    Route::middleware('checkrole:1')->group(function () {
        Route::resource('faktor', FaktorController::class)->only(['edit', 'create', 'store', 'update', 'destroy']);
        Route::resource('criteria', KriteriaController::class)->only(['edit', 'create', 'store', 'update', 'destroy']);
        Route::resource('subkriteria', SubkriteriaController::class)->only(['edit', 'create', 'store', 'update', 'destroy']);
        Route::resource('hak-akses', HakAksesController::class);
        Route::get('/edit-hak-akses/{id}', [App\Http\Controllers\HakAksesController::class, 'edit'])->name('edit-hak-akses');
        Route::put('/update-hak-akses/{id}', [App\Http\Controllers\HakAksesController::class, 'update'])->name('update-hak-akses');
        // Route::delete('/delete/{id}', [App\Http\Controllers\HakAksesController::class, 'deleteUser'])->name('delete-hak-akses');
    });


    Route::get('/nilai-ideal', [App\Http\Controllers\NilaiIdealController::class, 'index'])->name('nilai-ideal');
    Route::post('/nilai-ideal', [App\Http\Controllers\NilaiIdealController::class, 'store'])->name('nilai-ideal-store');
    Route::get('/edit-nilai-ideal/{id}', [App\Http\Controllers\NilaiIdealController::class, 'edit'])->name('nilai-ideal-edit');
    Route::post('/update-nilai-ideal/{id}', [App\Http\Controllers\NilaiIdealController::class, 'update'])->name('nilai-ideal-update');
    Route::delete('/deleteIdeal/{id}', [App\Http\Controllers\NilaiIdealController::class, 'destroy'])->name('nilai-ideal-delete');

    Route::get('/bobot-nilai-gap', [App\Http\Controllers\NilaiGapController::class, 'index'])->name('bobot-nilai-gap');
    Route::post('/bobot-nilai-gap', [App\Http\Controllers\NilaiGapController::class, 'store'])->name('bobot-nilai-gap-store');
    Route::get('/edit-bobot-nilai-gap/{id}', [App\Http\Controllers\NilaiGapController::class, 'edit'])->name('bobot-nilai-gap-edit');
    Route::post('/update-bobot-nilai-gap/{id}', [App\Http\Controllers\NilaiGapController::class, 'update'])->name('bobot-nilai-gap-update');
    Route::delete('/deleteGap/{id}', [App\Http\Controllers\NilaiGapController::class, 'destroy'])->name('bobot-nilai-gap-delete');


    Route::get('/perhitungan', [App\Http\Controllers\PerhitunganController::class, 'perhitungan'])->name('perhitungan');
    Route::middleware('checkrole:2')->group(function () {
        Route::get('/detail-perhitungan', [App\Http\Controllers\PerhitunganController::class, 'detail'])->name('perhitungan-detail');
        Route::get('/hitung', [App\Http\Controllers\PerhitunganController::class, 'index'])->name('perhitungan-index');
        Route::post('/proses-hitung', [App\Http\Controllers\PerhitunganController::class, 'perhitungan'])->name('proses-hitung');

    });

    Route::get('/hasil', [App\Http\Controllers\HasilController::class, 'index'])->name('list-hasil');
    Route::get('/hasil-detail/{id}', [App\Http\Controllers\HasilController::class, 'detail'])->name('hasil-detail');
    Route::delete('/hasil-delete/{id}', [App\Http\Controllers\HasilController::class, 'destroy'])->name('hasil-delete');
    Route::get('/laporan-hasilperhitungan/{id}', [App\Http\Controllers\HasilController::class, 'laporan'])->name('laporan-hasilperhitungan');
    Route::get('/export-excel-perhitungan/{id}', [App\Http\Controllers\HasilController::class, 'exportExcel'])->name('export-excel-perhitungan');



    Route::prefix('hak-akses')->group(function () {
    });
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
