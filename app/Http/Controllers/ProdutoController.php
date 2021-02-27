<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Subcategoria;
use App\Models\Produto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

use function PHPUnit\Framework\assertIsNumeric;

class ProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $produtos = Produto::paginate(15);        
        return view('dashboard.produto.index', ['produtos' => $produtos]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $categorias = Categoria::get();
        $subcategorias = Subcategoria::get();

        return view('dashboard.produto.criar', ['categorias' => $categorias, 'subcategorias' => $subcategorias]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'titulo' => 'required|string|unique:produtos|max:255',
            'descricao' => 'required',
            'valor' => 'numeric|required',
            'subcategoria_id' => 'required',
            'active' => 'required',
            'imagem' => 'file|max:1999|mimes:png,jpg',
        ]);

        /* Criando Exceção para subcategoria certa*/

        if (!is_numeric($request->subcategoria_id)) {
            throw ValidationException::withMessages(['subcategoria' => 'Selecione uma subcategoria']);
        }

        /* Checando imagem */
        $temfoto = $request->hasFile('image');
        $image_path = null;

        /* Google reCaptcha V2 */
        $secret = config('captcha.v2-checkbox');

        $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
            'secret' => $secret,
            'response' => $request['g-recaptcha-response'],
        ]);

        if (json_decode($response->body())->success == false) {
            throw ValidationException::withMessages(['Captcha' => 'Captcha Inválida']);
        }

        /* Armazenando imagem */
        if ($temfoto) {
            if ($request->file('imagem')->isValid()) {
                $image_path = $request->imagem->storeAs('product_images');
            }
            throw ValidationException::withMessages(['Imagem' => 'Não foi possível enviar imagem']);
        }

        /* Começa a salvar Produto*/
        $produto = Produto::create([
            'titulo' => $request->titulo,
            'descricao' => $request->descricao,
            'subcategoria_id' => $request->subcategoria_id,
            'valor' => $request->valor,
            'is_active' => $request->active === "on" ? 1 : 0,
            'imagem' => $image_path !== null ? $image_path : "noimage.jpg"
        ]);

        return redirect(route('produtos'))->with('status', 'Produto adicionado!');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
