<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Student extends Model
{
    public $timestamps = true;
    use HasFactory;
    protected $primaryKey = 'student_id';

    protected $fillable = [
        'student_id' ,
        'student_name',
        'student_dob',
        'student_cnic',
        'student_city',
        'student_phone_no',
        'student_whatsapp_no',	
        'student_email',
        'student_address',
        'user_created'
    ];
}
