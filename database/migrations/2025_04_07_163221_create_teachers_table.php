<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('teachers', function (Blueprint $table) {
            $table->increments('teacher_id'); // AUTO_INCREMENT for Primary Key
            $table->string('teacher_name', 50);
            $table->string('teacher_cnic', 15);
            $table->string('teacher_city', 50)->nullable();
            $table->string('teacher_phone_no', 15);
            $table->string('teacher_whatsapp_no', 15)->nullable();
            $table->string('teacher_email', 60)->nullable();
            $table->string('teacher_address', 120)->nullable();
            $table->boolean('user_created')->default(false);
            $table->timestamps(); 
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('teachers');
    }
};