<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
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

Route::get('/', [HomeController::class, 'index'])->name('main');
Route::get('showgun/{id}',[ProductController::class, 'showGun'])->name('singleGun.show');
Route::get('showaccessory/{id}',[ProductController::class, 'showAccessory'])->name('singleAccessory.show');

Route::get('listGuns/{id}',[ProductController::class, 'indexGun'])->name('gun.showAll');
Route::get('listAccessories/{id}',[ProductController::class, 'indexAccessory'])->name('accessory.showAll');

Route::get('admin', [AdminController::class, 'index']);