<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\Role;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;



class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * @OA\Get(
     *      path="/api/user",
     *      operationId="user",
     *      tags={"Users"},
     *      summary="Get user information",
     *      description="Returns auth user data",
     *      @OA\Response(
     *          response=200,
     *          description="successful operation"
     *       ),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     *      security={
     *         {
     *             "passport": {},
     *         }
     *     },
     * )
     */
    public function index()
    {
        $users = User::all();
        $data = ["users" => $users];

        return view('users.index')->with($data);
    }
    /**
     * @OA\Get(
     *      path="/api/users",
     *      operationId="getAllUsers",
     *      tags={"Users"},
     *      summary="Get users information",
     *      description="Returns users data",
     *      @OA\Response(
     *          response=200,
     *          description="successful operation"
     *       ),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     *      security={
     *         {
     *             "passport": {},
     *         }
     *     },
     * )
     */

    public function all()
    {
        $users = User::all();
        $users = UserResource::collection($users);
        $data = ['users' => $users];
        return response()->json($data, 200);
    }

    /**
     * @OA\Get(
     *      path="/api/users/{id}",
     *      operationId="showUser",
     *      tags={"Users"},
     *      summary="Show User",
     *      description="Returns user's data",
     *     @OA\Parameter(
     *          name="id",
     *          description="User id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="successful operation"
     *       ),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     *      security={
     *         {
     *             "passport": {},
     *         }
     *     },
     * )
     */

    public function edit($id)
    {
        $user = User::where('id', '=', $id)->first();

        $user = UserResource::make($user);
        $data = ['user' => $user];
        return response()->json($data, 200);
    }


    /**
     * @OA\Put(
     *      path="/api/users/{id}",
     *      operationId="updateUser",
     *      tags={"Users"},
     *      summary="Update User",
     *      description="Returns user's data",
     *     @OA\Parameter(
     *          name="id",
     *          description="User id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                 allOf={
     *
     *                     @OA\Schema(
     *                         @OA\Property(
     *                             description="User image",
     *                             property="image",
     *                             type="string", format="binary"
     *                         )
     *                     )
     *                 }
     *             )
     *         )
     *     ),
     *      @OA\Parameter(
     *          name="Name",
     *          description="Name",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="email",
     *          description="Email",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="password",
     *          description="Password",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="role_id",
     *          description="Role",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="country_id",
     *          description="Country",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="successful operation"
     *       ),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     *      security={
     *         {
     *             "passport": {},
     *         }
     *     },
     * )
     */

    public function update(Request $request, $id)
    {
        $user = User::where('id', '=', $id)->first();

        $user->fill($request->all())->save();
        $user = UserResource::make($user);
        $data = ['user' => $user];
        return response()->json($data, 200);

    }

    /**
     * @OA\Post(
     *      path="/api/users",
     *      operationId="storeUser",
     *      tags={"Users"},
     *      summary="Save User",
     *      description="Returns users data",
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                 allOf={
     *
     *                     @OA\Schema(
     *                         @OA\Property(
     *                             description="User image",
     *                             property="image",
     *                             type="string", format="binary"
     *                         )
     *                     )
     *                 }
     *             )
     *         )
     *     ),
     *      @OA\Parameter(
     *          name="name",
     *          description="Name",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="email",
     *          description="Email",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="password",
     *          description="Password",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="role_id",
     *          description="Role",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="successful operation"
     *       ),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     *      security={
     *         {
     *             "passport": {},
     *         }
     *     },
     * )
     */


    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'email' => 'required|unique:users',
            'password' => 'required',
            'country_id' => 'required',
            'role_id' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }

        $name = $request->get('name');
        $email = $request->get('email');
        $password = bcrypt($request->get('password'));
        $country_id = $request->get('country_id');
        $role_id = $request->get('role_id');


        $user = User::create([
            "name" => $name,
            "email" => $email,
            "password" => $password,
            "country_id" => $country_id,
            "role_id" => $role_id
        ]);

        $user = UserResource::make($user);
        $data = ['user' => $user];
        return response()->json($data, 200);
    }

    /**
     * @OA\Delete (
     *      path="/api/users/{id}",
     *      operationId="deleteUser",
     *      tags={"Users"},
     *      summary="Delete User",
     *      description="Returns success",
     *     @OA\Parameter(
     *          name="id",
     *          description="User id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="successful operation"
     *       ),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     *      security={
     *         {
     *             "passport": {},
     *         }
     *     },
     * )
     */


    public function destroy($id)
    {
        $user = User::FindOrFail($id);
        $user->delete();
        $data = ['success' => 'success'];
        return response()->json($data, 200);

    }
}
