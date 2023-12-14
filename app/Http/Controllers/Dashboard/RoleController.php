<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::all();

        return view('dashboard.roles.index', [
            'roles' => $roles,
        ]);
    }
}
