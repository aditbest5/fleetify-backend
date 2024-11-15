<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DepartmentController extends Controller
{
    //

    public function index(){
        try{
            $departments = Department::all();

            return response()->json([
                "response_code"=>"200",
                "response_message"=> "Berhasil mendapatkan data departemen!",
                "data" =>$departments
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
            $department = Department::where('id', $id)->first();

            return response()->json([
                "response_code"=>"200",
                "response_message"=> "Berhasil mendapatkan data departemen!",
                "data" =>$department
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
                "department_name" => "required|string|max:255",
                "max_clock_in_time" => "required|date_format:H:i",
                "max_clock_out_time"=> "required|date_format:H:i",
            ]);

            DB::beginTransaction();

            $department = Department::create([
                "department_name" => $request->department_name,
                "max_clock_in_time" => $request->max_clock_in_time,
                "max_clock_out_time" => $request->max_clock_out_time
            ]);

            DB::commit();

            return response()->json([
                "response_code" => "200",
                "response_message" => "Berhasil Mendaftarkan Department!",
                "data" => $department
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

            $department = Department::findOrfail($id);
            if(!$department){
                return response()->json([
                    "response_code" => "404",
                    "response_message" => "User Tidak ditermukan!",
                    "data" => $department
                ], 404);
            }
            $department->update([
                "department_name" => $request->department_name,
                "max_clock_in_time" => $request->max_clock_in_time,
                "max_clock_out_time" => $request->max_clock_out_time
            ]);


            DB::commit();

            return response()->json([
                "response_code" => "200",
                "response_message" => "Berhasil Update Department!",
                "data" => $department
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
            Department::destroy($id);
            return response()->json([
                'response_code' => "00",
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
