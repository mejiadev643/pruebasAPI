<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Employee;
use Illuminate\Support\Facades\hash;
use Illuminate\Support\Facades\Auth;

class ApiController extends Controller
{
    //

   public function hola(Request $request)
    {
        $users= User::all();
        $employe = Employee::all();
        return response()->json($employe,200);

    }

    public function login(Request $request){

        $response = ["status"=>0,"msg"=>""];
        //dd( $request);
        //$data = json_decode($request->getContent());//admin
        $data = ['email'=>$request['email'],'password'=>$request['password']];
        $user = User::where('email',$data['email'])->first();//admin@admin.com

        if($user){

            if(Hash::check($data['password'],$user->password)){//revisa los hashes segun el nombre de los arrays

                //$token = $user->createToken("example");
                Auth::attempt($data);
                Auth::user();

                $response["status"] = 1;
                $response["msg"] = 'ini';//$token->plainTextToken;


            }else{
                $response["msg"] = "No existen un token registrado a este usuario.";
            }

        }else{
            $response["msg"] = "Usuario no encontrado.";
        }

        return response()->json($response);
    }


    public function login1(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $token = $user->createToken('token-name')->plainTextToken;

            return response()->json(['token' => $token]);
        }

        return response()->json(['message' => 'Unauthorized'], 401);
    }
    public function logon(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $user = User::where('email', $request->email)->first();
            $token = $user->createToken('token-name')->plainTextToken;
            return response()->json(['token' => $token], 200);
        } else {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }
    }

    public function setEmployee(Request $request){
        //
        $data = $request->only('nombre','apellido');
        $response = Employee::create($data);

        return response()->json([$response->id,'sucess'],200);
    }

    public function getIdEmployee(Request $request, $id){
        $employe = Employee::find($id);

        return response()->json($employe,200);
    }
    public function setIdEmployee(Request $request, $id){
        $data = $request->only('nombre','apellido');
        $employe = Employee::find($id);
        $employe->update($data);
        return response()->json('ok',200);
    }




}
