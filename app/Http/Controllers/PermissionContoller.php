<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionContoller extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $permissions = permission::all();
        return view('permissions', ['permissions' => $permissions]);
    }

    public function store(Request $request)
    {
        $validateData = $request->validate([
            'name' => 'required',
        ]);
        Permission::create($validateData);
        return redirect()->route('permission.show');
    }
}
