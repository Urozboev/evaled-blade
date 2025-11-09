<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCertificateFieldsToUsersTable extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->json('certificate_data')->nullable();
            $table->timestamp('certificate_issued_at')->nullable();
            $table->integer('quiz_score')->default(0);
            $table->integer('exercise_score')->default(0);
            $table->integer('simulator_score')->default(0);
            $table->integer('overall_progress')->default(0);
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['certificate_data', 'certificate_issued_at', 'quiz_score', 'exercise_score', 'simulator_score', 'overall_progress']);
        });
    }
}