<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::latest()->get();

        return view('dashboard.users.index', [
            'users' => $users,
        ]);
    }

    public function create()
    {
        return view('dashboard.users.add');
    }

    public function store(Request $request)
    {
        if (User::where('email', $request->email)->count() > 0 || User::where('username', $request->username)->count() > 0) {
            return redirect()->back()->with('error', 'Este usuario ya está registrado!');
        } else {
            $request->validate([
                'name' => ['required', 'string', 'min:1', 'max:255'],
                'surname' => ['required', 'string', 'min:1', 'max:255'],
                'username' => ['required', 'string', 'min:3', 'max:30'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
            ]);

            $user = User::create([
                'name' => $request->name,
                'surname' => $request->surname,
                'username' => $request->username,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            event(new Registered($user));
            return redirect()->route('users.index')->with('success', 'Usuario Registrado Correctamente!');
        }
    }

    public function show(User $user)
    {
        return view('dashboard.users.show', [
            'user' => $user,
        ]);
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);

        return view('dashboard.users.edit', [
            'user' => $user,
        ]);
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        /* $request->validate([
            'name' => ['string', 'min:1', 'max:255'],
            'surname' => ['string', 'min:1', 'max:255'],
            'username' => ['string', 'min:3', 'max:30', 'unique:users,username'],
            'email' => ['string', 'email', 'max:255', 'unique:users,email'],
        ]); */
        $user->name = $request->input('name');
        $user->surname = $request->input('surname');
        $user->username = $request->input('username');
        $user->email = $request->input('email');
        $user->save();
        return redirect()->route('users.index')->with('update', 'Usuario Actualizado Correctamente!');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->back()->with('delete', 'Usuario Eliminado Correctamente!');
    }
}
