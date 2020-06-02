<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/{optional?}', function () { 
    return view('index'); 
});

Auth::routes();

Route::group(['prefix' => 'api'], function () {
    Route::apiResources([
        'cursos'        => 'Api\CursoController',
        'modalidads'    => 'Api\ModalidadController',
        'ponentes'      => 'Api\PonenteController',
        'events'        => 'Api\EventController',
        'temas'         => 'Api\TemaController',
        'asistencias'   => 'Api\AsistenciaController',
        'asignados'     => 'Api\AsignadoController'
    ]);
});