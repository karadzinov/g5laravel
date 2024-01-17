<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $users = User::all();
        $data = ["users" => $users];

        return view('users.index')->with($data);
    }

    public function show(User $user)
    {
        $data = ["user" => $user];

        return view('users.show')->with($data);
    }

    public function create()
    {
        $roles = Role::all();

        $data = ['roles' => $roles];
        return view('users.create')->with($data);
    }

    public function store(Request $request)
    {
        $name = $request->get('name');
        $email = $request->get('email');
        $role_id = $request->get('role_id');
        $password = Hash::make($request->get('password'));

        User::create([
            "name" => $name,
            "email" => $email,
            "password" => $password,
            "role_id" => $role_id
        ]);

        return redirect()->route('users.index');

    }

    public function edit(User $user)
    {
        $roles = Role::all();
        $data = ['user' => $user, 'roles' => $roles];
        return view('users.edit')->with($data);
    }

    public function update(Request $request, User $user)
    {

        $input = $request->all();

        if ($request->has('password') && !empty($request->get('password'))) {
            $input['password'] = $request->get('password');
        } else {
            $input = $request->except('password');
        }

        $user->fill($input)->save();

        return redirect()->route('users.index');
    }

    public function destroy(User $user)
    {

        if(auth()->user()->id === $user->id)
        {
            return redirect()->route('users.index');
        }
        $user->delete();
        return redirect()->route('users.index');
    }
}
