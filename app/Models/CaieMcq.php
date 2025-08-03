<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CaieMcq extends Model
{
    use HasFactory;

    protected $table = 'caie_mcqs';
    public $timestamps = true;
    protected $primaryKey = 'mcq_id';

    protected $fillable = [
        'mcq_id',
        'question',
        'option_a',
        'option_b',
        'option_c',
        'option_d',
        'correct_option',
    ];

    public function video()
    {
        return $this->hasOne(CaieOlevelVideo::class, 'mcq_id', 'mcq_id'); 
    }
}
