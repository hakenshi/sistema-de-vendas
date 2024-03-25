@extends('layouts.main')

@section('title', 'Produtos Cadastrados')

@section('content')


<div class="info-container mt-5">
  <div class="container">
    <h2 class="text-center p-3">Estoque</h1>
        @if (count($produtos) > 0)
      <table class="table">
      <thead>
        <tr>
          <th scope="col">imagem do produto</th>
          <th scope="col">Nome do Produto</th>
          <th scope="col">Descrição do Produto</th>
          <th scope="col">Preço do Produto</th>
          <th scope="col">Quantidade</th>
          <th scope="col" ></th>
        </tr>
      </thead>
      <tbody>
  
        @foreach ($produtos as $produto)
        <tr>
          <td><img class="product-image" src="/storage/server/{{ $produto->imagem_produto }}" alt="{{ $produto->nome_produto }}"></td>
          <td>{{ $produto->nome_produto }}</td>
          <td>{{ $produto->descricao_produto }}</td>
          <td>R$ {{ $produto->valor_produto }}</td>
          <td>
            <a href="/produtos/editar/{{ $produto->id }}" class="text-white btn btn-primary">Editar</a>
            <button data-id="{{ $produto->id }}" class="text-white btn btn-danger" onclick="destroy(this, '/produtos/destroy/' + {{ $produto->id }})">Excluir</button></td>
        </tr>
        @endforeach
      </tbody>
        </table>
  
        @else
            <p class="text-center p-5 h2">Nenhum produto a ser exibido</p>
        @endif
  
  </div>
</div>


@endsection