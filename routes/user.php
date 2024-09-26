<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\ProductController;
use App\Http\Controllers\User\LocationController;
use App\Http\Controllers\User\VendreController;
use App\Http\Controllers\AbonnementController;





Route::prefix('user')->name('user.')->group(function(){

   Route::middleware(['guest:user','PreventBackHistory'])->group(function(){
       Route::controller(UserController::class)->group(function(){
          Route::get('/Connexion',[UserController::class, 'login'])->name('login');
          Route::post('/login-handler','loginHandler')->name('login-handler');
          Route::get('/register','register')->name('register');
          Route::post('/create','createUser')->name('create');
          Route::get('/account/verify/{token}','verifyAccount')->name('verify');
          Route::get('/register-success','registerSuccess')->name('register-success');
          Route::get('/forgot-password','forgotPassword')->name('forgot-password');
          Route::post('/send-password-reset-link','sendPasswordResetLink')->name('send-password-reset-link');
          Route::get('/password/reset/{token}','showResetForm')->name('reset-password');
          Route::post('/reset-password-handler','resetPasswordHandler')->name('reset-password-handler');
       });
   });

   Route::middleware(['auth:user','PreventBackHistory'])->group(function(){

       Route::controller(UserController::class)->group(function(){
          Route::get('/','home')->name('home');
          Route::post('/valider-abonnement',[AbonnementController::class, 'store'])->name('valider-abonnement');
          Route::get('payment/success', [AbonnementController::class, 'success'])->name('payment.success');
          Route::post('payment/notify', [AbonnementController::class, 'notify'])->name('payment.notify');
          Route::get('/list','listproduct')->name('listproduct');
          Route::post('/logout','logoutHandler')->name('logout');
          Route::get('/profile','profileView')->name('profile');
         Route::post('/change-profile-picture',[UserController::class,'changeProfilePicture'])->name('change-profile-picture');
          Route::get('/concession-settings','concessionSettings')->name('concession-settings');
          Route::post('/concession-setup','concessionSetup')->name('concession-setup');
       });

       //Product routes
       Route::prefix('product')->name('product.')->group(function(){
           Route::controller(ProductController::class)->group(function(){
              Route::get('/all','allProducts')->name('all-products');
              Route::get('/add','addProduct')->name('add-product');
              Route::get('/get-product-category','getProductCategory')->name('get-product-category');
              Route::post('/create','createProduct')->name('create-product');
              Route::get('/edit','editProduct')->name('edit-product');
              Route::post('/update','updateProduct')->name('update-product');
              Route::post('/upload-images','uploadProductImages')->name('upload-images');
              Route::get('/get-product-images','getProductImages')->name('get-product-images');
              Route::post('/delete-product-image','deleteProductImage')->name('delete-product-image');
              Route::post('/delete-product','deleteProduct')->name('delete-product');
           });
       });


       Route::prefix('location')->name('location.')->group(function(){
           Route::controller(LocationController::class)->group(function(){
              Route::get('/all','allLocations')->name('all-locations');
              Route::get('/add','addLocation')->name('add-location');

              Route::get('/get-location-category','getLocationCategory')->name('get-location-category');
              Route::post('/create','createLocation')->name('create-location');
              Route::get('/edit/{idLocation}',[LocationController::class, 'editLocation'])->name('edit-location');

              Route::post('/update','updateLocation')->name('update-location');
              Route::post('/delete-location','deleteLocation')->name('delete-location');
           });
       });


       Route::prefix('vendre')->name('vendre.')->group(function(){
           Route::controller(VendreController::class)->group(function(){
              Route::get('/tous','allVentes')->name('all-vendres');
              Route::get('/add','addvehicule')->name('add-vehicule');
   
              Route::get('/get-vendre-category','getVendreCategory')->name('get-vendre-category');
              Route::post('/create','createVendre')->name('create-vendre');
              Route::get('/edit/{idVendre}', [VendreController::class, 'editVentes'])->name('edit-vendre');

              Route::post('/update','updateVendre')->name('update-vendre');
              Route::post('/delete-vendre','deleteVendre')->name('delete-vendre');
           });
       });



   });

});


// Authentication Routes (Guest Middleware)
// Route::prefix('user')->name('user.')->middleware('guest:user')->group(function () {
//     Route::controller(UserController::class)->group(function () {
//         Route::get('/login', 'login')->name('login');
//         Route::post('/login', 'loginHandler')->name('login-handler');
//         Route::get('/register', 'register')->name('register');
//         Route::post('/register', 'createUser')->name('create');
//         Route::get('/account/verify/{token}', 'verifyAccount')->name('verify');
//         Route::get('/register-success', 'registerSuccess')->name('register-success');
//         Route::get('/forgot-password', 'forgotPassword')->name('forgot-password');
//         Route::post('/send-password-reset-link', 'sendPasswordResetLink')->name('send-password-reset-link');
//         Route::get('/password/reset/{token}', 'showResetForm')->name('reset-password');
//         Route::post('/password/reset', 'resetPasswordHandler')->name('reset-password-handler');
//     });
// });

// // User Routes (Authenticated Middleware)
// Route::prefix('user')->name('user.')->middleware('auth:user')->group(function () {
//     Route::controller(UserController::class)->group(function () {
//         Route::get('/', 'home')->name('home');
//         Route::post('/logout', 'logoutHandler')->name('logout');
//         Route::get('/profile', 'profileView')->name('profile');
//         Route::post('/profile/change-picture', 'changeProfilePicture')->name('change-profile-picture');
//         Route::get('/shop-settings', 'shopSettings')->name('shop-settings');
//         Route::post('/shop-setup', 'shopSetup')->name('shop-setup');
//     });

//     // Product Routes (Nested Prefix and Controller)
//     Route::prefix('product')->name('product.')->group(function () {
//         Route::controller(ProductController::class)->group(function () {
//             Route::get('/all', 'allProducts')->name('all-products');
//             Route::get('/add', 'addProduct')->name('add-product');
//             Route::get('/get-category', 'getProductCategory')->name('get-product-category'); // Assuming this is for categories
//             Route::post('/create', 'createProduct')->name('create-product');
//             Route::get('/edit/{id}', 'editProduct')->name('edit-product'); // Using ID for edit route
//             Route::post('/update/{id}', 'updateProduct')->name('update-product'); // Using ID for update route
//             Route::post('/upload-images', 'uploadProductImages')->name('upload-images');
//             Route::get('/get-images/{id}', 'getProductImages')->name('get-product-images'); // Using ID for get images route
//             Route::post('/delete-image/{id}', 'deleteProductImage')->name('delete-product-image'); // Using ID for delete image route
//             Route::post('/delete/{id}', 'deleteProduct')->name('delete-product'); // Using ID for delete product route
//         });
//     });
// });
