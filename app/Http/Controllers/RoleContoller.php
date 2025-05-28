<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleContoller extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $roles = Role::all();
        $permissions = Permission::pluck('name');
        return view('role', ['roles' => $roles, 'permissions' => $permissions]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|unique:roles,name',
            'permissions' => 'array',
        ]);
        $role = Role::create(['name'=>$validatedData['name']]);
        if (!empty($validatedData['permissions'])) {
            $permissions = Permission::whereIn('name', $validatedData['permissions'])->get();
            $role->syncPermissions($permissions);
        }
        return redirect()->route('role.show');
    }
}
