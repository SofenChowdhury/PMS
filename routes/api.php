<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\API\RegisterController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('register', 'App\Http\Controllers\API\RegisterController@register');
Route::post('login', 'App\Http\Controllers\API\RegisterController@login')->name('admin.login');
Route::middleware('auth:api')->group( function () {
    Route::resource('products', 'App\Http\Controllers\API\ProductController');
    // Route::get('logout', 'App\Http\Controllers\API\RegisterController@logout')->name('admin.logout');
});
Route::middleware('auth:api')->get('logout', function (Request $request) {
    DB::table('oauth_access_tokens')
        ->whereUserId($request->user()->id)
        ->delete();
    return $request->user();
});