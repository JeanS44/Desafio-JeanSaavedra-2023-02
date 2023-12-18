<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;

class RolePermissionController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:ver-boton-roles-y-permisos|ver-asignar-permiso|ver-tabla-asignar-permiso|editar-asignar-permiso|mostrar-asignar-permiso', ['only' => ['index']]);
        $this->middleware('permission:editar-asignar-permiso', ['only' => ['edit', 'update']]);
        $this->middleware('permission:mostrar-asignar-permiso', ['only' => ['show']]);
    }

    public function index()
    {
        $getRoles = Role::all();
        $getPermissions = Permission::all();

        return view('dashboard.assign_permissions.index', [
            'getRoles' => $getRoles,
            'getPermissions' => $getPermissions,
        ]);
    }

    public function show($id)
    {
        $role = Role::findOrFail($id);
        return view('dashboard.assign_permissions.show', [
            'role' => $role,
        ]);
    }

    public function edit($id)
    {
        $role = Role::find($id);
        $permissions = Permission::all();

        return view('dashboard.assign_permissions.edit', [
            'role' => $role,
            'permissions' => $permissions,
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'permission_id' => 'required|array',
        ]);
        $role = Role::findOrFail($id);
        $permission = $request->input('permission_id');
        $role->permissions()->sync($permission);
        return redirect()->route('rolespermissions.index')->with('update', 'Permisos  Actualizados Correctamente!');
    }
}
