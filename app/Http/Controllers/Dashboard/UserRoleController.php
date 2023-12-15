<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\User;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserRoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $getRoles = Role::all();
        $getUsers = User::all();

        return view('dashboard.assign_roles.index', [
            'getUsers' => $getUsers,
            'getRoles' => $getRoles,
        ]);
    }

    public function edit($id)
    {
        $user = User::find($id);
        return view('dashboard.assign_roles.edit', [
            'user' => $user,
        ]);
    }

    public function update(Request $request, User $user)
    {
        $user->roles()->sync($request->roles);
        return redirect()->route('usersroles.index');
    }
}
