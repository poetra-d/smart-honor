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
        Schema::create('honor_rates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employment_status_id')
                ->nullable()
                ->constrained('employment_statuses')
                ->onUpdate('cascade')
                ->nullOnDelete();
            $table->float('rate_per_sks');
            $table->date('effective_date');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('honor_rates');
    }
};
