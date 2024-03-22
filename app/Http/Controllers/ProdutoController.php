<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProdutoController extends Controller
{

    public function registrar()
    {
        return view('produtos.registrar');
    }

    public function editar($id)
    {
        $produtos = Produto::FindOrFail($id);
        return view('produtos.update', [
            'produto' => $produtos
        ]);
    }

    public function index()
    {

        $user = auth()->user();

        return view('home', [
            'user' => $user,
        ]);
    }

    public function store(Request $request)
    {
        $produto = new Produto();
        $produto->nome_produto = $request->input('nome-produto');
        $produto->descricao_produto = $request->input('descricao-produto');
        $produto->valor_produto = $request->input('valor-produto');


        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $requestImage = $request->image;

            $extension = $requestImage->extension();

            $imageName = md5($requestImage->getClientOriginalName()) . '.' . $extension;

            $requestImage->storeAs('server', $imageName);

            $produto->imagem_produto = $imageName;
        }

        $produto->save();

        return redirect('/dashboard')->with('msg', 'Produto registrado com sucesso');
    }
    public function show()
    {
        $produtos = Produto::all();

        return view('produtos.show', [
            'produtos' => $produtos,
        ]);
    }

    public function update(Request $request)
    {
        try {
            $produto = Produto::findOrFail($request->id);

            $data = [
                'nome_produto' => $request->input('nome-produto'),
                'descricao_produto' => $request->input('descricao-produto'),
                'valor_produto' => $request->input('valor-produto'),
            ];

            if ($request->hasFile('image') && $request->file('image')->isValid()) {
                $requestImage = $request->image;

                $extension = $requestImage->extension();

                $imageName = md5($requestImage->getClientOriginalName()) . '.' . $extension;

                $data['imagem_produto'] = $imageName;

                $requestImage->storeAs('server', $imageName);

                Storage::disk('public')->delete('server/' . $produto->imagem_produto);

            }

            $produto->update($data);
            return redirect('/dashboard')->with('msg', 'Produto atualizado com sucesso');
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }

    public function destroy($id){
        $produto = Produto::findOrFail($id);
        $produto->delete();
    
        return response()->json([
            'success' => 'Produto apagado com sucesso'
        ]);
    }
}
