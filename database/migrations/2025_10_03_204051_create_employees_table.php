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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('first_name')->required();
            $table->string('last_name')->required();
            $table->date('date_of_birth')->required();
            $table->string('place_of_birth')->required();
            $table->enum('role', ['ناظر', 'مربي متخصص', 'طباخ', 'مساعد طباخ', 'حاجب', 'حاجب ليلي', 'منظف', 'مقتصد', 'مساعد مقتصد', 'مخبري',]);
            $table->string('image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
