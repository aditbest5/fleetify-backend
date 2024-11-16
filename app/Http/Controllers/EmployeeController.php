<?php

namespace App\Http\Controllers;


use App\Models\Employee;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class EmployeeController extends Controller
{
    //
    public function index(){
        try{
            $employees = Employee::join('users', 'employees.user_id', '=', 'users.id')
            ->join('departments', 'employees.department_id', '=', 'departments.id')
            ->select('employees.*', 'departments.department_name', 'employees.id as employee_id','users.id as id', 'users.email') // Pilih kolom yang diperlukan
            ->get();
            return response()->json([
                "response_code"=>"200",
                "response_message"=> "Berhasil mendapatkan data karyawan!",
                "data" =>$employees
            ],200);
        }catch(\Throwable $th){
            return response()->json([
                "response_code"=>"500",
                "response_message"=> $th->getMessage(),
            ],500);
        }
    }
    public function show($id){
        try{
            $employee = Employee::join('users', 'employees.user_id', '=', 'users.id')
            ->where('users.id', $id)
            ->select('employees.*', 'users.email') // Pilih kolom yang diperlukan
            ->first();;

            return response()->json([
                "response_code"=>"200",
                "response_message"=> "Berhasil mendapatkan data karyawan!",
                "data" =>$employee
            ],200);
        }catch(\Throwable $th){
            return response()->json([
                "response_code"=>"500",
                "response_message"=> $th->getMessage(),
            ],500);
        }
    }
    public function store(Request $request){
        try{
            $request->validate([
                "email" => "required|unique:users,email|email",
                "name" => "required",
                "address"=>"required",
            ]);
            DB::beginTransaction();
            $password = "default";
            $user = User::create([
                "email" => $request->email,
                "name" => $request->name,
                "password" => Hash::make($password)
            ]);

            $employee = Employee::create([
                "address" => $request->address,
                "name" => $request->name,
                'user_id' => $user->id,
                "department_id" => $request->department_id
            ]);
            DB::commit();

            return response()->json([
                "response_code" => "200",
                "response_message" => "Berhasil Mendaftarkan Karyawan!",
                "data" => ["user"=> $user, "employee"=> $employee]
            ], 201);

        } catch(\Throwable $th){
            DB::rollBack();
            return response()->json([
                "response_code" => "500",
                "response_message" => "Terjadi Kesalahan",
                "error" => $th->getMessage(),
            ], 500);
        }
    }
    public function update(Request $request,$id){
        try{
            DB::beginTransaction();

            $user = User::findOrfail($id);
            if(!$user){
                return response()->json([
                    "response_code" => "404",
                    "response_message" => "User Tidak ditermukan!",
                    "data" => $user
                ], 404);
            }
            $user->update([
                "email" => $request->email,
                "name" => $request->name,
            ]);

            $employee = Employee::where('user_id', $user->id)->update([
                "address" => $request->address,
                "name" => $request->name,
                'user_id' => $user->id,
                "department_id" => $request->department_id
            ]);

            DB::commit();

            return response()->json([
                "response_code" => "200",
                "response_message" => "Berhasil Update User!",
                "data" => $user
            ], 201);
            
        } catch(\Throwable $th){
            DB::rollBack();
            return response()->json([
                "response_code" => "500",
                "response_message" => $th->getMessage(),
            ], 500);
        }
      
    }
    public function destroy($id){
        try{
            User::destroy($id);
            return response()->json([
                'response_code' => "200",
                'response_message' => 'Berhasil delete id:' . ' ' . $id
            ]);
        } catch(\Throwable $th){
            return response()->json([
                "response_code" => "500",
                "response_message" => $th->getMessage(),
            ], 500);
        }
      
    }
}
