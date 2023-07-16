<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BrandsController;
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

//Here is where the admin dashboard render.
Route::get('admin', [AdminController::class, 'index'])->name('admin.dashboard');

Route::group(['prefix' => 'admin'] , function(){
    Route::get('manageGun', [ProductController::class, 'indexGunAdmin'])->name('manage.gun');
    Route::get('addGunProduct', [ProductController::class, 'createGun'])->name('gun.create');
    Route::post('addGunProduct', [ProductController::class, 'storeGun'])->name('gun.store');
    Route::get('updateGunProduct/{id}', [ProductController::class, 'editGun'])->name('gun.edit');
    Route::put('updateGunProduct/{id}', [ProductController::class, 'updateGun'])->name('gun.update');
    Route::delete('deleteGunProduct/{id}', [ProductController::class, 'destroyGun'])->name('gun.destroy');


    Route::get('manageAccessory', [ProductController::class, 'indexAccessoryAdmin'])->name('manage.accessories');
    Route::get('addAccessory', [ProductController::class, 'createAccessory'])->name('accessory.create');
    Route::post('addAccessory', [ProductController::class, 'storeAccessory'])->name('accessory.store');
    Route::get('editAccessoryProduct/{id}', [ProductController::class, 'editAccessory'])->name('accessory.edit');
    Route::put('editAccessoryProduct/{id}', [ProductController::class, 'updateAccessory'])->name('accessory.update');
    Route::delete('deleteAccessoryProduct/{id}', [ProductController::class, 'destroyAccessory'])->name('accessory.destroy');

    
    Route::get('manageAccessoryCategories-form', [CategoriesController::class,'createAccessory'])->name('manageAccessory.categories-form');
    Route::post('manageAccessoryCategories-form', [CategoriesController::class, 'storeAccessory'])->name('manageAccessory.categories.store');
    Route::get('updateAccessoryCategories-form/{id}', [CategoriesController::class, 'editAccessory'])->name('updateAccessory.form');
    Route::post('updateAccessoryCategories-form/{id}', [CategoriesController::class, 'updateAccessory'])->name('updateAccessory.form');
    Route::delete('accessory-categories/{id}', [CategoriesController::class, 'destroyAccessory'])->name('accessory-categories.destroy');
// These routes is for the Gun Category
    Route::get('manageCategories', [CategoriesController::class, 'index'])->name('manage.categories');
    Route::get('manageGunCategories-form', [CategoriesController::class,'createGun'])->name('manageGun.categories-form');
    Route::post('manageGunCategories-form', [CategoriesController::class, 'storeGun'])->name('manageGun.categories.store');
    Route::get('updateGunCategories-form/{id}', [CategoriesController::class, 'editGun'])->name('updateGun.form');
    Route::post('updateGunCategories-form/{id}', [CategoriesController::class, 'updateGun'])->name('updateGun.form');
    Route::delete('gun-categories/{id}', [CategoriesController::class, 'destroyGun'])->name('gun-categories.destroy');

    Route::get('manage-brands', [BrandsController::class,'index'])->name('manage.brands');
    Route::get('addbrands-form', [BrandsController::class, 'create'])->name('brand.create');
    Route::post('addbrands-form', [BrandsController::class, 'store'])->name('brand.store');
    Route::get('updatebrands-form/{id}', [BrandsController::class, 'edit'])->name('brand.edit');
    Route::post('updatebrands-form/{id}', [BrandsController::class, 'update'])->name('brand.update');
    Route::delete('deletebrand/{id}', [BrandsController::class, 'destroy'])->name('brand.destroy');
});

//Here is where the single gun show
Route::get('showgun/{id}', [ProductController::class,'showGun'])->name('singleGun.show');
//Here is where the single accessory show
Route::get('showaccessory/{id}', [ProductController::class, 'showAccessory'])->name('singleAccessory.show');
//Here is where the list of gun show in cards
Route::get('listGuns/{id}', [ProductController::class, 'indexGun'])->name('gun.showAll');
//Here is where the list of accessory show in cards
Route::get('listAccessories/{id}', [ProductController::class, 'indexAccessory'])->name('accessory.showAll');