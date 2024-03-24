@extends('layouts.main')

@section('title', 'Dashboard')

@section('content')

    <div id="data-container">
        <div class="info-container">
            <div class="card-container">
                <h3 class="main-title">Informações de hoje</h3>
                <div class="card-wrapper">
                    <div class="payment-card">
                        <div class="card-header">
                            <div class="amount">
                                <p class="title">
                                    Total de vendas:
                                </p>
                                <p class="amout-value">
                                    R$ 5.00 <ion-icon name="cash-outline"></ion-icon>
                                </p>

                            </div>
                        </div>
                    </div>
                    <div class="payment-card">
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
                    <div class="payment-card">
                        <div class="card-header">
                            <div class="amount">
                                <p class="title">
                                    Produto mais vendido:
                                </p>
                                <p class="amout-value">
                                    R$ 5.00 <ion-icon name="cash-outline"></ion-icon>
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

@endsection
