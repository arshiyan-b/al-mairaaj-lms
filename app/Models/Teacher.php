<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Teacher extends Model
{
    public $timestamps = true;
    use HasFactory;
    protected $primaryKey = 'teacher_id';

    protected $fillable = [
        'teacher_id' ,
        'teacher_name',
        'teacher_cnic',
        'teacher_city',
        'teacher_phone_no',
        'teacher_whatsapp_no',	
        'teacher_email',
        'teacher_address',
        'user_created',
    ];
    public function courses()
    {
        return $this->hasMany(Course::class, 'course_teacher_id', 'teacher_id');
    }
}
