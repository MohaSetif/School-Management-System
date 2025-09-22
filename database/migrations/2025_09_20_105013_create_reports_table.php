<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->string('school_name');
            $table->string('directorate');
            $table->string('institution');
            $table->string('municipality');
            $table->string('location');
            $table->date('date');
            $table->string('from');
            $table->string('to');
            $table->string('ref_number');
            $table->string('subject');
            $table->text('content');
            $table->string('file_path');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};
