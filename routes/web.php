<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\UrlController;
use App\Http\Controllers\PasswordResetsController;
use App\Http\Controllers\AdminController;

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

Route::group(['middleware' => ['AuthCheck']], function(){
    Route::get('/', [MainController::class, 'index'])->name('index');

    Route::get('/pages/home', [MainController::class, 'home'])->name('pages.home');
    Route::get('/pages/myurls', [MainController::class, 'myurls'])->name('pages.myurls');
    Route::get('/pages/settings',[MainController::class, 'settings'])->name('pages.settings');
    Route::get('/pages/delete/{urlid}', [UrlController::class, 'deleteUrl'])->name('delete.url');
    Route::get('/pages/urlchange/{urlid}', [UrlController::class, 'urlChange'])->name('url.change'); // prebacuje na drugu stranicu
    Route::get('/pages/profile', [MainController::class, 'profile'])->name('pages.profile');

    Route::get('/auth/login', [MainController::class, 'login'])->name('auth.login');
    Route::get('/auth/register', [MainController::class, 'register'])->name('auth.register');
    Route::get('/auth/forgotpassword', [MainController::class, 'forgotpassword'])->name('auth.forgotpassword');
    
    

    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/finduser', [AdminController::class, 'finduser'])->name('admin.finduser');
    Route::get('/admin/finduser/delete/{userId}', [AdminController::class, 'deleteUser'])->name('admin.delete');
    Route::get('/admin/finduser/changerole/{userId}', [AdminController::class, 'changeRole'])->name('admin.changeRole');
    Route::get('/admin/editurls/{userId}', [AdminController::class, 'editUrls'])->name('admin.editUrls');
    Route::get('/admin/deleteurl/{urlId}', [AdminController::class, 'deleteUrl'])->name('admin.deleteUrl');
    Route::get('/admin/appinfo', [AdminController::class, 'appInfo'])->name('admin.appInfo');


    
    
    Route::post('/pages/url/check', [UrlController::class, 'check'])->name('url.check');
    Route::post('/pages/settings/name', [MainController::class, 'nameChange'])->name('name.settings');
    Route::post('/pages/settings/email', [MainController::class, 'emailChange'])->name('email.settgins');
    Route::post('/pages/settings/password', [MainController::class, 'passwordChange'])->name('password.settings');
    Route::post('/pages/change/{urlid}', [UrlController::class, 'changeUrl'])->name('change.url'); // menja url i vraca na pages.myurls
   
    
});

Route::get('/auth/resetpassword/{token}', [PasswordResetsController::class, 'resetview'])->name('auth.resetview');
Route::post('/auth/resetlink', [PasswordResetsController::class, 'resetlink'])->name('auth.resetlink');
Route::post('/auth/resetPassword', [PasswordResetsController::class, 'resetPassword'])->name('auth.resetpassword');
Route::post('/auth/save', [MainController::class, 'save'])->name('auth.save');
Route::post('/auth/check', [MainController::class, 'check'])->name('auth.check');
Route::get('/auth/logout', [MainController::class, 'logout'])->name('auth.logout');
Route::get('/url/{shorturl}',[UrlController::class, 'intersection'])->name('url.intersection');





