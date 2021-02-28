<!DOCTYPE html>
<html lang="pt_BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PDF PRODUTOS</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 14pt;
            text-align: center;
        }
    </style>
</head>
<body>
    <center><h1> Produtos ({{count($produtos)}})</h1>
        <br>
    @if ($categoria != null)
        <span>Categoria: {{$categoria->titulo}}</span>
    @endif
    @if ($subcategoria != null)
        <span>Subcategoria: {{$subcategoria->titulo}}</span>
    @endif
    <hr>
        <table>
                <thead>
                    <tr>
                        <th style="width:100%"> Produto </th>
                        <th> Preço </th>
                        <th> Status </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($produtos as $produto)
                    <tr>
                            <td style="width:100%"> {{$produto->titulo}}</td>
                            <td> R$ {{$produto->valor}} </td>
                            <td> 
                                <span
                                    class="bg-indigo-200 text-indigo-500 text-xs font-semibold rounded-md py-1 px-2">{{ $produto->is_active ? 'Ativo' : 'Inativo' }}</span> </td>
                    </tr>
                    @endforeach
                </tbody>
        </table>
    </center>
</body>
</html>