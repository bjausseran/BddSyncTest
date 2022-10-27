<?php

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

Route::apiResource('/captor', 'CaptorController');
Route::apiResource('/client', 'ClientController');



// here for test, should be deleted before export
Route::get('/test', function(){
    return DB::connection(env("DBLOCAL_NAME"))->table("Captors")->get();
});

