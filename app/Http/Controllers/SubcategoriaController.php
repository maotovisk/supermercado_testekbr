<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;
use App\Models\Subcategoria;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class SubcategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($categoria_id)
    {
        if(!is_numeric($categoria_id))
            return abort("404", "Não foi possivel encontrar a categoria!");

        $categoria = Categoria::find($categoria_id);
        
        if($categoria == null)
            return abort("404", "Não foi possivel encontrar a categoria!");

        $subcategorias = $categoria->subcategorias()->paginate(15);    

        return view('dashboard.categoria.subcategoria.index', ['subcategorias' => $subcategorias, 'categoria' => Categoria::find($categoria_id)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($categoria_id)
    {
        $categoria = Categoria::find($categoria_id);
        return view('dashboard.categoria.subcategoria.criar', ['categoria' => $categoria]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $categoria_id)
    {
        //
        $request->validate([
            'titulo' => 'required|unique:subcategorias|string|max:255',
        ]);


        $subcategoria = Subcategoria::create([
            'titulo' => $request->titulo,
            'categoria_id' => $categoria_id,
        ]);

        return redirect(route('categorias.subcategorias', ['categoria_id' => $categoria_id]))->with('status', 'Subcategoria adicionada!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($categoria_id, $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($categoria_id, $id)
    {
        $subcategoria = Subcategoria::find($id);
        $categorias = Categoria::get();

        return view('dashboard.categoria.subcategoria.editar', ['subcategoria' => $subcategoria, 'categoria'=>$subcategoria->categoria, 'categorias' => $categorias]);
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $categoria_id, $id)
    {

        $request->validate([
            'titulo' => ['required',
            Rule::unique('subcategorias')->where(function ($query) {
                return $query->where('categoria_id', $_REQUEST['categoria_id']);
            })]
        ]);

        $subcategoria = Subcategoria::find($id);
        $subcategoria->titulo = $request->titulo;
        $subcategoria->categoria_id = $request->categoria_id == "" ? $subcategoria->categoria_id : $request->categoria_id;
        $subcategoria->save();

        return redirect(route('categorias.subcategorias', $request->categoria_id == "" ? $subcategoria->categoria_id : $request->categoria_id))->with('status', 'Subcategoria atualizada!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($categoria_id, $id)
    {
        Subcategoria::destroy($id);

        return redirect(route('categorias.subcategorias', $categoria_id))->with('status', 'Subcategoria removida com sucesso!');
    }
}
