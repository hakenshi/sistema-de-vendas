@extends('layouts.main')

@section('title', 'Editando '. $user->name)

@section('content')

<div class="info-container flex-column mt-3 mb-3">
    <div class="col-md-10 offset-md-1">
        <div class="preview-container">
            <img src="{{ $user->profile_photo_path ? '/storage/profile-photos/' . $user->profile_photo_path : '/assets/placeholder.png' }}" id="preview" class="img-fluid">
        </div>
    </div>
    <form class="col-md-10 offset-md-1 p-3" method="POST" action="/update/{{ $user->id }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-floating pb-3">
            <input class="form-control" type="text" name="name" id="name"
                placeholder="Nome" value="{{ $user->name }}">
            <label for="name">Nome</label>
        </div>
        <div class="form-floating pb-3">
            <input class="form-control" type="text" name="email" id="email"
                placeholder="Email" value="{{ $user->email }}">
            <label for="email">Email</label>
        </div>
        <div class="form-floating pb-3">
            <input class="form-control" type="text" name="cpf" id="cpf"
                placeholder="cpf" value="{{ $user->cpf }}" maxlength="14">
            <label for="senha-usuario">CPF</label>
        </div>
        <div class="form-floating pb-3">
            <input class="form-control" type="password" name="password" id="password"
                placeholder="password">
            <label for="password-usuario">Senha</label>
        </div>
        <div class="form-floating pb-3">
            <select class="form-select" name="status" id="status">
                <option value="active" {{ ($user->status == 'active') ? 'selected' : '' }}>Ativo</option>
                <option value="inactive" {{ ($user->status == 'inactive') ? 'selected' : '' }}>Inativo</option>
            </select>
            <label for="status">Status do funcionário</label>
        </div>

        <div class="form-floating pb-3">
            <select class="form-select" name="user_type" id="user_type">
                <option value="1" {{ ($user->user_type == 1) ? 'selected' : '' }}>Funcionário</option>
                <option value="0" {{ ($user->user_type == 0) ? 'selected' : '' }}>Admin</option>
            </select>
            <label for="user_type">Tipo do funcionário</label>
        </div>
        <div class="form-group pb-3">
            <label for="image">Foto de perfil</label>
            <input class="form-control" type="file" name="image" id="image"
                placeholder="Insira o imagem do produto">
        </div>
        <button class="btn btn-primary">Enviar</button>
    </form>
</div>

@endsection
