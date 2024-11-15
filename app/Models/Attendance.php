<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory, HasUuids;
    protected $primaryKey = 'id';
    protected $fillable = [
        'employee_id',
        'clock_in',
        'clock_out',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id', 'id');
    }

    public function attendance_history()
    {
        $this->hasMany(AttendanceHistory::class, 'attendance_id', 'id');
    }
}
