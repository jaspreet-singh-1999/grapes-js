<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\WedPageController;
use App\Http\Controllers\CustomFieldController;
use App\Http\Controllers\Admin\PageController;


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

// for admin url 
Route::get('/admin/{page_slug}',[AuthController::class,'homePage'])->name('home');
Route::get('login',[AuthController::class,'loginPage'])->name('login');
Route::post('user-login',[AuthController::class,'user_login'])->name('user-login');

Route::middleware(['web','auth-user'])->group(function () {
    // wed page route
    Route::get('home-page',[WedPageController::class,'admin_home'])->name('admin-home');
    Route::get('pages-list',[WedPageController::class, 'pagesList'])->name('pages-list'); 
    Route::get('pages-list-data',[WedPageController::class, 'pagesListData'])->name('pages-list-data'); 
    Route::post('save-page',[WedPageController::class,'save_page'])->name('save-page');
    Route::get('edit-page',[WedPageController::class,'edit_page'])->name('edit-page');
    Route::post('update-page',[WedPageController::class,'page_update'])->name('page-update');
    Route::get('delete-page/{id}',[WedPageController::class,'delete_page'])->name('delete-page');

    
    Route::get('editor/{id}',[WedPageController::class,'pageEdit'])->name('editor');
    Route::post('save-page-data',[WedPageController::class,'save_page_data'])->name('save-page-data');
    
    Route::get('publish-page',[WedPageController::class,'publish_page'])->name('publish-page');
    Route::get('/logout',[AuthController::class,'logout'])->name('logout');
    
    // custome page tyep and field route
    Route::get('custom-field',[CustomFieldController::class,'custom_field'])->name('custom-field');
    Route::get('custom-list',[CustomFieldController::class,'field_list'])->name('field_list');
    Route::get('add-field',[CustomFieldController::class,'add_field'])->name('add-field');
    Route::post('save-field',[CustomFieldController::class,'saveField'])->name('save-field');
    Route::get('edit-field/{id}',[CustomFieldController::class,'editField'])->name('edit');
    Route::post('update-field',[CustomFieldController::class,'updateField'])->name('update');
    Route::get('change-status',[CustomFieldController::class,'changeStatus'])->name('change-status');
    Route::get('delete/{id}',[CustomFieldController::class,'deletePage'])->name('delete');
    Route::get('add/{id}',[CustomFieldController::class,'showField'])->name('add');

    Route::prefix('fieldData')->group(function(){
        Route::get('list/{id}',[PageController::class,'listing'])->name('list');
        Route::post('/add',[PageController::class,'save_field_data'])->name('save-field-data');
        Route::get('/edit',[PageController::class,'edit'])->name('edit');
        Route::post('/update',[PageController::class,'updateData'])->name('update-field-data');
        Route::get('/delete',[PageController::class,'deleteData'])->name('delete-field-data');
    });
});

// for public use url
Route::get('/{page_slug}', [AuthController::class,'page_using_slug'])->name('page-slug');

