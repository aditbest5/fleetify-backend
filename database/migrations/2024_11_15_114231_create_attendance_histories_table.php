<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('attendance_histories', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('employee_id');
            $table->uuid('attendance_id');
            $table->timestamp('date_attendance')->nullable();
            $table->tinyInteger('attendance_type')->default(1);
            $table->text('description');
            $table->foreign('employee_id')->references('id')->on('employees')->onDelete('cascade'); // added onDelete for better integrity
            $table->foreign('attendance_id')->references('id')->on('attendances')->onDelete('cascade'); // added onDelete for better integrity
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendance_histories');
    }
};
