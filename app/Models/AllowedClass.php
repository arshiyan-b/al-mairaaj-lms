<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AllowedClass extends Model
{
    use HasFactory;

    protected $table = 'allowed_classes';
    public $timestamps = true;

    protected $fillable = [
        'teacher_id',
        'board',
        'grades',
        'subjects',
    ];
    public function teacher()
    {
        return $this->belongsTo(Teacher::class, 'teacher_id', 'teacher_id');
    }
}
