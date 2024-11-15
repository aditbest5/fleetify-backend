<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory, HasUuids;
    protected $primaryKey = 'id';
    protected $fillable = [
        'department_name',
        'max_clock_in_time',
        'max_clock_out_time',
    ];

    public function employee()
    {
        $this->hasMany(Employee::class, 'department_id', 'id');
    }
}
