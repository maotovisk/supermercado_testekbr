<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoriaController;

Route::group(['prefix' => 'categoria', 'as' => 'categorias', 'middleware' => 'auth'], function () {

    /*
    GET: Exibição lista de usuários (view)
    */
    Route::get('/', [CategoriaController::class, 'index'])
        ->name('');

    Route::middleware('admin')->group(function () {

        /*
        GET: Adicionar Usuario (view)
        */
        Route::get('/novo', [CategoriaController::class, 'create'])
            ->name('.novo');

        /*
        POST: Registrar Usuario (api)
        */
        Route::post('/criar', [CategoriaController::class, 'store'])
            ->name('.registrar');

        /*
        GET: Editar Usuario (view)
        */
        Route::get('/{id}/editar', [CategoriaController::class, 'edit'])
            ->name('.editar');

        /*
        POST: Atualizar Usuario (api)
        */
        Route::post('/{id}/atualizar', [CategoriaController::class, 'update'])
            ->name('.atualizar');

        /*
        POST: Deletar Usuario (api)
        */
        Route::delete('/{id}/excluir', [CategoriaController::class, 'destroy'])
            ->name('.excluir');
    });
});
