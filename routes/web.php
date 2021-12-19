<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BaptismController;
use App\Http\Controllers\BurialController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ConfirmationController;
use App\Http\Controllers\MassController;
use App\Http\Controllers\PriestController;
use App\Http\Controllers\RegisterServiceController;
use App\Http\Controllers\RegisterServicesController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WeddingController;
use App\Models\Confirmation;
use Illuminate\Support\Facades\Artisan;
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


// landing page ---------------
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::middleware(['guest'])->group(function(){
    // authenticate user login
    Route::get('/login',[AuthController::class,'index'])->name('auth.login');
    Route::post('/login/post',[AuthController::class,'store'])->name('auth.login.post');
    Route::get('/register',[AuthController::class,'register'])->name('auth.register');
    Route::post('/register/post',[AuthController::class,'create'])->name('auth.register.post');
});

//safe route ---------
Route::get('/logout',[AuthController::class,'logout'])->name('logout');

Route::middleware(['auth:client', 'preventBackHistory'])->name('client.')->prefix('client/')->group(function () {
    Route::get('/',[ClientController::class,'index'])->name('home');
    Route::get('register/form/{type}',[ClientController::class,'registerForm'])->name('registerForm');
    Route::post('register/store',[ClientController::class,'registerStore'])->name('registerStore');
    Route::get('register/slip/{registerService}',[ClientController::class,'registerSlip'])->name('registerSlip');
    Route::get('request',[ClientController::class,'requestClient'])->name('requestClient');
    Route::get('request/list',[ClientController::class,'requestList'])->name('requestList');
});

