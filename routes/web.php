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

Route::get('/', function () { 
    return view('index'); 
})->name('index');

Auth::routes();

Route::group(['middleware' => ['auth']], function () {
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

    Route::group(['prefix' => 'app'], function () {
        Route::view('inicio', 'layouts/app')->name('home');
    });

});

