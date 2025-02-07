<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Controllers\StudentController;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Laravel\Sanctum\HasApiTokens;


class UserController extends Controller
{


    public function register (Request $request){

        $validator =  Validator::make($request->all(),[
            'nameUser'=>'required',
            'email'=>'required|email|unique:users',
            'password'=>'required|confirmed'
        ]);


        if ($validator->fails()) {
            return response()->json([
                "error" => "Error en registrar",
                "errores" => $validator->errors()
            ], 400);
        }


        $user =   User::create([
            'nameUser' => $request->nameUser,
            'email' => $request->email,
            'password' => bcrypt($request->password), // Encriptar la contraseña
        ]
    );
 
        return response($user , Response::HTTP_CREATED) ;


    }


    public function login(Request $request) {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                "error" => "Error en logear",
                "errores" => $validator->errors()
            ], 400);
        }
    
        if (Auth::attempt($request->only('email', 'password'))) {
            $user = Auth::user();
            $token = $user->createToken('token')->plainTextToken; // Genera el token
            $cookie = cookie('cookie_token', $token, 60 * 12); // Establece el cookie
            return response(["token" => $token], Response::HTTP_OK)->withCookie($cookie);
        }
    
        return response(["error" => "Credenciales no coinciden"], Response::HTTP_UNAUTHORIZED);
    }
    

    public function getAllStudents(Request $request){
        return response()->json(["data"=>"jala"] , Response::HTTP_OK);
    }
}
