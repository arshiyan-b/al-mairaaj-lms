<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PearsonIgcseVideo extends Model
{
    use HasFactory;

    protected $table = 'pearson_igcse_videos';
    public $timestamps = true;
    protected $primaryKey = 'video_id';

    protected $fillable = [
        'video_id',
        'video_title',
        'video_subject',
        'video_description',
        'video_lang',
        'video_duration',
        'video_link',
        'video_course_id',
    ];

    public function course()
    {
        return $this->belongsTo(PearsonCourse::class, 'video_course_id'); 
    }
}
