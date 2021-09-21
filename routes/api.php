<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Resources\Hourse as HorseResorce;
use App\Http\Resources\Race as RaceResorce;
use App\Models\Horse;
use App\Models\Race;
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

Route::get('/horses', function () {
    return new HorseResorce(Horse::all());
});

Route::get('/horses/bred/{bred}', function ($bred) {
    return new HorseResorce(Horse::where('bred', $bred)->get());
});


Route::get('/races', function () {
    return new RaceResorce(Race::all());
});
