<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontEndController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\AdminController;





Route::controller(FrontEndController::class)->group(function(){
    Route::get('/','homePage')->name('home-page');
});

Route::controller(FrontEndController::class)->group(function(){
    Route::get('/location-vehicule','ListLocationPage')->name('location-vehicule');
});

Route::controller(FrontEndController::class)->group(function(){
    Route::get('/vente-vehicule','ListVentePage')->name('vente-vehicule');
});

Route::controller(FrontEndController::class)->group(function(){
    Route::get('/detail-location/{idLocation}', 'DetailLocation')->name('detail-location');
});


Route::controller(FrontEndController::class)->group(function(){
    Route::get('/detail-vehicule/{idVendre}','DetailVente')->name('detail-vehicule');
});

Route::controller(FrontEndController::class)->group(function(){
    Route::get('/politique-confidentialite','PolitiqueConfidentialite')->name('politique-confidentialite');
});

Route::controller(FrontEndController::class)->group(function(){
    Route::get('/conditions-generales','ConditionsGenerales')->name('conditions-generales');
});

    
    Route::middleware(['guest:admin','PreventBackHistory'])->group(function(){
        Route::view('/Connexion','back.pages.admin.auth.login')->name('login');
    });



   Route::middleware(['guest:user','PreventBackHistory'])->group(function(){
       Route::controller(UserController::class)->group(function(){
          Route::get('/Connexion',[UserController::class, 'login'])->name('login');
       });
   });




// Route::get('/', function () {
//     return view('welcome');
// });
Route::view('/example-page','example-page');
Route::view('/example-auth','example-auth');
Route::view('/locationtets','locationtets');
Route::view('example-frontend','example-frontend');

require __DIR__.'/admin.php';
require __DIR__.'/user.php';
