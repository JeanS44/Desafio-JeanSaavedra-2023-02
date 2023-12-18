<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Registered;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:ver-boton-roles-y-permisos|ver-permiso|ver-tabla-permiso|crear-permiso|editar-permiso|mostrar-permiso|borrar-permiso', ['only' => ['index']]);
        $this->middleware('permission:crear-permiso', ['only' => ['create', 'store']]);
        $this->middleware('permission:editar-permiso', ['only' => ['edit', 'update']]);
        $this->middleware('permission:mostrar-permiso', ['only' => ['show']]);
        $this->middleware('permission:borrar-permiso', ['only' => ['destroy']]);
    }

    public function index()
    {
        $permissions = Permission::all();

        return view('dashboard.permissions.index', [
            'permissions' => $permissions,
        ]);
    }

    public function create()
    {
        return view('dashboard.permissions.add');
    }

    public function store(Request $request)
    {
        if (Permission::where('name', $request->name)->count() > 0) {
            return redirect()->back()->with('error', 'Este Permiso ya está registrado!');
        } else {
            $request->validate([
                'name' => ['required', 'string', 'min:1', 'max:255'],
            ]);

            $permission = Permission::create([
                'name' => $request->name
            ]);
            event(new Registered($permission));
            return redirect()->route('permissions.index')->with('success', 'Permiso Registrado Correctamente!');
        }
    }

    public function edit($id)
    {
        $permission = Permission::findOrFail($id);

        return view('dashboard.permissions.edit', [
            'permission' => $permission,
        ]);
    }

    public function update(Request $request, $id)
    {
        $permission = Permission::findOrFail($id);
        /* $request->validate([
            'name' => ['string', 'min:1', 'max:255'],
            'surname' => ['string', 'min:1', 'max:255'],
            'username' => ['string', 'min:3', 'max:30', 'unique:users,username'],
            'email' => ['string', 'email', 'max:255', 'unique:users,email'],
        ]); */
        $permission->name = $request->input('name');
        $permission->save();
        return redirect()->route('permissions.index')->with('update', 'Permiso Actualizado Correctamente!');
    }

    public function show(Permission $permission)
    {
        return view('dashboard.permissions.show', [
            'permission' => $permission,
        ]);
    }

    public function destroy($id)
    {
        $permission = Permission::findOrFail($id);
        $permission->delete();
        return redirect()->back()->with('delete', 'Permiso Eliminado Correctamente!');
    }
}
