<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\SubcategoriaController;

Route::group(['prefix' => 'categoria', 'as' => 'categorias', 'middleware' => 'auth'], function () {

    /*

            CATEGORIAS

    */

    /*
    GET: Exibição lista de categoriass (view)
    */
    Route::get('/', [CategoriaController::class, 'index'])
        ->name('');

    Route::middleware('admin')->group(function () {

        /*
        GET: Adicionar Categoria (view)
        */
        Route::get('/novo', [CategoriaController::class, 'create'])
            ->name('.novo');

        /*
        POST: Registrar Categoria (api)
        */
        Route::post('/criar', [CategoriaController::class, 'store'])
            ->name('.registrar');

        /*
        GET: Editar Categoria (view)
        */
        Route::get('/{id}/editar', [CategoriaController::class, 'edit'])
            ->name('.editar');

        /*
        POST: Atualizar Categoria (api)
        */
        Route::post('/{id}/atualizar', [CategoriaController::class, 'update'])
            ->name('.atualizar');

        /*
        POST: Deletar Categoria (api)
        */
        Route::delete('/{id}/excluir', [CategoriaController::class, 'destroy'])
            ->name('.excluir');
    });

     /*

        SUBCATEGORIAS
    
    */


    Route::group(['prefix' => '{categoria_id}/subcategoria', 'as' => '.subcategorias'], function($categoria_id) {


        Route::get('', [SubcategoriaController::class, 'index'])
        ->name('');

        /*
        GET: Adicionar Subcategoria (view)
        */
        Route::get('/novo', [SubcategoriaController::class, 'create'])
            ->name('.novo');

        /*
        POST: Registrar Subcategoria (api)
        */
        Route::post('/criar', [SubcategoriaController::class, 'store'])
            ->name('.registrar');

        /*
        GET: Editar Subcategoria (view)
        */
        Route::get('/{id}/editar', [SubcategoriaController::class, 'edit'])
            ->name('.editar');

        /*
        POST: Atualizar Subcategoria (api)
        */
        Route::post('/{id}/atualizar', [SubcategoriaController::class, 'update'])
            ->name('.atualizar');

        /*
        POST: Deletar Subcategoria (api)
        */
        Route::delete('/{id}/excluir', [SubcategoriaController::class, 'destroy'])
            ->name('.excluir');

    });



});

