<?php
use App\http\controllers\PostesController;
// use App\Models\Postes;
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
//don't forget capital letter
Route::resource('Postes',PostesController::class);
Route::get('/Postes/search/{title}', [PostesController::class,'search']);

// Route::get('/Postes', [PostesController::class,'index']);
// Route::post('/Postes', [PostesController::class,'store']);

// Route::post('/Postes',function(){

// });

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
