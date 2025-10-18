<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('school_settings', function (Blueprint $table) {
            $table->id();
            $table->string('school_name');
            $table->enum('school_type', ['ابتدائية', 'متوسطة', 'ثانوية', 'تكوين مهني']);

            $table->foreignId('director_id')
                  ->constrained('users')
                  ->cascadeOnDelete()
                  ->default(1);

            $table->string('province');
            $table->string('district');
            $table->string('municipality');
            $table->string('location');

            $table->string('identification_number')->unique();
            $table->date('date_established')->nullable();
            $table->string('date_established_number')->nullable();

            $table->enum('school_type2', ['خاصة', 'عامة'])->required();
            $table->integer('working_days')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('school_settings');
    }
};
