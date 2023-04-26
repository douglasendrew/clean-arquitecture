<?php

use App\Http\Controllers\PlanController;
use App\Http\Controllers\UserController;
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

/**
 * Rota responsavel por listar todos usuários
 * @author douglas
*/
Route::get('/users', [UserController::class, 'allUsers']);


/**
 * Rotas responsáveis por todo CRUD do usuário
 * @author douglas
*/
Route::prefix('/user')->group(function() {
    Route::get('/{id}', [UserController::class, 'getUser']);
    Route::post('/new', [UserController::class, 'newUser']);
    Route::post('/update/{id}', [UserController::class, 'updtUser']);
    Route::match(['get', 'delete'], '/delete/{id}', [UserController::class, 'delUser']);
});


/**
 * Rotas dos planos de assinatura
 * @author douglas
*/
Route::prefix('/plan')->group(function() {
    Route::get('/{id}', [PlanController::class, 'getPlano']);
    Route::post('/new', [PlanController::class, 'newPlan']);
    Route::post('/update/{id}', [PlanController::class, 'updatePlan']);
    Route::match(['get', 'delete'], '/delete/{id}', [PlanController::class, 'deletePlan']);
});


/**
 * Gestão dos planos
 * @author douglas
*/
Route::prefix('/signature')->group(function() {
    Route::post('/user/attribute', [PlanController::class, 'attributePlan']);
    Route::get('/user/list/{id}', [PlanController::class, 'listPlan']);
    Route::post('/user/remove', [PlanController::class, 'removeUser']);
});