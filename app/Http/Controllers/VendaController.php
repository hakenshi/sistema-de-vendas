<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VendaController extends Controller
{

    public function index()
    {
    
        try {

        return view('vendas.nova-venda');

        } catch (\Exception $e) {

            return dd($e->getMessage());

        }
        
    }

    public function addList(Request $request){

        try {
            
            $produto = Produto::findOrFail($request->id);
            
            return response()->json([
                'produto' => $produto,
                'code' => 200,
                'status' => 'sucesso'
            ]);

        } catch (\Exception $e) {
           return response()->json([
                'error' => $e->getMessage(),
                'code' => 500,
                'status' => 'error'
           ]);
        }
    }

    public function search(Request $request)
    {   
        if ($request->ajax()) {
            $output = "";
            $produtos = DB::table('produtos')->where('nome_produto', 'LIKE', "%" . $request->search . "%")->get();
        }
        if ($produtos) {
            foreach ($produtos as $produto) {
                $output .= 
                '<tr>' .
                '<td> <input type="hidden" value="'.$produto->id.'">'.
                '<td><img class="product-image" src="/storage/server/' . $produto->imagem_produto . '" alt="'.$produto->descricao_produto.'"></td>' .
                '<td>' . $produto->nome_produto . '</td>' .
                '<td> R$' . $produto->valor_produto . '</td>' .
                '<td><button type="button" data-id="'.$produto->id.'" class="btn btn-primary add-btn" onclick="addToList(this)"><ion-icon name="add-outline"></ion-icon></button>'. 
                '</tr>';
            }
        }
        
        return response($output);
    }

    public function store(Request $request)
    {
        //
    }
}
