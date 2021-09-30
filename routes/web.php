<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
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
});

