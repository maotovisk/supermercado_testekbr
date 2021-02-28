<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Subcategoria;
use App\Models\Produto;
use Barryvdh\DomPDF\Facade as PDF;
use Faker\Provider\Uuid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;


class ProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {


        $selectedSubcategory = $request->input('subcategoria');
        $selectedCategory = $request->input('categoria');

        $produtos = Produto::paginate(15);

        $categorias = Categoria::get();

        $subcategorias = Subcategoria::get();

        if ($selectedCategory !== null) {
            $categoria = Categoria::find($selectedCategory);
            if ($categoria != null) {
                $produtos = $this->ordernar($request->input('orderBy'), $categoria);
                $subcategorias = $categoria->subcategorias;
            }
        }
        /* só order by */
        if ($request->input('orderBy') != null && $selectedSubcategory == null && $selectedCategory == null) {
            switch ($request->input('orderBy')) {

                    /* Ordenar por Menor Preço */
                case '1':
                    $produtos = Produto::orderBy('valor', 'asc')->paginate(15);
                    break;

                    /* Ordenar por Maior Preço */
                case '2':
                    $produtos = Produto::orderBy('valor', 'desc')->paginate(15);
                    break;

                    /* Ordenar por Ordem Alfabética */
                case '3':
                    $produtos = Produto::orderBy('titulo', 'asc')->paginate(15);
                    break;

                    /* Ordenar por Ordem Alfabética Inversa */
                case '4':
                    $produtos = Produto::orderBy('titulo', 'desc')->paginate(15);
                    break;

                default:
                    # code...
                    break;
            }
        }

        if (is_numeric($selectedSubcategory)) {
            $subcategoria = Subcategoria::find($selectedSubcategory);
            if ($subcategoria != null)
                /* order by com subcategoria */
                $produtos = $this->ordernar($request->input('orderBy'), $subcategoria);
        }

