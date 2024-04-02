@extends('layouts.main')

@section('title', 'Dashboard')

@section('content')

<div class="info-container mt-5">
    <div class="container">
        <h2 class="text-center p-3">Funcionários</h2>
        <table class="table">
          <thead>
            <tr>
              <th scope="col">Nome</th>
              <th scope="col">Email</th>
              <th scope="col">CPF</th>
              <th scope="col">Status</th>
              <th scope="col">Tipo de Usuário</th>
              <th scope="col">Data de Admissão</th>
              <th scope="col"></th>
            </tr>
          </thead>
          <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->cpf }}</td>
                    <td>{{ $user->status ? "Ativo" : "inativo" }}</td>
                    <td>{{ $user->user_type ? "Funcionario" : "Admin" }}</td>
                    <td>{{ date('d/m/Y, H:i', strtotime($user->created_at)) }}</td>
                    <td><a href="/edit-user/{{ $user->id }}" class="text-white btn btn-primary">Editar</a>
                    <button data-id="{{ $user->id }}" class="text-white btn btn-danger" onclick="destroy(this, '/delte-user/' + {{ $user->id }})">Excluir</button></td>
                  </tr>
            @endforeach
          </tbody>
        </table>
        <div class="col-md-10 offset-md-5">{{ $users->links() }}</div>
      </div>
</div>

@endsection