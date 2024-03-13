<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{


    public function index(){

        $produtos = Produto::all();

        return view('home',[
            'produtos' => $produtos
        ]);
    }
    public function registrar(){
        return view('produtos.registrar');
    }
    public function store(Request $request) {
        $produto = new Produto();
    
        $produto->nome_produto = $request->input('nome-produto');
        $produto->descricao_produto = $request->input('descricao-produto');
        $produto->valor_produto = $request->input('valor-produto');
        

        if($request->hasFile('image') && $request->file('image')->isValid()){
            $requestImage = $request->image;
            
            $extension = $requestImage->extension();
            
            $imageName = md5($requestImage->getClientOriginalName()) . '.' . $extension;

            $requestImage->storeAs('server', $imageName);
            
            $produto->imagem_produto = $imageName;

        }
        
        $produto->save();
    
        return redirect('/usuario/perfil')->with('msg', 'Produto registrado com sucesso');
    }
    
}
