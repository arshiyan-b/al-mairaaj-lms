<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CaieOlevelVideo extends Model
{
    use HasFactory;

    protected $table = 'caie_olevel_videos';
    public $timestamps = true;
    protected $primaryKey = 'video_id';

    protected $fillable = [
        'video_id',
        'video_order',
        'video_title',
        'video_subject',
        'video_description',
        'video_price',
        'video_lang',
        'video_duration',
        'video_link',
        'video_course_id',
        'mcq_id',
        'minutes',
        'seconds'
    ];

    public function course()
    {
        return $this->belongsTo(CaieCourse::class, 'video_course_id'); 
    }
    public function mcq()
    {
        return $this->belongsTo(CaieMcq::class, 'mcq_id', 'mcq_id'); 
    }
}
