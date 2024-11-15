<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\AttendanceHistory;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AttendanceController extends Controller
{
    //
    public function index(){
        try{
            $attendances = Attendance::join('employees', 'attendances.employee_id', '=', 'employees.id')
            ->select('employees.*', 'attendances.*') // Pilih kolom yang diperlukan
            ->get();
            return response()->json([
                "response_code"=>"200",
                "response_message"=> "Berhasil mendapatkan data absensi karyawan!",
                "data" =>$attendances
            ],200);
        }catch(\Throwable $th){
            return response()->json([
                "response_code"=>"500",
                "response_message"=> $th->getMessage(),
            ],500);
        }
    }

    public function absent_in(Request $request){
        try{
            $request->validate([
                "clock_in" => "required",
                "date_attendance"=>"required"
            ]);
            DB::beginTransaction();
            $employee = Employee::where("user_id", auth()->user()->id)->first();

            if (!$employee) {
                return response()->json([
                    "response_code" => "404",
                    "response_message" => "Data karyawan tidak temukan",
                ], 404);
            }
            $clock_in_time = \Carbon\Carbon::parse($request->clock_in)->format('H:i:s');

            $description = $clock_in_time > $employee->department->max_clock_in_time
            ? "Terlambat"
            : "Tepat Waktu";

            $attendance = Attendance::create([
                    "employee_id" => $employee->id,
                    "clock_in" => $request->clock_in,
            ]);

            $attendance_history = AttendanceHistory::create([
                    "employee_id" => $employee->id,
                    "attendance_id"=>$attendance->id,
                    "date_attendance"=>$request->date_attendance,
                    "description"=> $description
            ]);


            DB::commit();

            return response()->json([
                "response_code" => "200",
                "response_message" => "Berhasil Absen In!",
                "data" => ["attendance"=> $attendance, "attendance_history"=> $attendance_history]
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

    public function absent_out(Request $request)
    {
        try {
            // Validasi input
            $request->validate([
                "clock_out" => "required",
                "date_attendance" => "required",
            ]);

            DB::beginTransaction();

            // Mendapatkan data karyawan berdasarkan user_id yang terautentikasi
            $employee = Employee::where("user_id", auth()->user()->id)->first();

            if (!$employee) {
                return response()->json([
                    "response_code" => "404",
                    "response_message" => "Data karyawan tidak ditemukan",
                ], 404);
            }

            // Ekstrak waktu clock_out (jam:menit:detik)
            $clock_out_time = \Carbon\Carbon::parse($request->clock_out)->format('H:i:s');

            $description = $clock_out_time < $employee->department->max_clock_out_time
                ? "Pulang Sebelum Waktunya"
                : "Tepat Waktu";

            // Cari attendance yang sesuai dengan employee_id dan tanggal clock_in yang sama dengan date_attendance
            $attendance = Attendance::where('employee_id', $employee->id)
                ->whereDate('clock_in', \Carbon\Carbon::parse($request->date_attendance)->format('Y-m-d'))  // Memastikan tanggal clock_in sesuai dengan date_attendance
                ->first(); // Ambil satu record attendance yang pertama

            if (!$attendance) {
                return response()->json([
                    "response_code" => "404",
                    "response_message" => "Data absensi tidak ditemukan",
                ], 404);
            } else if($attendance->clock_out){
                return response()->json([
                    "response_code" => "404",
                    "response_message" => "Anda sudah absent out",
                ], 404);
            }

            // Update clock_out pada attendance yang ditemukan
            $attendance->update([
                "clock_out" => $request->clock_out, // Update clock_out
            ]);

            // Membuat history absensi untuk clock_out
            $attendance_history = AttendanceHistory::create([
                "employee_id" => $employee->id,
                "attendance_id" => $attendance->id,
                "attendance_type" => 0,
                "date_attendance" => $request->date_attendance,
                "description" => $description,
            ]);

            DB::commit();

            return response()->json([
                "response_code" => "200",
                "response_message" => "Berhasil Absen Out!",
                "data" => [
                    "attendance" => $attendance,
                    "attendance_history" => $attendance_history,
                ],
            ], 201);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                "response_code" => "500",
                "response_message" => "Terjadi Kesalahan",
                "error" => $th->getMessage(),
            ], 500);
        }
    }
}
