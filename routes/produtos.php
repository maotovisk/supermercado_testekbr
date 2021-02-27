<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdutoController;

Route::group(['prefix' => 'produto', 'as' => 'produtos', 'middleware' => 'auth'], function () {

    /*

            CATEGORIAS

    */

    /*
    GET: Exibição lista de produtos (view)
    */
    Route::get('/', [ProdutoController::class, 'index'])
        ->name('');

    Route::middleware('admin')->group(function () {

        /*
        GET: Adicionar Produto (view)
        */
        Route::get('/novo', [ProdutoController::class, 'create'])
            ->name('.novo');

        /*
        GET: Ver Produto (view)
        */
        Route::get('/{id}', [ProdutoController::class, 'show'])
        ->name('.ver');

        /*
        POST: Registrar Produto (api)
        */
        Route::post('/criar', [ProdutoController::class, 'store'])
            ->name('.registrar');

        /*
        GET: Editar Produto (view)
        */
        Route::get('/{id}/editar', [ProdutoController::class, 'edit'])
            ->name('.editar');

        /*
        POST: Atualizar Produto (api)
        */
        Route::post('/{id}/atualizar', [ProdutoController::class, 'update'])
            ->name('.atualizar');

        /*
        POST: Deletar Produto (api)
        */
        Route::delete('/{id}/excluir', [ProdutoController::class, 'destroy'])
            ->name('.excluir');
    });

});

