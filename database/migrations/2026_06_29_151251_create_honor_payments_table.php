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
        Schema::create('honor_payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lecturer_id')
                ->nullable()
                ->constrained('lecturers')
                ->onUpdate('cascade')
                ->nullOnDelete();
            $table->string('month');
            $table->string('year');
            $table->float('total');
            $table->string('status')->comment('1=Draft, 2=Paid');
            $table->bigInteger('generated_by');
            $table->timestamp('generated_at');
            $table->timestamp('paid_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('honor_payments');
    }
};
