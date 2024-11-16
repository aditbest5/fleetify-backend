<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Attendance;
use App\Models\AttendanceHistory;

class AttendanceHistoryController extends Controller
{
    //
    public function index(){
        try{
            $attendances = AttendanceHistory::join('attendances', 'attendance_histories.attendance_id', '=', 'attendances.id')
            ->join('employees', 'attendance_histories.employee_id', '=', 'employees.id')
            ->select('employees.*', 'attendances.*', 'attendance_histories.*') // Pilih kolom yang diperlukan
            ->get();
            return response()->json([
                "response_code"=>"200",
                "response_message"=> "Berhasil mendapatkan data history absensi!",
                "data" =>$attendances
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
            $attendances = AttendanceHistory::join('attendances', 'attendance_histories.attendance_id', '=', 'attendances.id')
            ->join('employees', 'attendance_histories.employee_id', '=', 'employees.id')
            ->where('attendances.id', $id)
            ->select('employees.*', 'attendances.*', 'attendance_histories.*') // Pilih kolom yang diperlukan
            ->get();
            return response()->json([
                "response_code"=>"200",
                "response_message"=> "Berhasil mendapatkan data history absensi!",
                "data" =>$attendances
            ],200);
        }catch(\Throwable $th){
            return response()->json([
                "response_code"=>"500",
                "response_message"=> $th->getMessage(),
            ],500);
        }
    }
}
