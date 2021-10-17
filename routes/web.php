<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FeaturedProductController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SizeController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WishlistController;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

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

require __DIR__.'/auth.php';

// DASHBOARD CONTROLLER STARTS
Route::group(['middleware'=>'auth','prefix'=>'admin'],function(){
  Route::get('/dashboard',[DashboardController::class,'dashboardPage'])->name('dashboardPage');
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

//FEATURED PRODUCT CONTROLLER STARTS
  Route::resource('/featuredProduct',FeaturedProductController::class);
  Route::get('/featured-product-restore/{id}',[FeaturedProductController::class,'featuredRestore'])->name('featuredRestore');
  Route::get('/featured-per-delete/{id}',[FeaturedProductController::class,'featuredPerDelete'])->name('featuredPerDelete');
//TESTIMONIAL CONTROLLER STARTS
   Route::resource('/testimonial',TestimonialController::class);
   Route::get('/testimonial-restore/{id}',[TestimonialController::class,'testimonialRestore'])->name('testimonialRestore');
   Route::get('/testimonial-permanent-delete/{id}',[TestimonialController::class,'testimonialPermanentDelete'])->name('testimonialPermanentDelete');
// ABOUT US CONTROLLER STARTS
   Route::resource('/about',AboutController::class);
   Route::get('/about-restore/{id}',[AboutController::class,'aboutRestore'])->name('aboutRestore');
   Route::get('/about-per-delete/{id}',[AboutController::class,'aboutPerDelete'])->name('aboutPerDelete');
// CUSTOMER CONTACT TABLE STARTS
   Route::get('/contact',[ContactController::class,'contact'])->name('contact');
   Route::get('/contact-trash/{id}',[ContactController::class,'contactDelete'])->name('contactDelete');
   Route::get('/contact-trash-list',[ContactController::class,'contactTrash'])->name('contactTrash');
   Route::get('/contact-restore/{id}',[ContactController::class,'contactRestore'])->name('contactRestore');
   Route::get('/contact-permanent-delete/{id}',[ContactController::class,'contactPerDelete'])->name('contactPerDelete');
// COUPON CONTROLLER STARTS
   Route::resource('/coupon',CouponController::class);
   Route::get('/coupon-status/{id}',[CouponController::class,'couponStatus'])->name('couponStatus');
});

Route::get('api/get-sub-category-list/{cat_id}',[ProductController::class,'getSubCategory']);
// LARAVEL FILE MANAGER STARTS 
Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});
// USERCONTROLLER STARTS
Route::prefix('user')->group(function () {
    Route::get('/register',[UserController::class,'userRegister'])->name('userRegister');
    Route::get('/login',[UserController::class,'userLogin'])->name('userLogin');
    Route::get('/Forget-password',[UserController::class,'ForgetPassword'])->name('ForgetPassword');
});
// FRONTEND CONTROLLER STARTS
Route::get('/',[FrontendController::class,'frontPage'])->name('frontPage');
Route::get('/single-product/{slug}',[FrontendController::class,'singleProduct'])->name('singleProduct');
Route::get('/about-us',[FrontendController::class,'aboutUs'])->name('aboutUs');
Route::get('/shop-page',[FrontendController::class,'shopPage'])->name('shopPage');
Route::get('/get-product-size/{colorId}/{productId}',[FrontendController::class,'getProductSize']);
// CONTACT CONTROLLER STARTS
Route::get('/contact',[ContactController::class,'contacPage'])->name('contacPage');
Route::post('/contact-post',[ContactController::class,'contactPost'])->name('contactPost');
// CART CONTROLLER STARTS
Route::post('/product-cart',[CartController::class,'productCart'])->name('productCart');
Route::get('/cart',[CartController::class,'cartPage'])->name('cartPage');
Route::get('/cart/{slug}',[CartController::class,'cartPage'])->name('cartCouponPage');
Route::get('/cart-remove/{id}',[CartController::class,'cartRemove'])->name('cartRemove');
Route::post('/cart-update-ajax',[CartController::class,'CartUpdateAjax'])->name('CartUpdateAjax');
// WISHLIST CONTROLLER STARTS
Route::get('/wishlist',[WishlistController::class,'wishlist'])->name('wishlist');
Route::get('/add-wishlist/{product_id}',[WishlistController::class,'addTowishlist'])->name('addTowishlist');
Route::get('/wishlist-delete/{wishlist_id}',[WishlistController::class,'wishlistDelete'])->name('wishlistDelete');
// CHECKOUT CONTROLLER STARTS
Route::get('/checkout',[CheckoutController::class,'checkoutPage'])->name('checkoutPage');








// Social Login github
Route::get('login/github',[UserController::class,'redirectToGithubProvider'])->name('github');
Route::get('login/github/callback',[UserController::class,'handleProviderGithubCallback']);
// Social Login google
Route::get('login/google',[UserController::class,'redirectToGoogle'])->name('google');
Route::get('login/google/callback',[UserController::class,'handleGoogleCallback']);
// Take user same page after login
Route::get('/redirects', function () {
    return redirect(Redirect::intended()->getTargetUrl());
});