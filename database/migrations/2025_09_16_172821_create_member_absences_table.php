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
        Schema::create('member_absences', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('member_id');
            $table->dateTime('date');
            $table->string('reason')->nullable();
            $table->string('status')->default('present');
            $table->string('member_type')->default('academic');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('member_absences');
    }
};
