<?php

use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\UsuarioController;
use App\Models\Produto;
use Illuminate\Support\Facades\Route;
use Laravel\Jetstream\Rules\Role;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/',[ProdutoController::class, 'index']);

Route::get('/produtos/registrar', [ProdutoController::class, 'registrar']);

Route::post('/produtos', [ProdutoController::class, 'store'])->middleware('auth');

Route::get('/produtos/meus-produtos/{id}', [ProdutoController::class, 'show'])->middleware('auth');

Route::delete('/produtos/meus-produtos/destroy/{id}', [ProdutoController::class, 'destroy'])->middleware('auth');

Route::get('/produtos/meus-produtos/editar/{id}', [ProdutoController::class, 'editar'])->middleware('auth');

Route::put('/produtos/meus-produtos/update/{id}', [ProdutoController::class, 'update'])->middleware('auth');


Route::get('/dashboard/minhas-informacoes/{id}', [UsuarioController::class, 'editar'])->middleware('auth');

Route::put('/dashboard/minhas-informacoes/update/{id}', [UsuarioController::class, 'update'])->middleware('auth');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', [UsuarioController::class, 'index'])->name('dashboard');
});
