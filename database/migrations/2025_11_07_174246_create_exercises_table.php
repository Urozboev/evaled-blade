<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('exercises', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lesson_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->text('instruction');
            $table->enum('task_type', ['rubric', 'feedback', 'match', 'text']);
            $table->json('content')->nullable();
            $table->json('answer')->nullable();
            $table->string('file')->nullable();
            $table->integer('duration')->default(20);
            $table->string('difficulty')->default('medium');
            $table->integer('max_score')->default(10);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('exercises');
    }
};