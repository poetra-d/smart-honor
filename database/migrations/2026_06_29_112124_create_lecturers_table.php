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
        Schema::create('lecturers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')
                ->nullable()
                ->constrained('employees')
                ->onUpdate('cascade')
                ->nullOnDelete();
            $table->foreignId('employment_status_id')
                ->nullable()
                ->constrained('employment_statuses')
                ->onUpdate('cascade')
                ->nullOnDelete();
            $table->foreignId('study_program_id')
                ->nullable()
                ->constrained('study_programs')
                ->onUpdate('cascade')
                ->nullOnDelete();
            $table->string('nidn');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lecturers');
    }
};
