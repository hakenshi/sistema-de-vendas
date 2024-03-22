@extends('layouts.main')

@section('title', 'Dashboard')

@section('content')

    <div id="data-container">
        <div class="info-container">
            <div class="card-container">
                <h3 class="main-title">data de hoje</h3>
                <div class="card-wrapper">
                    <div class="payment-card">
                        <div class="card-header">
                            <div class="amount">
                                <span class="title">
                                    Valor total de vendas:
                                </span>
                                <span class="amout-value">
                                    R$ 5.00
                                </span>
                                <ion-icon name="cash-outline"></ion-icon>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection
