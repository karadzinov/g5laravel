<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
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
        return view('users.create');
    }

    public function store(Request $request)
    {
        $name = $request->get('name');
        $email = $request->get('email');
        $password = Hash::make($request->get('password'));

        User::create([
            "name" => $name,
            "email" => $email,
            "password" => $password
        ]);

        return redirect()->route('users.index');

    }

    public function edit(User $user)
    {
        $data = ['user' => $user];
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

    public function destory(User $user)
    {
        $user->delete();
        return redirect()->route('users.index');
    }
}
