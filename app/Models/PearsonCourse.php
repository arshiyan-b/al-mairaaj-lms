<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PearsonCourse extends Model
{
    use HasFactory;

    protected $table = 'pearson_courses';
    public $timestamps = true;
    protected $primaryKey = 'course_id';

    protected $fillable = [
        'course_id',
        'course_title',
        'course_description',
        'course_subject',
        'course_paper',
        'course_qualification',
        'course_teacher_id',
    ];
    public function teacher()
    {
        return $this->belongsTo(Teacher::class, 'course_teacher_id', 'teacher_id');
    }
    public function subject()
    {
        return $this->belongsTo(Subject::class, 'course_subject', 'subject_key');
    }
    public function videos()
    {
        return $this->hasMany(PearsonIgcseVideo::class, 'video_course_id'); 
    }
}
