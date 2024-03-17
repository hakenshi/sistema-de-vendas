@extends('layouts.main')

@section('title', 'Dashboard')

@section('content')

@dd($user)

    <div class="col-md-auto offset-md-1">
        <div class="usuario-container">
            <div class="row">
                <div class="profile-image-container">
                    <img src="/storage/server/user-photos/{{ $user->profile_photo_path }}" alt="">
                    <p>Olá, {{ $user->name }}</p>
                </div>
            </div>
            <h3 class="text-center pb-5">O que você gostaria de fazer hoje?</h3>
            <div class="row user-actions-container">
                <div class="col-md-4 pb-3" box>
                    <a href="/dashboard/minhas-informacoes/ {{ $user->id }}">
                        <div class="box">
                            <div class="box-inner">
                                <ion-icon class="icon" name="pencil-outline"></ion-icon>
                                <span>Alterar dados</span>
                            </div>
                        </div>
                    </a>
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
                    <a href="/produtos/meus-produtos/{{ $user->id }}">
                        <div class="box">
                            <div class="box-inner">
                                <ion-icon class="icon" name="eye-outline"></ion-icon>
                                <span>Meus produtos</span>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-4 offset-md-2 pb-3">
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
