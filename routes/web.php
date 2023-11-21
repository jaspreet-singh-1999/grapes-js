<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\WedPageController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('admin-dashboard',function(){
    return view('admin.dashboard');
});

Route::get('/',[AuthController::class,'homePage']);
Route::get('/login',[AuthController::class,'loginPage'])->name('login');
Route::get('/logout',[AuthController::class,'logout'])->name('logout');
Route::post('user-login',[AuthController::class,'user_login'])->name('user-login');

Route::middleware(['web','auth-user'])->group(function () {

    Route::get('home-page',[WedPageController::class,'admin_home'])->name('admin-home');
    Route::get('pages-list',[WedPageController::class, 'pagesList'])->name('pages-list'); 
    Route::get('pages-list-data',[WedPageController::class, 'pagesListData'])->name('pages-list-data'); 
    Route::post('save-page',[WedPageController::class,'save_page'])->name('save-page');
    Route::get('edit-page',[WedPageController::class,'edit_page'])->name('edit-page');
    Route::post('update-page',[WedPageController::class,'page_update'])->name('page-update');
   
    Route::get('editor/{id}',[WedPageController::class,'pageEdit'])->name('editor');    
    Route::post('save-page-data',[WedPageController::class,'save_page_data'])->name('save-page-data');
    
    Route::get('delete-page/{id}',[WedPageController::class,'delete_page'])->name('delete-page');
    // Route::get('web-editor/{id}',[WedPageController::class,'webBuilder'])->name('web-builder'); 
});

// Route::get('/editor', function () {
//     return view('welcome');
// });



