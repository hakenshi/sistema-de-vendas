@extends('layouts.main')

@section('title', 'Perfil do usuário')

@section('content')

    <div class="col">
        <div class="usuario-container">
            <div class="row">
                <div class="profile-image-container">
                    <img src="/assets/placeholder.png" alt="">
                    <p>Olá, usuário</p>
                </div>
            </div>
            <h3 class="text-center pb-5">O que você gostaria de fazer hoje?</h3>
            <div class="row user-actions-container">
                <div class="col-md-4 pb-3" box>
                    <div class="box">
                        <div class="box-inner">
                            <ion-icon class="icon" name="pencil-outline"></ion-icon>
                            <span>Alterar dados</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 pb-3">
                    <a href="/produtos/registrar">
                        <div class="box">
                            <div class="box-inner">
                                <ion-icon class="icon" name="create-outline"></ion-icon>
                                <span>Cadastrar produtos</span>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-4 pb-3">
                    <div class="box">
                        <div class="box-inner">
                            <ion-icon class="icon" name="eye-outline"></ion-icon>
                            <span>Meus produtos</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 offset-2 pb-3">
                    <div class="box">
                        <div class="box-inner">
                            <ion-icon class="icon" name="create-outline"></ion-icon>
                            <span>Minhas vendas</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 pb-3">
                    <div class="box">
                        <div class="box-inner">
                            <ion-icon class="icon" name="cube-outline"></ion-icon>
                            Meu estoque
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
