<?php

use App\Http\Controllers\DestaqueController;
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

    
    Route::get('/exportar', [ProdutoController::class, 'export'])
    ->name('.exportar');


    Route::middleware('admin')->group(function () {

        /*
        GET: Adicionar Produto (view)
        */
        Route::get('/novo', [ProdutoController::class, 'create'])
            ->name('.novo');

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


    Route::get('/{id}', [ProdutoController::class, 'show'])
        ->name('.ver');

});


Route::group(['prefix' => 'destaque', 'as' => 'destaques', 'middleware' => ['auth', 'admin']], function () {

        /*
        GET: Adicionar Produto (view)
        */
        Route::get('/adicionar/{produto_id}', [DestaqueController::class, 'create'])
            ->name('.adicionar');
        
        /*
        GET: Adicionar Produto (view)
        */
        Route::get('/remover/{id}', [DestaqueController::class, 'destroy'])
            ->name('.remover');

});