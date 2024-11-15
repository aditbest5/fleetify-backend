<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //
    public function show(){
        try{
            $user = User::where('id',auth()->user()->id)->first();

            return response()->json([
                "response_code"=>"200",
                "response_message"=> "Berhasil mendapatkan data diri!",
                "data" =>$user
            ],200);
        }catch(\Throwable $th){
            return response()->json([
                "response_code"=>"500",
                "response_message"=> $th->getMessage(),
            ],500);
        }
    }
    public function update(Request $request,){
        try{
            $user = User::findOrfail(auth()->user()->id);
            if(!$user){
                return response()->json([
                    "response_code" => "404",
                    "response_message" => "User Tidak ditermukan!",
                    "data" => $user
                ], 404);
            }
            if(!$request->password){
                $user->update([
                    "email" => $request->email,
                    "name" => $request->name,
                ]);
            } else{
                if($request->password !== $request->password_confirmation){
                    return response()->json([
                        "response_code" => "400",
                        "response_message" => "Password konfirmasi tidak sama!",
                        "data" => $user
                    ], 400);
                }
                $user->update([
                    "email" => $request->email,
                    "name" => $request->name,
                    "password" => Hash::make($request->password)
                ]);
            }
            $user->save();
            return response()->json([
                "response_code" => "200",
                "response_message" => "Berhasil Update Data Diri!",
                "data" => $user
            ], 201);
            
        } catch(\Throwable $th){
            return response()->json([
                "response_code" => "500",
                "response_message" => $th->getMessage(),
            ], 500);
        }
      
    }
}
