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
     
        Schema::create('staff', function (Blueprint $table) {
            $table->id('staff_id');
        
            $table->string('full_name');
            $table->string('job_title');
            $table->string('role');
        
            $table->foreignId('department_id')
                ->constrained('departments', 'department_id')
                ->onDelete('cascade');
        
            $table->string('email')->unique();
            $table->string('password');
        
            $table->rememberToken();
        
            $table->timestamps();
        });
        Schema::create('visits_log', function (Blueprint $table) {
            $table->id('visit_id');
            $table->integer('visitor_id');
            $table->foreignId('staff_id')->constrained('staff', 'staff_id')->onDelete('cascade');
            
            $table->dateTime('check_in_time');
            $table->dateTime('check_out_time')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('visits_log');
        Schema::dropIfExists('staff');
    }
};
