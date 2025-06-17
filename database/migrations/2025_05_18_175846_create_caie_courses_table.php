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
        Schema::create('caie_courses', function (Blueprint $table) {
            $table->increments('course_id');
            $table->string('course_title', 45);
            $table->string('course_description', 255);
            $table->string('course_subject', 20);
            $table->string('course_qualification', 20);
            $table->integer('course_teacher_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('caie_courses');
    }
};
