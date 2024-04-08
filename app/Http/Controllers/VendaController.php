<?php

namespace App\Http\Controllers;

use App\Models\Estoque;
use App\Models\Produto;
use App\Models\ProdutoVenda;
use App\Models\Venda;
use Illuminate\Contracts\View\View;
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

    public function addList(Request $request)
    {

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
            $produtos = DB::table('produtos')
                ->join('estoque', 'produtos.id', '=', 'estoque.id_produto')
                ->where('nome_produto', 'LIKE', "%" . $request->search . "%")
                ->where('estoque.quantidade_produto', '>', 0)
                ->get();

            // dd($produtos);

            if ($produtos) {
                foreach ($produtos as $produto) {
                    $output .=
                        '<tr>' .
                        '<td> <input type="hidden" value="' . $produto->id . '">' .
                        '<td><img class="product-image" src="/storage/server/' . $produto->imagem_produto . '" alt="' . $produto->descricao_produto . '"></td>' .
                        '<td>' . $produto->nome_produto . '</td>' .
                        '<td> R$ ' . $produto->valor_produto . '</td>' .
                        '<td> ' . $produto->quantidade_produto . '</td>' .
                        '<td><button type="button" data-id="' . $produto->id . '" class="btn btn-primary add-btn" onclick="addToList(this)"><ion-icon name="add-outline"></ion-icon></button>' .
                        '</tr>';
                }
            }

            return response($output);
        }
    }

    public function store(Request $request)
    {
        try {
            if ($request->ajax()) {
                $venda = new Venda();
                $user = auth()->user();
                $venda->id_usuario = $user->id;
                $venda->valor_venda = $request->valorTotal;
                $venda->quantidade_venda = $request->quantidadeTotal;

                $venda->save();

                $produtos = $request->produtos;

                if ($produtos) {

                    foreach ($produtos as $i => $produto) {
                        $produtoVenda = new ProdutoVenda();

                        $produtoVenda->id_venda = $venda->id;
                        $produtoVenda->id_produto = $produto['produto']['id'];
                        $produtoVenda->valor_venda = $produto['produto']['valor_produto'];
                        $produtoVenda->quantidade = $request->quantidades[$i];
                        $produtoVenda->desconto_venda = $request->desconto;
                        $produtoVenda->save();
                        $estoque = Estoque::where('id_produto', $produto['produto']['id'])->first();
                        if ($estoque) {
                            if ($estoque->quantidade_produto > 0) {
                                $novaQuantidade = $estoque->quantidade_produto - $request->quantidades[$i];
                                $estoque->update(['quantidade_produto' => $novaQuantidade]);
                            } else {
                                return response()->json([
                                    'code' => 400,
                                    'mensagem' => throw new \Exception("Falha atualizar estoque, produto indisponível no estoque"),
                                ]);
                            }
                        }
                    }
                }
            }
            return response()->json([
                'redirect_url' => url('/'),
                'code' => 200,
                'mensagem' => 'Venda finalizada com sucesso'
            ]);
        } catch (\Throwable $e) {
            return json_encode([
                'code' => 400,
                'mensagem' => $e->getMessage(),
            ]);
        }
    }

    public function showSellInfo(Request $request)
    {

        if ($request->ajax()) {
            $produtos = ProdutoVenda::join('produtos', 'produtos.id', '=', 'produto_venda.id_produto')
                ->join('vendas', 'vendas.id', '=', 'produto_venda.id_venda')
                ->where('id_venda', $request->id)
                ->select(
                    'vendas.id',
                    'nome_produto',
                    'produto_venda.id_produto',
                    'descricao_produto',
                    'valor_produto',
                    'quantidade',
                    'vendas.valor_venda',
                    'desconto_venda as desconto',
                    'vendas.created_at as hora_venda',
                    'imagem_produto'
                )
                ->paginate(10);

            return response()->json([
                'produtos' => $produtos,
            ]);
        }
    }


    public function destroy($id)
    {
        $venda = Venda::findOrFail($id);
        $venda->user()->delete();
        $venda->produtos()->detach();
        $venda->delete();

        return response()->json([
            'success' => 'Venda apagada com sucesso',
        ]);
    }

    public function update(Request $request)
{
    try {
        if ($request->ajax()) {
            $produtos = $request->produtos;

            // dd($produtos);
            $id = $produtos[0]['id'];
            $venda = Venda::findOrFail($id);
            // dd($venda);

            // // dd($produtos);

            ProdutoVenda::where('id_venda', $id)->delete();

            foreach ($produtos as $i => $produto) {
                ProdutoVenda::create([
                    'id_venda' => $id,
                    'id_produto' => $produto['id_produto'],
                    'valor_venda' => $request->valorTotal,
                    'quantidade' => $request->quantidades[$i],
                    'desconto_venda' => $produto['desconto']
                ]);
            }



            $venda->quantidade_venda = $request->quantidadeTotal;
            $venda->valor_venda = $request->valorTotal;
            $venda->update();

            return response()->json([
                'success' => 'Venda atualizada com sucesso',
            ]);
        }
    } catch (\Exception $e) {
        return response()->json([
            'code' => 400,
            'mensagem' => $e->getMessage(),
        ]);
    }
}

}
