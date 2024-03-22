<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UsuarioController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        return view('usuario.dashboard', [
            'user' => $user
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

        $user = User::findOrFail($request->id);

        $data = [
            'name' => $request->input('nome-usuario'),
            'email' => $request->input('email-usuario'),
            'bio_info' => $request->input('bio-usuario'),
        ];


        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $requestImage = $request->image;

            $extension = $requestImage->extension();

            $imageName = md5($requestImage->getClientOriginalName()) . '.' . $extension;

            $data['profile_photo_path'] = $imageName;

            $requestImage->storeAs('server/user_photos', $imageName);
           
        }

        $user->update($data);

        return redirect('/dashboard')->with('msg', 'Informações atualizadas com sucesso');
    }

    public function show(){

        $users = User::all();

        return view('usuarios.show', [
            'users' => $users
        ]);
    }

}
