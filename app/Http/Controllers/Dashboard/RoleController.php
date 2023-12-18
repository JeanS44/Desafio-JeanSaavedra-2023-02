<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Registered;

class RoleController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:ver-boton-roles-y-permisos|ver-rol|ver-tabla-rol|crear-rol|editar-rol|mostrar-rol|borrar-rol', ['only' => ['index']]);
        $this->middleware('permission:crear-rol', ['only' => ['create','store']]);
        $this->middleware('permission:editar-rol', ['only' => ['edit','update']]);
        $this->middleware('permission:mostrar-rol', ['only' => ['show']]);
        $this->middleware('permission:borrar-rol', ['only' => ['destroy']]);
    }

    public function index()
    {
        $roles = Role::latest()->get();

        return view('dashboard.roles.index', [
            'roles' => $roles,
        ]);
    }

    public function create()
    {
        return view('dashboard.roles.add');
    }

    public function store(Request $request)
    {
        if (Role::where('name', $request->name)->count() > 0) {
            return redirect()->back()->with('error', 'Este Rol ya está registrado!');
        } else {
            $request->validate([
                'name' => ['required', 'string', 'min:1', 'max:255'],
            ]);

            $role = Role::create([
                'name' => $request->name
            ]);
            event(new Registered($role));
            return redirect()->route('roles.index')->with('success', 'Rol Registrado Correctamente!');
        }
    }

    public function edit($id)
    {
        $role = Role::findOrFail($id);

        return view('dashboard.roles.edit', [
            'role' => $role,
        ]);
    }

    public function update(Request $request, $id)
    {
        $role = Role::findOrFail($id);
        /* $request->validate([
            'name' => ['string', 'min:1', 'max:255'],
            'surname' => ['string', 'min:1', 'max:255'],
            'username' => ['string', 'min:3', 'max:30', 'unique:users,username'],
            'email' => ['string', 'email', 'max:255', 'unique:users,email'],
        ]); */
        $role->name = $request->input('name');
        $role->save();
        return redirect()->route('roles.index')->with('update', 'Rol Actualizado Correctamente!');
    }

    public function show(Role $role)
    {
        return view('dashboard.roles.show', [
            'role' => $role,
        ]);
    }

    public function destroy($id)
    {
        $role = Role::findOrFail($id);
        $role->delete();
        return redirect()->back()->with('delete', 'Rol Eliminado Correctamente!');
    }
}
