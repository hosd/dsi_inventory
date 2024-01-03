<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\AccessTokenController;
use App\Http\Controllers\API\DealerapiController;

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
Route::get('/test',function(request $request){return 'autenticated';});
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//Route::get('/get-access-token', 'API\AccessTokenController@issueToken');
Route::middleware('auth:api')->group(function(){
    Route::get('get-access-token', [AccessTokenController::class, 'issueToken'])->name('get-access-token');
    
});
Route::match(['get', 'post'],'/get-selected-dealers', [DealerapiController::class, 'getSelectedDealers'])->name('get-selected-dealers');
Route::match(['get', 'post'],'/update-dealer-orderquantity', [DealerapiController::class, 'update_dealerquantity'])->name('update-dealer-orderquantity');


//API call 

