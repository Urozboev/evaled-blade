<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Simulator extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'subject',
        'task_image',
        'student_answers',
        'criteria',
        'correct_scores',
        'duration',
        'difficulty',
        'student_count',
        'is_active',
    ];

    protected $casts = [
        'student_answers' => 'array',
        'criteria' => 'array',
        'correct_scores' => 'array',
        'is_active' => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}