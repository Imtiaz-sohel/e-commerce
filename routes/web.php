<?php

use App\Http\Controllers\BannerController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FeaturedProductController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SizeController;
use App\Http\Controllers\SubCategoryController;
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

Route::get('/', function () {
    return view('welcome');
});

require __DIR__.'/auth.php';

// DASHBOARD CONTROLLER STARTS
Route::group(['middleware'=>'auth','prefix'=>'admin'],function(){
  Route::get('/dashboard',[DashboardController::class,'dashboard'])->name('dashboard');
//CATEGORY CONTROLLER    
  Route::resource('/category',CategoryController::class);
  Route::get('/category-trash/{id}',[CategoryController::class,'categoryRestore'])->name('categoryRestore');
  Route::get('/category-per-delete/{id}',[CategoryController::class,'categoryPerDelete'])->name('categoryPerDelete');
  Route::get('/category-status/{id}',[CategoryController::class,'categoryStatus'])->name('categoryStatus');

//SUBCATEGORY CONTROLLER
  //set url in only one word 
  Route::resource('/sub-category',SubCategoryController::class);
  Route::get('/subcategory-status/{id}',[SubCategoryController::class,'subcategoryStatus'])->name('subcategoryStatus');   
  Route::get('/subcategory-restore/{id}',[SubCategoryController::class,'subCategoryRestore'])->name('subCategoryRestore');   
  Route::get('/subcategory-per-delete/{id}',[SubCategoryController::class,'subCategoryPerDelete'])->name('subCategoryPerDelete');
//COLOR CONROLLER   
  Route::resource('/color',ColorController::class);
  Route::get('/color-status/{id}',[ColorController::class,'colorStatus'])->name('colorStatus');   
  Route::get('/color-restore/{id}',[ColorController::class,'colorRestore'])->name('colorRestore');   
  Route::get('/color-per-delete/{id}',[ColorController::class,'colorPerDelete'])->name('colorPerDelete'); 
//SIZE CONTROLLER
  Route::resource('size',SizeController::class);
  Route::get('/size-status/{id}',[SizeController::class,'sizeStatus'])->name('sizeStatus');
  Route::get('/size-restore/{id}',[SizeController::class,'sizeRestore'])->name('sizeRestore'); 
  Route::get('/size-per-delete/{id}',[SizeController::class,'sizePerDelete'])->name('sizePerDelete');
//BRAND CONTROLLER STARTS
  Route::resource('/brand',BrandController::class);
  Route::get('/brand-status/{id}',[BrandController::class,'brandStatus'])->name('brandStatus');     
  Route::get('/brand-restore/{id}',[BrandController::class,'brandRestore'])->name('brandRestore');     
  Route::get('/brand-permanent-delete/{id}',[BrandController::class,'brandPermanent'])->name('brandPermanent');
//PRODUCT CONTROLLER STARTS
  Route::resource('/product',ProductController::class);
  Route::get('/product-trash',[ProductController::class,'productTrash'])->name('productTrash');
  Route::get('/product-restore/{id}',[ProductController::class,'productRestore'])->name('productRestore');
  Route::get('/product-per-delete/{id}',[ProductController::class,'productPerDelete'])->name('productPerDelete');
// BANNER CONTROLLER STARTS
  Route::resource('/banner',BannerController::class);
  Route::get('/banner-status/{id}',[BannerController::class,'bannerStatus'])->name('bannerStatus');
  Route::get('/banner-trash',[BannerController::class,'bannerTrash'])->name('bannerTrash');
  Route::get('/banner-restore/{id}',[BannerController::class,'bannerRestore'])->name('bannerRestore');
  Route::get('/banner-per-delete/{id}',[BannerController::class,'bannerPerDelete'])->name('bannerPerDelete');
});
//FEATURED PRODUCT CONTROLLER STARTS
Route::resource('/freatued-product',FeaturedProductController::class);




Route::get('api/get-sub-category-list/{cat_id}',[ProductController::class,'getSubCategory']);
// LARAVEL FILE MANAGER STARTS 
Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});

