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

        Route::get('cursos/listar', 'Api\CursoController@select2');


        Route::get('personas', 'PersonaController@index');//datos de select2
        Route::get('personas/operativo', 'PersonaController@tabla');// datos para tabla

        Route::get('ponentes/listar', 'Api\PonenteController@select2');
        Route::apiResources([
            'cursos'        => 'Api\CursoController',
            'modalidads'    => 'Api\ModalidadController',
            'ponentes'      => 'Api\PonenteController',
            'events'        => 'Api\EventController',
            'temas'         => 'Api\TemaController',
            'asistencias'   => 'Api\AsistenciaController',
            'asignados'     => 'Api\AsignadoController'
        ]);

        Route::get('asistencias/evento/{evento}', 'Api\AsistenciaController@event')
            ->name('asistencias.evento')
            ->where('evento', '[0-9]+');
        Route::get('temas/temario/{evento}', 'Api\TemaController@temario')
            ->name('asistencias.evento')
            ->where('evento', '[0-9]+');
    });

    Route::group(['prefix' => 'app'], function () {
    // Route::view('agenda', 'layouts/app')->name('home');
        Route::get('/{any?}', function () {
            return view('layouts/app');
        })->name('home')
        ->where('any','.*');
    });


});

