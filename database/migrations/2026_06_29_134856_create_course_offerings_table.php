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
        Schema::create('course_offerings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('academic_year_id')
                ->nullable()
                ->constrained('academic_years')
                ->onUpdate('cascade')
                ->nullOnDelete();
            $table->foreignId('semester_id')
                ->nullable()
                ->constrained('semesters')
                ->onUpdate('cascade')
                ->nullOnDelete();
            $table->foreignId('lecturer_id')
                ->nullable()
                ->constrained('lecturers')
                ->onUpdate('cascade')
                ->nullOnDelete();
            $table->foreignId('course_id')
                ->nullable()
                ->constrained('courses')
                ->onUpdate('cascade')
                ->nullOnDelete();
            $table->foreignId('class_id')
                ->nullable()
                ->constrained('classes')
                ->onUpdate('cascade')
                ->nullOnDelete();
            $table->integer('quota')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('course_offerings');
    }
};
