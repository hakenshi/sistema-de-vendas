<?php

use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\VendaController;
use App\Models\Produto;
use Illuminate\Support\Facades\Route;

// Rotas relacionadas ao usuário
Route::get('/',[UsuarioController::class, 'index'])->middleware('auth');
Route::get('/funcionarios',[UsuarioController::class, 'listUsers'])->middleware('auth');
Route::get('/register', [UsuarioController::class, 'register'])->middleware('auth');
Route::post('/register-user', [UsuarioController::class, 'store'])->middleware('auth');
Route::delete('/delte-user/{id}', [UsuarioController::class, 'destroy'])->middleware('auth');
Route::get('/edit-user/{id}', [UsuarioController::class, 'editar'])->middleware('auth');
Route::put('/update/{id}', [UsuarioController::class, 'update'])->middleware('auth');

// Rotas relacionadas aos produtos
Route::get('/registrar-produto', [ProdutoController::class, 'registrar'])->middleware('auth');
Route::get('/listar-produtos', [ProdutoController::class, 'show'])->middleware('auth');
Route::post('/cadastrar-produto', [ProdutoController::class, 'store'])->middleware('auth');
Route::delete('/produtos/destroy/{id}', [ProdutoController::class, 'destroy'])->middleware('auth');
Route::get('/produtos/editar/{id}', [ProdutoController::class, 'editar'])->middleware('auth');
Route::put('/produtos/update/{id}', [ProdutoController::class, 'update'])->middleware('auth');

// Rotas relacionadas as vendas

Route::get('/venda/nova-venda', [VendaController::class, 'index'])->middleware('auth');
Route::get('/vendas/nova-venda/{id}', [VendaController::class, 'addList'])->middleware('auth');
Route::get('/venda/search', [VendaController::class, 'search'])->middleware('auth');
Route::post('/venda/store', [VendaController::class, 'store'])->middleware('auth');