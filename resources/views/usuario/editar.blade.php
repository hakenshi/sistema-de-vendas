@extends('layouts.main')

@section('title', 'Perfil do usuário')

@section('content')

    <div class="col-md-10 offset-md-1">
        <div class="preview-container">
            <img src="/storage/server/{{ $user->profile_photo_path }}" id="preview" class="img-fluid">
        </div>
    </div>
    <div class="col-md-10 offset-md-1 p-3">
        <form method="POST" action="/dashboard/minhas-informacoes/update/{{ $user->id }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-floating pb-3">
                <input class="form-control" type="text" name="nome-usuario" id="nome-usuario"
                    placeholder="Nome" value="{{ $user->name }}">
                <label for="nome-usuario">Nome</label>
            </div>
            <div class="form-floating pb-3">
                <input class="form-control" type="text" name="email-usuario" id="email-usuario"
                    placeholder="Email" value="{{ $user->email }}">
                <label for="email-usuario">Email</label>
            </div>  
            <div class="form-group pb-3">
                <label for="descricao-produto">Bio</label>
                <textarea class="form-control" type="text" name="bio-usuario" id="bio-usuario">{{ $user->bio_info }}</textarea>
            </div>
        
            <div class="form-group pb-3">
                <label for="image">Foto de perfil</label>
                <input class="form-control" type="file" name="image" id="image"
                    placeholder="Insira o imagem do produto">
            </div>
            <button class="btn btn-primary">Enviar</button>  
        </form>
    </div>
    
    

    <div class="col-md-10">
        
    </div>

@endsection