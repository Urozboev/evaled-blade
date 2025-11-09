<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('simulators', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->string('subject');
            $table->string('task_image')->nullable();
            $table->json('student_answers');
            $table->json('criteria');
            $table->json('correct_scores');
            $table->integer('duration')->default(25);
            $table->string('difficulty')->default('medium');
            $table->integer('student_count')->default(3);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('simulators');
    }
};