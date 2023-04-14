<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\ApiPostController;

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
Route::post('register', [AuthController::class, 'register']);

Route::post('login', [AuthController::class, 'login'])->middleware('verify_token');

// Route::get('userDetails',[AuthController::class,'showDetails']);

Route::middleware('auth:api')->get('/user-details', [AuthController::class,'showDetails']);         

Route::middleware('auth:api')->get('/createPost',[ApiPostController::class,'create']);

// Route::middleware('auth:api')->group(function () {
//     Route::resource('posts', PostController::class);
// });



