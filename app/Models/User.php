<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    protected $fillable = [
        'session_id',
        'email',
        'full_name',
        'progress',
        'total_score',
        'email_verified_at',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function progress()
    {
        return $this->hasMany(UserProgress::class);
    }

    public function quizAttempts()
    {
        return $this->hasMany(QuizAttempt::class);
    }

    public function getOverallProgressAttribute()
    {
        $totalLessons = Lesson::where('is_active', true)->count();
        $completedLessons = $this->progress()->where('completed', true)->count();
        
        return $totalLessons > 0 ? round(($completedLessons / $totalLessons) * 100) : 0;
    }
}