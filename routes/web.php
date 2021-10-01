<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\DashboardController;
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
});
Route::get('api/get-sub-category-list/{cat_id}',[ProductController::class,'getSubCategory']);  

