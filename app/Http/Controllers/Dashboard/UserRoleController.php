<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\User;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserRoleController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:ver-boton-roles-y-permisos|ver-asignar-rol|ver-tabla-asignar-rol|editar-asignar-rol|mostrar-asignar-rol', ['only' => ['index']]);
        $this->middleware('permission:editar-asignar-rol', ['only' => ['edit', 'update']]);
        $this->middleware('permission:mostrar-asignar-rol', ['only' => ['show']]);
    }

    public function index()
    {
        $getRoles = Role::all();
        $getUsers = User::all();

        return view('dashboard.assign_roles.index', [
            'getUsers' => $getUsers,
            'getRoles' => $getRoles,
        ]);
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('dashboard.assign_roles.show', [
            'user' => $user,
        ]);
    }

    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::all();

        return view('dashboard.assign_roles.edit', [
            'user' => $user,
            'roles' => $roles,
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'role_id' => 'required|array',
        ]);
        $user = User::findOrFail($id);
        $user->roles()->sync($request->input('role_id', []));
        return redirect()->route('usersroles.index')->with('update', 'Roles Actualizados Correctamente!');
    }
}
