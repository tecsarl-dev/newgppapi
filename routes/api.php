<?php

use App\Http\Controllers\Api\V1\HomeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::get('/', HomeController::class);

Route::get('/companies',['App\Http\Controllers\Api\V1\CompanyController','index']);
Route::post('/companies',['App\Http\Controllers\Api\V1\CompanyController','store']);
Route::put('/companies/{id}',['App\Http\Controllers\Api\V1\CompanyController','update']);
Route::get('/companies/{id}',['App\Http\Controllers\Api\V1\CompanyController','show']);
Route::delete('/companies/{id}',['App\Http\Controllers\Api\V1\CompanyController','destroy']);

Route::get('/measures',['App\Http\Controllers\Api\V1\MeasureController','index']);
Route::get('/legal_forms',['App\Http\Controllers\Api\V1\LegalFormController','index']);

Route::get('/products',['App\Http\Controllers\Api\V1\ProductController','index']);
Route::post('/products',['App\Http\Controllers\Api\V1\ProductController','store']);
Route::put('/products/{id}',['App\Http\Controllers\Api\V1\ProductController','update']);
Route::delete('/products/{id}',['App\Http\Controllers\Api\V1\ProductController','destroy']);

Route::get('/trucks',['App\Http\Controllers\Api\V1\TruckController','index']);
Route::post('/trucks',['App\Http\Controllers\Api\V1\TruckController','store']);
Route::put('/trucks/{id}',['App\Http\Controllers\Api\V1\TruckController','update']);
Route::delete('/trucks/{id}',['App\Http\Controllers\Api\V1\TruckController','destroy']);

Route::get('/stations',['App\Http\Controllers\Api\V1\StationController','index']);
Route::post('/stations',['App\Http\Controllers\Api\V1\StationController','store']);
Route::put('/stations/{id}',['App\Http\Controllers\Api\V1\StationController','update']);
Route::delete('/stations/{id}',['App\Http\Controllers\Api\V1\StationController','destroy']);

Route::get('/loading-slips',['App\Http\Controllers\Api\V1\LoadingSlipController','index']);
Route::post('/loading-slips',['App\Http\Controllers\Api\V1\LoadingSlipController','store']);
Route::put('/loading-slips/{id}',['App\Http\Controllers\Api\V1\LoadingSlipController','update']);
Route::delete('/loading-slips/{id}',['App\Http\Controllers\Api\V1\LoadingSlipController','destroy']);

Route::get('/depots',['App\Http\Controllers\Api\V1\DepotController','index']);
Route::post('/depots',['App\Http\Controllers\Api\V1\DepotController','store']);
Route::put('/depots/{id}',['App\Http\Controllers\Api\V1\DepotController','update']);
Route::delete('/depots/{id}',['App\Http\Controllers\Api\V1\DepotController','destroy']);

Route::get('/rates',['App\Http\Controllers\Api\V1\RateController','index']);
Route::post('/rates',['App\Http\Controllers\Api\V1\RateController','store']);
Route::put('/rates/{id}',['App\Http\Controllers\Api\V1\RateController','update']);
Route::delete('/rates/{id}',['App\Http\Controllers\Api\V1\RateController','destroy']);

Route::post('/departments',['App\Http\Controllers\Api\V1\DepartmentController','store']);
Route::get('/communes',['App\Http\Controllers\Api\V1\CommuneController','index']);
Route::get('/localities',['App\Http\Controllers\Api\V1\LocalityController','index']);

Route::post('/geo',['App\Http\Controllers\Api\V1\GeoController','import']);
