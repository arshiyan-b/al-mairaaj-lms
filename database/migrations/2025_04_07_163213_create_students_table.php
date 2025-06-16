<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('students', function (Blueprint $table) {
            $table->increments('student_id'); // AUTO_INCREMENT for Primary Key
            $table->string('student_name', 50);
            $table->date('student_dob')->nullable();
            $table->string('student_cnic', 15);
            $table->string('student_city', 50)->nullable();
            $table->string('student_phone_no', 15);
            $table->string('student_whatsapp_no', 15);
            $table->string('student_email', 60)->nullable();
            $table->string('student_address', 120)->nullable();
            $table->boolean('user_created')->default(false);
            $table->timestamps(); 
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
