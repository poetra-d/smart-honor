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
        Schema::create('classes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('study_program_id')
                ->nullable()
                ->constrained('study_programs')
                ->onUpdate('cascade')
                ->nullOnDelete();
            $table->foreignId('academic_year_id')
                ->nullable()
                ->constrained('academic_years')
                ->onUpdate('cascade')
                ->nullOnDelete();
            $table->string('code');
            $table->string('name');
            $table->integer('quota');
            $table->integer('is_active')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('classes');
    }
};
