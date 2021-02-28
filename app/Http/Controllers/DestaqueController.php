<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Destaque;
use App\Models\Produto;

class DestaqueController extends Controller
{
    public function create($produto_id)
    {
        $produto = Produto::find($produto_id);
            if ($produto == null)
                return redirect(route('produtos'))->with('error', 'Produto não encontrado');
            if ($produto->is_active == false)
                return redirect(route('produtos'))->with('error', 'Produto encontra-se inativo');

        $destaques = Destaque::get();

        if (Destaque::where('produto_id', $produto_id)->count() > 0)
            return redirect(route('produtos'))->with('error', 'Destaque já adicionado');


        if (count($destaques) >=10)
            return redirect(route('produtos'))->with('error', 'Remova um destaque ante de adicionar');
        else {
            Destaque::create(['produto_id' => $produto_id]);
            return redirect(route('produtos'))->with('status', 'Destaque adicionado com sucesso');
        }
    }

    public function destroy($id)
    {
        if (is_numeric($id))
            if (Destaque::find($id) != null) {
                Destaque::destroy($id);
                return redirect(route('produtos'))->with('status', 'Destaque removido com sucesso');
            }
    }

}
