<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory, HasUuids;
    protected $primaryKey = 'id';
    protected $fillable = [
        'name',
        'address',
        'department_id',
        'user_id'
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id', 'id');
    }

    public function attendance()
    {
        $this->hasMany(Attendance::class, 'employee_id', 'id');
    }

    public function attendance_history()
    {
        $this->hasMany(AttendanceHistory::class, 'employee_id', 'id');
    }
    
}
