<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoriesController;

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
// Here is where the home page render with the card data
Route::get('/', [HomeController::class, 'index'])->name('main');
//Here is where the single gun show
Route::get('showgun/{id}',[ProductController::class, 'showGun'])->name('singleGun.show');
//Here is where the single accessory show
Route::get('showaccessory/{id}',[ProductController::class, 'showAccessory'])->name('singleAccessory.show');
//Here is where the list of gun show in cards
Route::get('listGuns/{id}',[ProductController::class, 'indexGun'])->name('gun.showAll');
//Here is where the list of accessory show in cards
Route::get('listAccessories/{id}',[ProductController::class, 'indexAccessory'])->name('accessory.showAll');
//Here is where the admin dashboard render.
Route::get('admin', [AdminController::class, 'index'])->name('admin.dashboard');

Route::get('admin/manageGun', [ProductController::class, 'indexGunAdmin'])->name('manage.gun');
Route::get('admin/manageCategories', [CategoriesController::class, 'index'])->name('manage.categories');
Route::get('admin/manageGunCategories-form', [CategoriesController::class, 'createGun'])->name('manageGun.categories-form');
Route::post('admin/manageGunCategories-form', [CategoriesController::class, 'storeGun'])->name('manageGun.categories.store');
Route::get('admin/updateGunCategories-form/{id}', [CategoriesController::class, 'editGun'])->name('updateGun.form');
Route::post('admin/updateGunCategories-form/{id}', [CategoriesController::class, 'updateGun'])->name('updateGun.form');


Route::get('admin/manageAccessoryCategories-form', [CategoriesController::class, 'createAccessory'])->name('manageAccessory.categories-form');

Route::post('admin/manageAccessoryCategories-form', [CategoriesController::class, 'storeAccessory'])->name('manageAccessory.categories.store');