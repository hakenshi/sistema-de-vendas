<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Venda;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class UsuarioController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if ($user->user_type == 0) {

            $vendas = DB::table('vendas')
                ->join('users', 'users.id', '=', 'vendas.id_usuario')
                ->join('produto_venda', 'produto_venda.id_venda', '=', 'vendas.id')
                ->select(
                    'vendas.id',
                    'users.name as nome',
                    'vendas.valor_venda',
                    'produto_venda.desconto_venda as desconto',
                    'vendas.quantidade_venda as quantidade',
                    'vendas.created_at as hora_venda'
                )
                ->distinct()
                ->simplePaginate(6);
        }

        else{
            $vendas = DB::table('vendas')
                ->join('users', 'users.id', '=', 'vendas.id_usuario')
                ->join('produto_venda', 'produto_venda.id_venda', '=', 'vendas.id')
                ->select(
                    'vendas.valor_venda',
                    'produto_venda.desconto_venda as desconto',
                    'vendas.quantidade_venda as quantidade',
                    'vendas.created_at as hora_venda'
                )
                ->distinct()
                ->simplePaginate(6);
        }
        
        return view('usuario.dashboard', [
            'user' => $user,
            'vendas' => $vendas
        ]);
    }

    public function editar($id)
    {

        $user = User::findOrFail($id);
        return view('usuario.editar', [
            'user' => $user
        ]);
    }

    public function update(Request $request)
    {

        try {
            $user = User::findOrFail($request->id);



            $data = [
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'cpf' => $request->input('cpf'),
                'user_type' => $request->input('user_type'),
            ];

            if (!empty($request->input('password'))) {
                $data['password'] = bcrypt($request->input()['password']);
            }

            if ($request->hasFile('image') && $request->file('image')->isValid()) {
                $requestImage = $request->image;

                $extension = $requestImage->extension();

                $imageName = md5($requestImage->getClientOriginalName()) . '.' . $extension;

                $data['profile_photo_path'] = $imageName;

                $requestImage->storeAs('/profile-photos', $imageName);
            }

            $user->update($data);

            return redirect('/')->with('msg', 'Informações atualizadas com sucesso');
        } catch (\Exception $e) {
            return redirect()->back()->with('msg', $e->getMessage() . ' Erro ao atualizar informações');
        }
    }

    public function register()
    {
        return view('usuario.register');
    }
    public function store(Request $request)
    {
        $user = new User();
        $user->name = $request->input('nome');
        $user->email = $request->input('email');
        $user->cpf = $request->input('cpf');
        $user->password = bcrypt($request->input('password'));
        $user->status = $request->input('status');
        $user->user_type = $request->input('user_type');
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $requestImage = $request->image;

            $extension = $requestImage->extension();

            $imageName = md5($requestImage->getClientOriginalName()) . '.' . $extension;

            $data['profile_photo_path'] = $imageName;

            $requestImage->storeAs('/profile-photos', $imageName);
        }
        $user->save();

        return redirect('/')->with('msg', 'Usuario registrado com sucesso');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return response()->json([
            'success' => 'Usuário apagado com sucesso',
        ]);
    }


    public function listUsers()
    {

        $users = User::paginate(10);

        return view('usuario.show', [
            'users' => $users
        ]);
    }
}
