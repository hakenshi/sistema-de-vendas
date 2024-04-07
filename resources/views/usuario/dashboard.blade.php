@extends('layouts.main')

@section('title', 'Dashboard')

@section('content')

    {{-- @vite('resources/css/app.css') --}}
    @if ($user->user_type == 0)

        <div id="data-container">
            <div class="info-container">
                <div class="card-container">
                    <h3 class="main-title">Informações de hoje</h3>
                    <div class="card-wrapper">
                        <div class="payment-card bg-red">
                            <div class="card-header">
                                <div class="amount">
                                    <p class="title">
                                        Total de vendas:
                                    </p>
                                    <p class="amout-value">
                                        {{ $totalVendas }}
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="payment-card bg-green">
                            <div class="card-header">
                                <div class="amount">
                                    <p class="title">
                                        Valor total de vendas:
                                    </p>
                                    <p class="amout-value">
                                        R$ {{ $valorTotal == 0 ? '0.00' : $valorTotal }} <ion-icon
                                            name="cash-outline"></ion-icon>
                                    </p>

                                </div>
                            </div>
                        </div>
                        <div class="payment-card bg-blue">
                            <div class="card-header">
                                <div class="amount">
                                    <p class="title">
                                        Produto mais vendido:
                                    </p>
                                    <p class="amout-value">
                                        {{ $produtoMaisVendido == null ? 'Não há produtos' : $produtoMaisVendido->nome_produto }}
                                    </p>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="info-container mt-3">
                <div class="container">
                    <h2 class="text-center p-3">Tabela de Vendas</h2>
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="text-center" scope="col">ID</th>
                                <th class="text-center" scope="col">Funcionário</th>
                                <th class="text-center" scope="col">Valor da Venda</th>
                                <th class="text-center" scope="col">Desconto</th>
                                <th class="text-center" scope="col">Quantidade Vendida</th>
                                <th class="text-center" scope="col">Hora da venda</th>
                                <th class="text-center" scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>

                            {{-- @dd($vendas --}}

                            @foreach ($vendas as $venda)
                                <tr>
                                    <td class="text-center">{{ $venda->id }}</td>
                                    <td class="text-center">{{ $venda->nome }}</td>
                                    <td class="text-center">{{ $venda->valor_venda }}</td>
                                    <td class="text-center">{{ $venda->desconto }}%</td>
                                    <td class="text-center">{{ $venda->quantidade }}</td>
                                    <td class="text-center">{{ date('H:i', strtotime($venda->hora_venda)) }}</td>
                                    <td class="text-center">
                                        <!-- Button trigger modal -->
                                        <button type="button" onclick="showSellData({{ $venda->id }})"
                                            class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                            Detalhes
                                        </button>

                                        <!-- Modal -->
                                        <div class="modal fade" id="exampleModal" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Detalhes da
                                                            venda</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <table class="table">
                                                            <tbody id="lista">
                                                                
                                                            </tbody>

                                                        </table>
                                                    </div>
                                                    <div class="modal-footer justify-content-between">
                                                        <div>
                                                            <span id="total"></span>
                                                        </div>
                                                        <div>
                                                            <input id="quantidade-total" type="text" class="w-25"
                                                                    disabled></span>
                                                            <button id="edit-button" class="btn btn-info">Editar</button>
                                                            <button type="button"
                                                                onclick="destroy(this,'/venda/delete/{{ $venda->id }}')"
                                                                class="btn btn-danger" id="delete-button">Apagar</button>
                                                                
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                    <div class="col-md-5 offset-md-5">{{ $vendas->links() }}</div>
                </div>
            </div>
        </div>
    @else
        <div id="data-container">
            <div class="info-container">
                <div class="card-container">
                    <h3 class="main-title">Informações de hoje</h3>
                    <div class="card-wrapper">
                        <div class="payment-card bg-red">
                            <div class="card-header">
                                <div class="amount">
                                    <p class="title">
                                        Meu total de vendas:
                                    </p>
                                    <p class="amout-value">
                                        {{ $totalVendas }}
                                    </p>

                                </div>
                            </div>
                        </div>
                        <div class="payment-card bg-green">
                            <div class="card-header">
                                <div class="amount">
                                    <p class="title">
                                        Valor total de vendas:
                                    </p>
                                    <p class="amout-value">
                                        R$ {{ $valorTotal == 0 ? '0.00' : $valorTotal }} <ion-icon
                                            name="cash-outline"></ion-icon>
                                    </p>

                                </div>
                            </div>
                        </div>
                        <div class="payment-card bg-blue">
                            <div class="card-header">
                                <div class="amount">
                                    <p class="title">
                                        Produto mais vendido:
                                    </p>
                                    <p class="amout-value">
                                        {{ $produtoMaisVendido == null ? 'Não há produtos' : $produtoMaisVendido->nome_produto }}
                                    </p>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="info-container mt-3">
                <div class="container">
                    <h2 class="text-center p-3">Tabela de Vendas</h2>
                    <table class="table table-borde">
                        <thead>
                            <tr>
                                {{-- <th class="text-center" scope="col">ID</th> --}}
                                <th class="text-center" scope="col">Valor da Venda</th>
                                <th class="text-center" scope="col">Desconto</th>
                                <th class="text-center" scope="col">Quantidade Vendida</th>
                                <th class="text-center" scope="col">Hora da venda</th>
                                <th class="text-center" scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($vendas as $venda)
                                <tr>
                                    <td class="text-center">{{ $venda->valor_venda }}</td>
                                    <td class="text-center">{{ $venda->desconto }}%</td>
                                    <td class="text-center">{{ $venda->quantidade }}</td>
                                    <td class="text-center">{{ date('d/m/Y H:i', strtotime($venda->hora_venda)) }}</td>
                                    <td class="text-center"><!-- Button trigger modal -->
                                        <button type="button" onclick="showSellData({{ $venda->id }})"
                                            class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                            Detalhes
                                        </button>

                                        <!-- Modal -->
                                        <div class="modal fade" id="exampleModal" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Detalhes da
                                                            venda</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <table class="table">
                                                            <tbody id="lista">
                                                                
                                                            </tbody>

                                                        </table>
                                                    </div>
                                                    <div class="modal-footer justify-content-between">
                                                        <div>
                                                            <span id="total"></span>
                                                        </div>
                                                        {{-- <div>
                                                            <input id="quantidade-total" type="text" class="w-25"
                                                                    disabled></span>
                                                            <button id="edit-button" class="btn btn-info">Editar</button>
                                                            <button type="button"
                                                                onclick="destroy(this,'/venda/delete/{{ $venda->id }}')"
                                                                class="btn btn-danger" id="delete-button">Apagar</button>
                                                                
                                                        </div> --}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                    <div class="col-md-5 offset-md-5">{{ $vendas->links() }}</div>
                </div>
            </div>
        </div>
    @endif

@endsection
