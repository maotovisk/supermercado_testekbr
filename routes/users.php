<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;


Route::group(['prefix' => 'user', 'as' => 'users', 'middleware' => 'auth'], function () {

    /*
    GET: Exibição lista de usuários (view)
    */
    Route::get('/', [UserController::class, 'index'])
        ->name('');

    Route::middleware('admin')->group(function () {

        /*
        GET: Adicionar Usuario (view)
        */
        Route::get('/novo', [UserController::class, 'create'])
            ->name('.novo');

        /*
        POST: Registrar Usuario (api)
        */
        Route::post('/criar', [UserController::class, 'store'])
            ->name('.registrar');

        /*
        GET: Editar Usuario (view)
        */
        Route::get('/{id}/editar', [UserController::class, 'edit'])
            ->name('.editar');

        /*
        POST: Atualizar Usuario (api)
        */
        Route::post('/{id}/atualizar', [UserController::class, 'update'])
            ->name('.atualizar');
    });
});
