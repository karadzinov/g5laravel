<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\Role;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();

        $users = UserResource::collection($users);

        $data = ['users' => $users];
        return response()->json($data, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = User::create([
            "name" => $request->get('name'),
            "email" => $request->get('email'),
            "password" => Hash::make($request->get('password')),
            "role_id" => $request->get('role_id')
        ]);

        $user = UserResource::make($user);
        $data = ['user' => $user];

        return response()->json($data, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::FindOrFail($id);
        $user = UserResource::make($user);
        $data = ['user' => $user];

        return response()->json($data, 200);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::FindOrFail($id);

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        $user->fill($input)->save();

        $user = UserResource::make($user);
        $data = ['user' => $user];

        return response()->json($data, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::FindOrFail($id);

        $user->delete();
        $user = UserResource::make($user);
        $data = ['user' => $user];

        return response()->json($data, 200);
    }
}
