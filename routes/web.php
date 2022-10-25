<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
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
    return view('auth.login');
});
Route::get('/login-form', function () {
    return view('auth.login');
})->name('api.login');
Route::get('/register-form', function () {
    return view('auth.register');
})->name('api.register');
Auth::routes();
Route::middleware('auth:api')->get('logout', function (Request $request) {
    DB::table('oauth_access_tokens')
        ->whereUserId($request->user()->id)
        ->delete();
    return $request->user();
})->name('api.logout');
Route::post('/user-login', 'App\Http\Controllers\UserController@login')->name('user.login');
Route::post('/user-register', 'App\Http\Controllers\UserController@register')->name('user.register');
Route::middleware('auth:web')->group( function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::resource('/products-ajax-crud', ProductController::class);
    Route::post('/products-ajax-crud-update', [ProductController::class, 'update'])->name('products-ajax-crud-update');
    Route::delete('/products-ajax-crud-delete', [ProductController::class, 'destroy'])->name('products-ajax-crud-delete');
    Route::get('/pagination/paginate-data', [ProductController::class, 'pagination']);
    Route::get('/search-product', [ProductController::class, 'searchProduct'])->name('serach.product');
});