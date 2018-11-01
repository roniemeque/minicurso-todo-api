<?php

use Illuminate\Http\Request;

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

Route::get('{user}/tarefas', 'TaskController@index');
Route::post('{user}/tarefas', 'TaskController@store');
Route::post('{user}/tarefas/{task}/completar', 'TaskController@toggleCompletar');
Route::post('{user}/tarefas/{task}/arquivar', 'TaskController@toggleArquivar');
Route::post('{user}/tarefas/{task}/prioridade', 'TaskController@togglePrioridade');
