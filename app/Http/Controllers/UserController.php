<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    public function index()
    {
        $users = User::latest()->get(); // Obtener de la tabla users todos los registros

        return view('welcome', [
            'users' => $users
        ]);
    }

    public function destroy(User $user)
    {
        $user->delete();

        return back();
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'      => ['required'],
            'email'     => ['required', 'email', 'unique:users'],
            'password'  => ['required', 'min:8'],
        ]);

        User::create([
            'name'      => $request->name,
            'email'     => $request->email,
            'password'  => bcrypt($request->password),
        ]);

        return back();
    }
}
