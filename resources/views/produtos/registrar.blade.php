@extends('layouts.main')

@section('title', 'Cadastrar Produto')

@section('content')

    
    <div class="info-container flex-column mt-3 pb-3">
        <div class="col-md-10 offset-md-1">
            <div class="preview-container">
                <img id="preview" class="img-fluid">
            </div>
        </div>
            <form class="p-3" action="/cadastrar-produto" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-floating pb-3">
                    <input class="form-control" type="text" name="nome-produto" id="nome-produto"
                        placeholder="Insira o nome do produto">
                    <label for="nome-produto">Nome do produto</label>
                </div>
                <div class="form-group pb-3">
                    <label for="descricao-produto">Descricao do produto</label>
                    <textarea class="form-control" type="text" name="descricao-produto" id="descricao-produto"></textarea>
                </div>
                <div class="form-floating pb-3">
                    <input class="form-control" type="text" name="valor-produto" id="valor-produto"
                        placeholder="Insira o valor do produto">
                    <label for="valor-produto">Valor do produto</label>
                </div>
                <div class="form-group pb-3">
                        <label for="valor-produto">Quantidade</label>
                        <input class="form-control" value="1" type="number" name="quantidade-produto" id="quantidade-produto">
                </div>
                <div class="form-group pb-3">
                    <label for="image">Imagem do produto</label>
                    <input class="form-control" type="file" name="image" id="image"
                        placeholder="Insira o imagem do produto" accept=".png, .jpeg, ./jpg">
                </div>
                <button class="btn btn-primary">Enviar</button>
            </form>
        </div>
    
    
@endsection