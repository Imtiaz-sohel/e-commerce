<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\BillController;
use App\Http\Controllers\BlogcommentController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\FeaturedProductController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SizeController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WishlistController;
use Illuminate\Support\Facades\Redirect;
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

require __DIR__.'/auth.php';
// ROLE CONTROLLER STARTS
Route::get('/all-permission',[RoleController::class,'allPermission'])->name('permission');
Route::post('/all-permission-post',[RoleController::class,'permissionPost'])->name('permissionPost');
Route::get('/all-permission-edit/{permission_id}',[RoleController::class,'permissionEdit'])->name('permissionEdit');
Route::post('/all-permission-update',[RoleController::class,'permissionUpdatePost'])->name('permissionUpdatePost');
Route::get('/all-permission-delete/{permission_id}',[RoleController::class,'permissionDelete'])->name('permissionDelete');
Route::get('/all-role',[RoleController::class,'allRole'])->name('allRole');
Route::post('/all-role-post',[RoleController::class,'rolePost'])->name('rolePost');
Route::get('/all-role-edit/{role_id}',[RoleController::class,'roleEdit'])->name('roleEdit');
Route::post('/all-role-update',[RoleController::class,'roleUpdate'])->name('roleUpdate');
Route::get('/all-role-delete/{role_id}',[RoleController::class,'roleDelete'])->name('roleDelete');
Route::get('/role-sync-permission',[RoleController::class,'roleSyncPermission'])->name('roleSyncPermission');
Route::post('/role-sync-post',[RoleController::class,'roleSyncPost'])->name('roleSyncPost');
Route::get('/role-sync-user',[RoleController::class,'roleSyncUser'])->name('roleSyncUser');
Route::post('/role-sync-user-post',[RoleController::class,'roleSyncUserPost'])->name('roleSyncUserPost');

// DASHBOARD CONTROLLER STARTS
Route::group(['middleware'=>['role:admin|writter|editor|viewer'],'prefix'=>'admin'],function(){
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
// BILL CONTROLLER STARTS
   Route::get('/all-bill',[BillController::class,'allBill'])->name('allBill');   
   Route::get('/all-order-by-bill/{billing_id}',[BillController::class,'orderByBill'])->name('orderByBill');   
   Route::get('/shipping/{billing_id}',[BillController::class,'shipping'])->name('shipping');   
   Route::get('/bill-search',[BillController::class,'billSearch'])->name('billSearch');   
   Route::get('/bill-download',[BillController::class,'billDownload'])->name('billDownload');
//FAQ CONTROLLER STARTS
   Route::resource('/faq',FaqController::class);
//BLOG CONTROLLER STARTS
   Route::resource('/blog',BlogController::class);
   Route::get('/blog-trash',[BlogController::class,'blogTrash'])->name('blogTrash');    
   Route::get('/blog-delete/{id}',[BlogController::class,'blogDelete'])->name('blogDelete');    
   Route::get('/blog-restore/{id}',[BlogController::class,'blogRestore'])->name('blogRestore');    
   Route::get('/blog-status/{id}',[BlogController::class,'blogStatus'])->name('blogStatus');    
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
Route::get('/api/get-state-list/{country_id}',[CheckoutController::class,'getStateList']);
Route::get('/api/get-city-list/{state_id}',[CheckoutController::class,'getCityList']);
Route::post('/checkout-post',[CheckoutController::class,'checkoutPost'])->name('checkoutPost');
Route::get('/order-product/{billing_id}',[CheckoutController::class,'orderConfimed'])->name('orderConfirmed');
// REVIEW CONTROLLE STARTS
Route::post('/review-post',[ReviewController::class,'ReviewPost'])->name('ReviewPost');
// faq
Route::get('/faq',[ReviewController::class,'faq'])->name('faq');
// blog
Route::get('/blog',[ReviewController::class,'blogView'])->name('blogView');
Route::get('/single-blog/{slug}',[ReviewController::class,'singleBlog'])->name('singleBlog');
Route::get('/blog-by-category/{id}',[ReviewController::class,'blogByCategory'])->name('blogByCategory');
// BLOG COMMENT CONTROLLER STARTS
Route::post('/blog-comment',[BlogcommentController::class,'blogComment'])->name('blogComment');
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