<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Book extends Model
{
    public $timestamps = true;
    use HasFactory;
    protected $primaryKey = 'book_id';

    protected $fillable = [
        'book_id' ,
        'drive_id',
        'book_name',
        'category',
        'board',
        'grade',
        'subject_id',
    ];
}