        //
        return view('dashboard.produto.index', ['produtos' => $produtos
            ->appends(request()->query()), 'categorias' => $categorias, 'subcategorias' => $subcategorias,  'scategoria' => $selectedCategory, 'ssubcategoria' => $selectedSubcategory]);
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
        $temfoto = $request->hasFile('imagem');
        $image_path = null;
        $image_url = null;

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
                $image_name = Uuid::uuid() . "-produto." . $request->imagem->extension();
                $image_path = $request->imagem->storeAs('imagens', $image_name);
                $image_url = Storage::url('imagens/'.$image_name);}
            throw ValidationException::withMessages(['Imagem' => 'Não foi possível enviar imagem']);
        }

        /* Começa a salvar Produto*/
        $produto = Produto::create([
            'titulo' => $request->titulo,
            'descricao' => $request->descricao,
            'subcategoria_id' => $request->subcategoria_id,
            'valor' => $request->valor,
            'is_active' => $request->active === "on" ? 1 : 0,
            'imagem' => $image_path !== null ? $image_url : "noimage.jpg"
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

        $produto = Produto::find($id);
        $categorias = Categoria::get();
        $subcategorias = Subcategoria::get();

        return view('dashboard.produto.ver', ['produto' => $produto, 'categorias' => $categorias, 'subcategorias' => $subcategorias, 'selectedCategory' => $produto->categoria, 'selectedSubcategory' => $produto->subcategoria]);
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
        $produto = Produto::find($id);
        $categorias = Categoria::get();
        $subcategorias = Subcategoria::get();

        return view('dashboard.produto.editar', ['produto' => $produto, 'categorias' => $categorias, 'subcategorias' => $subcategorias, 'selectedCategoria' => $produto->categoria, 'selectedSubcategoria' => $produto->subcategoria]);
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

        $request->validate([
            'titulo' => 'required|string|unique:produtos,titulo,' . $id . '|max:255',
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
        $temfoto = $request->hasFile('imagem');
        $image_path = null;
        $image_url = null;

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
                $image_name = Uuid::uuid() . "-produto." . $request->imagem->extension();
                $image_path = $request->imagem->storeAs('/public/imagens', $image_name);
                $image_url = Storage::url('imagens/'.$image_name);
            } else {
                throw ValidationException::withMessages(['Imagem' => 'Não foi possível enviar imagem']);
            }
        }

        /* Atualizando Produto*/
        $produto = Produto::find($id);
        $produto->titulo = $request->titulo;
        $produto->valor = $request->valor;
        $produto->descricao = $request->descricao;
        $produto->subcategoria_id = $request->subcategoria_id;
        $produto->is_active = $request->active === "on" ? 1 : 0;
        $produto->imagem = $image_path !== null ? $image_url : $produto->imagem;

        $produto->save();

        /* 
            'titulo' => $request->titulo,
            'descricao' => $request->descricao,
            'subcategoria_id' => $request->subcategoria_id,
            'valor' => $request->valor,
            'is_active' => $request->active === "on" ? 1 : 0,
            'imagem' => $image_path !== null ? $image_path : "noimage.jpg
        
        */

        return redirect(route('produtos'))->with('status', 'Produto atualizado!');
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

    public function export(Request $request)
    {


        $subcategoria = null;
        $categoria = null;

        $selectedSubcategory = $request->input('subcategoria');
        $selectedCategory = $request->input('categoria');

        $produtos = Produto::all();

        if ($selectedCategory !== null) {

            $categoria = Categoria::find($selectedCategory);
            if ($categoria != null) {
                $produtos = $this->ordernar($request->input('orderBy'), $categoria);
            }
        }

        /* só order by */
        if ($request->input('orderBy') != null && $selectedSubcategory == null && $selectedCategory == null) {
            switch ($request->input('orderBy')) {

                    /* Ordenar por Menor Preço */
                case '1':
                    $produtos = Produto::orderBy('valor', 'asc')->paginate(15);
                    break;

                    /* Ordenar por Maior Preço */
                case '2':
                    $produtos = Produto::orderBy('valor', 'desc')->paginate(15);
                    break;

                    /* Ordenar por Ordem Alfabética */
                case '3':
                    $produtos = Produto::orderBy('titulo', 'asc')->paginate(15);
                    break;

                    /* Ordenar por Ordem Alfabética Inversa */
                case '4':
                    $produtos = Produto::orderBy('titulo', 'desc')->paginate(15);
                    break;

                default:
                    # code...
                    break;
            }
        }

        if (is_numeric($selectedSubcategory)) {
            $subcategoria = Subcategoria::find($selectedSubcategory);
            if ($subcategoria != null)
                /* order by com subcategoria */
                $produtos = $this->ordernar($request->input('orderBy'), $subcategoria);
        }

        if ($request->input('tipo') == 'csv') {
            $csv = \League\Csv\Writer::createFromFileObject(new \SplTempFileObject);

            $csv->insertOne(array_keys($produtos[0]->getAttributes()));



            foreach ($produtos as $produto) {
                $csv->insertOne($produto->toArray());
            }

            $writer = $csv->output('people.csv');

            return response((string) $writer, 200, [
                'Content-Type' => 'text/csv',
                'Content-Transfer-Encoding' => 'binary',
                'Content-Disposition' => 'attachment; filename="people.csv"',
            ]);
        } else {


            $pdf = PDF::loadView('documents.produtos-pdf', ['produtos' => $produtos, 'categoria' => $categoria, 'subcategoria' => $subcategoria]);

            return $pdf->download('produtos' . date(format: 'd-M-Y-H:i') . 'pdf');
            /*return redirect(route('produtos'))->with('status', "PDF AINDA N IMPLEMENTADO");*/
        }
    }

    function ordernarSemPaginar($indice, $modelo)
    {
        switch ($indice) {

                /* Ordenar por Menor Preço */
            case '1':
                return $modelo->produtos()->orderBy('valor', 'asc');
                break;

                /* Ordenar por Maior Preço */
            case '2':
                return $modelo->produtos()->orderBy('valor', 'desc');
                break;

                /* Ordenar por Ordem Alfabética */
            case '3':
                return $modelo->produtos()->orderBy('valor', 'asc');
                break;

                /* Ordenar por Ordem Alfabética Inversa */
            case '4':
                return $modelo->produtos()->orderBy('titulo', 'desc');
                break;

            default:
                # code...
                return $modelo->produtos();
                break;
        }
    }

    function ordernar($indice, $modelo)
    {
        switch ($indice) {

                /* Ordenar por Menor Preço */
            case '1':
                return $modelo->produtos()->orderBy('valor', 'asc')->paginate(15);
                break;

                /* Ordenar por Maior Preço */
            case '2':
                return $modelo->produtos()->orderBy('valor', 'desc')->paginate(15);
                break;

                /* Ordenar por Ordem Alfabética */
            case '3':
                return $modelo->produtos()->orderBy('valor', 'asc')->paginate(15);
                break;

                /* Ordenar por Ordem Alfabética Inversa */
            case '4':
                return $modelo->produtos()->orderBy('titulo', 'desc')->paginate(15);
                break;

            default:
                # code...
                return $modelo->produtos()->paginate(15);
                break;
        }
    }
}
