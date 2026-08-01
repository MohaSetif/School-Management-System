<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('curriculum_tables', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->string('grade_level');
            $table->date('start_date');
            $table->date('end_date');
            $table->string('month');
            $table->json('subjects');
            $table->timestamps();
            $table->index(['user_id', 'grade_level']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('curriculum_tables');
    }
};