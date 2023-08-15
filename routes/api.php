<?php

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|1|QookLE8yykPc1qVsy4okxpO1UaFFewtPM7DldjX5"
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {

return response()->json(["done",Auth::user()->name],200);

});
Route::middleware('auth:sanctum')->post('/post/employee',[ApiController::class,'setEmployee']);
Route::middleware('auth:sanctum')->get('/set/employee/{id}',[ApiController::class,'getIdEmployee']);
Route::middleware('auth:sanctum')->put('/update/employee/{id}',[ApiController::class,'setIdEmployee']);

Route::get('/hola',[ApiController::class,'hola']);
Route::post('/login',[ApiController::class,'login']);
Route::post('/login1',[ApiController::class,'login1']);


Route::post('/tokens/create', function (Request $request) {
    $token = $request->user()->createToken($request->token_name);

    return ['token' => $token->plainTextToken];
});
