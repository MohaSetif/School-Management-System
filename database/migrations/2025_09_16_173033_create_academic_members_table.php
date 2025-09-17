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
        Schema::create('academic_members', function (Blueprint $table) {
            $table->id();
            $table->string('postal_account_number')->nullable(); // الرقم الحساب البريدي للموظف
            $table->string('last_name')->nullable(); // اللقب
            $table->string('first_name')->nullable(); // الاسم
            $table->string('rank')->nullable(); // الرتبة

            // مرجع مقرر التعيين أو التسمية أو الإدماج
            $table->string('appointment_reference_number')->nullable();
            $table->date('appointment_reference_date')->nullable();

            $table->date('appointment_date')->nullable(); // تاريخ التنصيب

            // مرجع مقرر الترسيم أو التثبيت
            $table->string('confirmation_reference_number')->nullable();
            $table->date('confirmation_reference_date')->nullable();

            // مرجع مقرر الترقية والترسيم في الرتبة الحالية
            $table->string('promotion_reference_number')->nullable();
            $table->date('promotion_reference_date')->nullable();

            $table->date('promotion_start_date')->nullable(); // تاريخ التنصيب في الرتبة الحالية

            $table->string('subject')->nullable(); // المادة بالنسبة للأساتذة
            $table->string('grade')->nullable(); // الدرجة
            $table->date('effective_date')->nullable(); // تاريخ السريان

            $table->string('postal_account')->nullable(); // الحساب البريدي
            $table->string('phone')->nullable(); // الهاتف
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('academic_members');
    }
};
