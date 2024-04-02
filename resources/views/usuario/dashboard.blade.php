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
                                    0
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
                                    R$ 5.00 <ion-icon name="cash-outline"></ion-icon>
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
                                   nome do produto
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
                            <td class="text-center">{{ date( 'H:i', strtotime($venda->hora_venda)) }}</td>
                            <td class="text-center"><button class="btn btn-info">Ver Mais</button></td>
                        </tr>
                        
                        @endforeach
                        
                    </tbody>
                </table>
                {{-- {{ $vendas->count() }} --}}
                <div class="col-md-10 offset-md-5">{{ $vendas->links() }}</div>
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
                                    0
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
                                    R$ 5.00 <ion-icon name="cash-outline"></ion-icon>
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
                                   nome do produto
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
                            {{-- <td class="text-center">{{ $venda->id }}</td> --}}
                            <td class="text-center">{{ $venda->valor_venda }}</td>
                            <td class="text-center">{{ $venda->desconto }}%</td>
                            <td class="text-center">{{ $venda->quantidade }}</td>
                            <td class="text-center">{{ date( 'H:i', strtotime($venda->hora_venda)) }}</td>
                            <td class="text-center"><button class="btn btn-info">Ver Mais</button></td>
                        </tr>
                        
                        @endforeach

                    </tbody>
                </table>
                <div class="col-md-10 offset-md-5">{{ $vendas->links() }}</div>
            </div>
        </div>
    </div>
    @endif

@endsection
