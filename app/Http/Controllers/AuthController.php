<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Validator;

class AuthController extends Controller {


    public function __construct() {
        $this->middleware('auth:api', ['except' => ['login', 'register', 'unauthorized']]);
    }

    public function login(Request $request) {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',
            'password' => 'required|string',
        ]);

        if($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        if(!$token = Auth::attempt($validator->validated())) {
            return $this->unauthorized();
        }

        return $this->createNewToken($token);
    }

    public function register(Request $request) {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:users,email',
            'user_type_id' => 'required|exists:user_types,id',
            'password' => 'required|string',
        ]);

        if($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $user = User::create(array_merge(
                    $validator->validated(),
                    ['password' => bcrypt($request->password)]
                ));

        return response()->json([
            'success' => "User successfully registered",
            'user' => $user,
        ], 201);
    }

    public function logout() {
        Auth::logout();
        return response()->json(['success' => "Successfully logged out"]);
    }

    public function delete(Request $request) {
        if(Auth::user()->userType->name == "Staff") {
            $validator = Validator::make($request->all(), [
                'user_id' => 'required|integer|exists:users,id',
            ]);

            if($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }
            $user = User::find($request->user_id);
            $user->delete();
            return response()->json(['user' => $user]);
        }
        return $this->unauthorized();
    }

    public function getUserList() {
        if(Auth::user()->userType->name == "Staff") {
            return response()->json(['users' => User::withTrashed()->get()]);
        }
        return $this->unauthorized();
    }

    protected function createNewToken($token){
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
            'user' => auth()->user()
        ]);
    }
}
