<?php

use App\Http\Controllers\AdvertController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::prefix('adverts')->group(function(){
    Route::get('/list',[AdvertController::class,'index'])->name('advert.list');
    Route::post('/create',[AdvertController::class,'store'])->name('advert.create');
    Route::get('/{id}',[AdvertController::class,'show'])->name('advert.show');
});

