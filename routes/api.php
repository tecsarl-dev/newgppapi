<?php

use App\Http\Controllers\Api\V1\HomeController;
use Illuminate\Support\Facades\Route;

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::get('/email/verify/{id}/{hash}', ['App\Http\Controllers\Api\V1\AuthController','verify'])->name('verification.verify');
Route::get('/email/resend', 'App\Http\Controllers\Api\V1\AuthController@resend')->name('verification.send');


Route::post("/auth/register", ['App\Http\Controllers\Api\V1\AuthController','register'])->name('auth.register');
Route::post("/auth/login", ['App\Http\Controllers\Api\V1\AuthController','login'])->name('auth.login');
Route::get("/auth/logout", ['App\Http\Controllers\Api\V1\AuthController','logout'])->middleware('auth:sanctum')->name('auth.logout');
Route::get("/auth/user", ['App\Http\Controllers\Api\V1\AuthController','me'])->middleware(['auth:sanctum'])->name('auth.user');


Route::middleware(["auth:sanctum"])->group(function(){
  Route::resource("features", "App\Http\Controllers\Api\V1\FeatureController");
  Route::resource("roles", "App\Http\Controllers\Api\V1\RoleController");
});


Route::get('/', HomeController::class);

Route::resource("companies", "App\Http\Controllers\Api\V1\CompanyController");

Route::get('/measures',['App\Http\Controllers\Api\V1\MeasureController','index']);
Route::get('/legal-forms',['App\Http\Controllers\Api\V1\LegalFormController','index']);

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
Route::get('/loading-slips/{id}',['App\Http\Controllers\Api\V1\LoadingSlipController','show']);
Route::post('/loading-slips',['App\Http\Controllers\Api\V1\LoadingSlipController','store']);
Route::put('/loading-slips/{id}',['App\Http\Controllers\Api\V1\LoadingSlipController','update']);
Route::delete('/loading-slips/{id}',['App\Http\Controllers\Api\V1\LoadingSlipController','destroy']);

Route::get('/deliveries',['App\Http\Controllers\Api\V1\DeliveryController','index']);
Route::get('/deliveries/{id}',['App\Http\Controllers\Api\V1\DeliveryController','show']);
Route::post('/deliveries',['App\Http\Controllers\Api\V1\DeliveryController','store']);
Route::put('/deliveries/{id}',['App\Http\Controllers\Api\V1\DeliveryController','update']);
Route::delete('/deliveries/{id}',['App\Http\Controllers\Api\V1\DeliveryController','destroy']);

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

Route::get('/titles', function () {
    $first_level = App\Models\Title::whereNull("parent_id")->count();
    $data = App\Models\Title::whereNull("parent_id")->with("subtitles")->get();
    $first_level_percent = 100 / $first_level;

    $array_tabl = [];

    foreach ($data as $key => $value) {
      $count_first_child = count($value->subtitles);

      $array_tabl[$key] = [
        "title" => $value->title,
        "percent" => $first_level_percent
      ];

      foreach ($value->subtitles as $second_child_key => $second_child_value) {
        $count_second_child = count($second_child_value->subtitles);
        $second_level_percent = $first_level_percent / $count_first_child;

        $array_tabl[$key]["subtitles"][$second_child_key] = [
          "title" => $second_child_value->title,
          "percent" =>  $second_level_percent
        ];

        foreach ($second_child_value->subtitles as $third_child_key => $third_child_value) {
          $array_tabl[$key]["subtitles"][$second_child_key]["subtitles"][$third_child_key]= [
            "title" => $third_child_value->title,
            "percent" =>  $second_level_percent / $count_second_child
          ];
        }

      }

    }

    dd($array_tabl);


    return response()->json([
        'data' => $titles,
    ],200);
});
