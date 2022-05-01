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


Route::get('/', [App\Http\Controllers\nonracikanController::class, 'index'])->name('non_racikan.index');
Route::get('/non_racikan/obat', [App\Http\Controllers\nonracikanController::class, 'getObat'])->name('non_racikan.obat');
Route::post('/non_racikan/obat/{obat_id}', [App\Http\Controllers\nonracikanController::class, 'getQty'])->name('non_racikan.qty');
Route::get('/non_racikan/resep', [App\Http\Controllers\nonracikanController::class, 'getResep'])->name('non_racikan.resep');
Route::post('/non_racikan/create', [App\Http\Controllers\nonracikanController::class, 'create'])->name('non_racikan.create');
Route::get('/non_racikan/pdf/{id}', [App\Http\Controllers\nonracikanController::class, 'pdf'])->name('non_racikan.pdf');

Route::get('/racikan', [App\Http\Controllers\racikanController::class, 'index'])->name('racikan.index');
Route::get('/racikan/obat', [App\Http\Controllers\racikanController::class, 'getObat'])->name('racikan.obat');
Route::post('/racikan/obat/{obat_racikan}', [App\Http\Controllers\racikanController::class, 'getQty'])->name('racikan.qty');
Route::get('/racikan/resep', [App\Http\Controllers\racikanController::class, 'getResep'])->name('racikan.resep');
Route::post('/racikan/create', [App\Http\Controllers\racikanController::class, 'create'])->name('racikan.create');
Route::get('/racikan/pdf/{id}', [App\Http\Controllers\racikanController::class, 'pdf'])->name('racikan.pdf');
