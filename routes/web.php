<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\FrontendController;
use App\Http\Controllers\Admin\UserController;
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

Route::get('/index',[UserController::class,'index1']);
Route::post('/useremail',[UserController::class,'sendemail']);


Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');


    Route::middleware(['auth','admin'])->group(function () {

        Route::get('/dashboard',[FrontendController::class,'index']);
        //	Route::get('/categories',[CategoryController::class,'index']);
       	
        Route::resource('/categories','Admin\CategoryController');
       Route::get('/add-category',[CategoryController::class,'add']);
       	Route::post('/insert-category',[CategoryController::class,'insert']);
       	Route::get('/edit-user/{id}',[CategoryController::class,'edit']);
       	Route::put('/update-category/{id}',[CategoryController::class,'update']);
       	Route::get('/delete-category/{id}',[CategoryController::class,'delete']);

  
       
          Route::get('/users',[UserController::class,'index']);
          Route::get('/user',[UserController::class,'status']);
        Route::get('/add-user',[UserController::class,'add']);
        Route::post('/insert-user',[UserController::class,'insert']);
        
        Route::get('/edit-prod/{id}',[UserController::class,'edit']);
        Route::put('/update-user/{id}',[UserController::class,'update']);
        Route::get('/delete-user/{id}',[UserController::class,'delete']);
        Route::get('changeStatus',[UserController::class,'changeStatus'])->name('changeStatus');
       
});