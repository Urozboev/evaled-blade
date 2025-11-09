<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exercise extends Model
{
    use HasFactory;

    protected $fillable = [
        'lesson_id',
        'title',
        'instruction',
        'task_type',
        'content',
        'answer',
        'file',
        'duration',
        'difficulty',
        'max_score',
        'is_active',
    ];

    protected $casts = [
        'content' => 'array',
        'answer' => 'array',
        'is_active' => 'boolean',
    ];

    public function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}