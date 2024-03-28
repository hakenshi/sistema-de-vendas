@extends('layouts.main')

@section('title', 'Registrar Venda')

@section('content')

    <div class="info-container flex-column my-3">
        <h2 class="text-center">
            Registrar venda
        </h2>

        <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Busque um produto" id="search">
        </div>

        <table class="table">
            <tbody id="search-container">
            </tbody>
        </table>

    </div>
    <div class="info-container flex-column">
        <h2 class="text-center p-2">Produtos da venda</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Produto</th>
                    <th>Nome</th>
                    <th>Preço</th>
                    <th>Quantidade</th>
                    <th></th>
                </tr>
            </thead>
            <tbody id="lista">
            </tbody>
        </table>
        <div class="py-2 d-flex flex-row justify-content-between align-items-center">

            <p id="total">Valor total: R$ 0.00 </p>
            
           <span>Desconto: <input value="0" type="number" class="w-25"></span> 

            <button class="btn btn-success">Encerrar</button>
        </div>
    </div>
@endsection
