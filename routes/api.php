<?php

use App\Domain\Articles\Article\Presentation\ArticleController;
use App\Domain\Users\User\Presentation\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('/users/{id}', [UserController::class, 'getUser']);

Route::group(['prefix' => 'articles'], function () {
    Route::post('/', [ArticleController::class, 'create']);
    Route::get('/', [ArticleController::class, 'list']);
    Route::put('/{id}', [ArticleController::class, 'update']);
    Route::get('/{id}', [ArticleController::class, 'get']);
    Route::delete('/{id}', [ArticleController::class, 'delete']);
});


