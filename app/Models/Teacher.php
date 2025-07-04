<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Subject;

class Teacher extends Model
{
    public $timestamps = true;
    use HasFactory;
    protected $primaryKey = 'teacher_id';

    protected $fillable = [
        'teacher_id',
        'teacher_name',
        'teacher_cnic',
        'teacher_gender',
        'teacher_city',
        'teacher_phone_no',
        'teacher_whatsapp_no',
        'teacher_email',
        'teacher_address',
        'highest_degree',
        'field_of_study',
        'university',
        'experience',
        'preferred_board',
        'subjects',
        'grades',
        'agree',
        'allowed_boards',
        'allowed_grades',
        'allowed_subjects',
        'user_created',
    ];

    public function courses()
    {
        return $this->hasMany(Course::class, 'course_teacher_id', 'teacher_id');
    }
    public function classes()
    {
        return $this->hasMany(AllowedClass::class, 'teacher_id', 'teacher_id');
    }
    public function getSubjectsListAttribute()
    {
        $subjectKeys = explode(',', $this->subjects);
        return Subject::whereIn('subject_key', $subjectKeys)->get();
    }
}
