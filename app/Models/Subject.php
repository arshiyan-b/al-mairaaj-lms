<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Subject extends Model
{
    public $timestamps = true;
    use HasFactory;
    protected $primaryKey = 'subject_id';

    protected $fillable = [
        'subject_key',
        'subject_name',
    ];
    public function courses()
    {
        return $this->hasMany(PearsonCourse::class, 'course_subject', 'subject_key');
    }
}
