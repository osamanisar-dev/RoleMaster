<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserContoller extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $users = User::all();
        $roles = Role::pluck('name');
        return view('home', ['users' => $users, 'roles' => $roles]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required|min:8',
            'roles' => 'string'
        ]);
        $user = User::create($validatedData);
        if ($validatedData['roles']) {
            $roles = Role::findByName($validatedData['roles']);
            $user->syncRoles($roles);
        }
        return redirect()->route('user.show');
    }
}
