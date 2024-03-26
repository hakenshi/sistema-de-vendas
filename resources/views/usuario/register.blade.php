@extends('layouts.main')

@section('title', 'Registrar Usuário')

@section('content')
   
    <div class="info-container flex-column mt-3 mb-3">
        <div class="col-md-10 offset-md-1">
            <div class="preview-container">
                <img id="preview">
            </div>
        </div>
            <form class="p-3" action="/register-user" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-floating pb-3">
                    <input class="form-control" type="text" name="nome" id="nome"
                        placeholder="Insira o nome do funcionario" autocomplete="off">
                    <label for="nome">Nome</label>
                </div>
                <div class="form-floating pb-3">
                    <input class="form-control" type="text" name="email" id="email"
                        placeholder="Insira o email do funcionario" autocomplete="off">
                    <label for="email">Email</label>
                </div>
                <div class="form-floating pb-3">
                    <input class="form-control" type="text" name="cpf" id="cpf"
                        placeholder="Insira o cpf do funcionario" autocomplete="off">
                    <label for="cpf">CPF</label>
                </div>
                <div class="form-floating pb-3">
                    <input class="form-control" type="text" name="data-nascimento" id="data-nascimento"
                        placeholder="Insira a data de nascimento funcionario" autocomplete="off">
                    <label for="data-nascimento">Data de nascimento</label>
                </div>
                <div class="form-floating pb-3">
                    <input class="form-control" type="password" name="password" id="password" placeholder="insira a senha do funcionário" autocomplete="off">
                    <label for="password">Senha</label>
                </div>
              
                <input type="hidden" name="status" id="status" value="active">
            
                <div class="form-floating pb-3">
                   <select placeholder="tipo do usuario" class="form-select" name="user_type" id="user_type">
                    <option value="1">Funcionario</option>
                    <option value="0">Admin</option>
                   </select>
                    <label for="valor-produto">Tipo do funcionario</label>
                </div>
                <div class="form-group pb-3">
                    <label for="image">Imagem do usuario</label>
                    <input class="form-control" type="file" name="image" id="image"
                        placeholder="Insira o imagem do produto">
                </div>
                <button class="btn btn-primary">Enviar</button>
            </form>
        </div>
        
@endsection