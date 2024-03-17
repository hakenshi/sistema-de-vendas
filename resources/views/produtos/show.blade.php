@extends('layouts.main')

@section('title', 'Produtos Cadastrados')

@section('content')


<div class="col-md-10 offset-md-1 p-5">
      @if (count($produtos) > 0)
          
      
    <table class="table table-bordered table-responsive">
    <thead class="table-dark">
      <tr>
        <th scope="col">imagem do produto</th>
        <th scope="col">Nome do Produto</th>
        <th scope="col">Descrição do Produto</th>
        <th scope="col">Preço do Produto</th>
        <th scope="col" colspan="2" rowspan="2"></th>
      </tr>
    </thead>
    <tbody>

      @foreach ($produtos as $produto)
      <tr>
        <td><img class="product-image" src="/storage/server/{{ $produto->imagem_produto }}" alt="{{ $produto->nome_produto }}"></td>
        <td>{{ $produto->nome_produto }}</td>
        <td>{{ $produto->descricao_produto }}</td>
        <td>{{ $produto->valor_produto }}</td>
        <td>
          <a href="/produtos/meus-produtos/editar/{{ $produto->id }}" class="text-white btn btn-primary">Editar</a>
          <button data-produto-id="{{ $produto->id }}" class="text-white btn btn-danger" onclick="destroy(this)">Excluir</button></td>
      </tr>
      @endforeach
    </tbody>
      </table>

      @else
          <p>Nenhum produto a ser exibido</p>
      @endif

</div>


@endsection