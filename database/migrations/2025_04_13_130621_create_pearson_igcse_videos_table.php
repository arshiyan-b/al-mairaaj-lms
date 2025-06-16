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
        Schema::create('pearson_igcse_videos', function (Blueprint $table) {
            $table->id('video_id');
            $table->string('video_title');
            $table->string('video_subject');
            $table->string('video_description');
            $table->string('video_lang');
            $table->string('video_duration');
            $table->string('video_link');
            $table->string('video_course_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pearson_igcse_videos');
    }
};