Route::middleware(['auth:web', 'preventBackHistory'])->name('admin.')->prefix('admin/')->group(function () {
     //admin controller-----
     Route::get('dashboard',[AdminController::class,'index'])->name('dashboard');

     //register client------
     Route::get('registered/client',[AdminController::class,'registerClient'])->name('registered.client');
     Route::get('registered/client/list/pending',[RegisterServiceController::class,'pending']);
     Route::get('registered/client/list/approved',[RegisterServiceController::class,'approved']);
     Route::post('/registered/client/change/status/{registerService}/{status}',[RegisterServiceController::class,'yesApproved']);
     Route::delete('/registered/client/delete/{registerService}',[RegisterServiceController::class,'destroy']);
 
     //manage priest--------
     Route::get('priest',[AdminController::class,'priest'])->name('priest');
     Route::get('priest/list',[PriestController::class,'index']);
     Route::post('priest/store',[PriestController::class,'store']);
     Route::get('priest/edit/{priest}',[PriestController::class,'edit']);
     Route::delete('priest/delete/{priest}',[PriestController::class,'destroy']);
 
     //manage user----------
     Route::get('user',[AdminController::class,'user'])->name('user');
     Route::get('user/list',[UserController::class,'index']);
     Route::post('user/store',[UserController::class,'store']);
     Route::get('user/edit/{user}',[UserController::class,'edit']);
     Route::delete('user/delete/{user}',[UserController::class,'destroy']);
 
 
     //manage schedule
     Route::get('/schedule',[AdminController::class,'schedule'])->name('schedule');
     Route::get('/schedule/list/available',[ScheduleController::class,'getAvailableList']);
 
     //manage profile
      Route::get('/profile',[AdminController::class,'profile'])->name('profile');
      Route::post('/profile/store',[AdminController::class,'profileStore'])->name('profile.store');

      //manage report-----------
      Route::get('/report/baptism',[BaptismController::class,'index'])->name('baptism');
        Route::get('/report/baptism/create',[BaptismController::class,'create'])->name('baptism.create');
        Route::post('/report/baptism/store',[BaptismController::class,'store']);
        Route::get('/report/baptism/view/{baptism}',[BaptismController::class,'view']);
        Route::post('/report/baptism/change/status/{baptism}/{status}',[BaptismController::class,'yesApproved']);
        Route::delete('/report/baptism/delete/{baptism}',[BaptismController::class,'destroy']);
        Route::get('/report/baptism/pending',[BaptismController::class,'pending']);
        Route::get('/report/baptism/approved',[BaptismController::class,'approved']);
        Route::get('/report/baptism/print/{baptism}/{register}/{page}/{priest}',[BaptismController::class,'print']);
      Route::post('/report/baptism/baptized',[BaptismController::class,'updateBaptize']);
      
      Route::get('/report/wedding',[WeddingController::class,'index'])->name('wedding');
        Route::get('/report/wedding/create',[WeddingController::class,'create'])->name('wedding.create');
        Route::post('/report/wedding/store',[WeddingController::class,'store']);
        Route::get('/report/wedding/view/{wedding}',[WeddingController::class,'view']);
        Route::post('/report/wedding/change/status/{wedding}/{status}',[WeddingController::class,'yesApproved']);
        Route::delete('/report/wedding/delete/{wedding}',[WeddingController::class,'destroy']);
        Route::get('/report/wedding/pending',[WeddingController::class,'pending']);
        Route::get('/report/wedding/approved',[WeddingController::class,'approved']);
      Route::get('/report/wedding/print/{wedding}/{priest}',[WeddingController::class,'print']);

      Route::get('/report/burial',[BurialController::class,'index'])->name('burial');
        Route::get('/report/burial/create',[BurialController::class,'create'])->name('burial.create');
        Route::post('/report/burial/store',[BurialController::class,'store']);
        Route::get('/report/burial/view/{burial}',[BurialController::class,'view']);
        Route::post('/report/burial/change/status/{burial}/{status}',[BurialController::class,'yesApproved']);
        Route::delete('/report/burial/delete/{burial}',[BurialController::class,'destroy']);
        Route::get('/report/burial/pending',[BurialController::class,'pending']);
        Route::get('/report/burial/approved',[BurialController::class,'approved']);
      Route::get('/report/burial/print/{burial}/{priest}',[BurialController::class,'print']);

      Route::get('/report/mass',[MassController::class,'index'])->name('mass');
        Route::get('/report/mass/create',[MassController::class,'create'])->name('mass.create');
        Route::post('/report/mass/store',[MassController::class,'store']);
        Route::get('/report/mass/view/{mass}',[MassController::class,'view']);
        Route::post('/report/mass/change/status/{mass}/{status}',[MassController::class,'yesApproved']);
        Route::delete('/report/mass/delete/{mass}',[MassController::class,'destroy']);
        Route::get('/report/mass/pending',[MassController::class,'pending']);
      Route::get('/report/mass/approved',[MassController::class,'approved']);


      Route::get('/report/confirmation',[ConfirmationController::class,'index'])->name('confirmation');
        Route::get('/report/confirmation/create',[ConfirmationController::class,'create'])->name('confirmation.create');
        Route::post('/report/confirmation/store',[ConfirmationController::class,'store']);
        Route::get('/report/confirmation/view/{confirmation}',[ConfirmationController::class,'view']);
        Route::post('/report/confirmation/change/status/{confirmation}/{status}',[ConfirmationController::class,'yesApproved']);
        Route::delete('/report/confirmation/delete/{confirmation}',[ConfirmationController::class,'destroy']);
        Route::get('/report/confirmation/pending',[ConfirmationController::class,'pending']);
        Route::get('/report/confirmation/print/{confirmation}/{priest}',[ConfirmationController::class,'print']);
      Route::get('/report/confirmation/approved',[ConfirmationController::class,'approved']);
});

Route::get('/clear', function () { //-> tawagin mo to url sa browser -> 127.0.0.1:8000/clear
    Artisan::call('view:clear'); //   -> Clear all compiled files
    Artisan::call('route:clear'); //  -> Remove the route cache file 
    Artisan::call('optimize:clear'); //-> Remove the cache bootstrap files
    Artisan::call('event:clear'); //   -> clear all cache events and listener
    Artisan::call('config:clear'); //  -> Remove the configuration cache file
    Artisan::call('cache:clear'); //   -> Flush the application cache
    return back();
});