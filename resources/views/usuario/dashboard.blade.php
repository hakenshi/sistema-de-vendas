@extends('layouts.main')

@section('title', 'Dashboard')

@section('content')

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
                <table class="table table-borde">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Produto</th>
                            <th scope="col">Funcionário</th>
                            <th scope="col">Valor da Venda</th>
                            <th scope="col">Desconto</th>
                            <th scope="col">Quantidade Vendida</th>
                            <th scope="col">Hora da venda</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
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
                            <th scope="col">ID</th>
                            <th scope="col">Produto</th>
                            <th scope="col">Valor da Venda</th>
                            <th scope="col">Desconto</th>
                            <th scope="col">Quantidade Vendida</th>
                            <th scope="col">Hora da venda</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @endif

@endsection
