<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();

            $table->integer('student_identifier'); // رقم التعريف
            $table->string('last_name'); // اللقب
            $table->string('first_name'); // الاسم
            $table->enum('gender', ['male', 'female']); // الجنس
            $table->date('date_of_birth'); // تاريخ الازدياد

            // Birth & registration details
            $table->boolean('is_judicial_birth')->default(false); // مولود بحكم
            $table->string('has_birth_certificate')->default('normal'); // عقد الميلاد
            $table->year('birth_registration_year')->nullable(); // سنة التسجيل في سجل الولادات
            $table->string('birth_certificate_number')->nullable(); // رقم عقد الميلاد
            $table->string('place_of_birth')->nullable(); // مكان الازدياد

            // School details
            $table->string('academic_year')->nullable(); // السنة
            $table->foreignId('group_id')->nullable()->constrained()->onDelete('set null'); // القسم
            $table->string('schooling_system')->nullable(); // نظام التمدرس
            $table->string('enrollment_number')->nullable(); // رقم القيد
            $table->date('enrollment_date')->nullable(); // تاريخ التسجيل

            // Social status
            $table->boolean('is_orphan')->default(false); // اليتيم
            $table->boolean('is_needy')->default(false); // معوز
            $table->string('health_status')->nullable(); // الحالة الصحية
            $table->string('psychological_status')->nullable(); // الحالة النفسية
            $table->boolean('is_sector_child')->default(false); // أبناء القطاع

            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
