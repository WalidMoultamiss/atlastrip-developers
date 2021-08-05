<?php
use App\http\controllers\AuthController;
use App\http\controllers\PostesController;
use App\http\controllers\CommentController;
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
//dez are public routes
Route::resource('Comment',CommentController::class);
Route::get('Comment/show/{id}',[CommentController::class,'show']);
Route::post('/register', [AuthController::class, 'register']);
Route::get('/postes/search/{title}', [PostesController::class, 'search']);
Route::get('/postes', [PostesController::class, 'index']);
Route::get('/postes/{id}', [PostesController::class, 'show']);
Route::post('/login', [AuthController::class, 'login']);

// Route::get('/comment', [CommentController::class, 'index']);
// Route::get('/comment/{id}', [CommentController::class, 'show']);


//dez are protected routes
Route::group(['middleware' => ['auth:sanctum']], function () {
    // Route::post('/comment', [CommentController::class, 'store']);
    Route::post('/postes', [PostesController::class, 'store']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::put('/postes/{id}', [PostesController::class, 'update']);
    Route::delete('/postes/{id}', [PostesController::class, 'destroy']);
});

// Route::get('/Postes', [PostesController::class,'index']);
// Route::post('/Postes', [PostesController::class,'store']);

// Route::post('/Postes',function(){

// });

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
