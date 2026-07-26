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
        Schema::create('honor_payment_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('payment_id')
                ->nullable()
                ->constrained('honor_payments')
                ->onUpdate('cascade')
                ->nullOnDelete();
            $table->foreignId('meeting_id')
                ->nullable()
                ->constrained('meetings')
                ->onUpdate('cascade')
                ->nullOnDelete();
            $table->foreignId('course_offering_id')
                ->nullable()
                ->constrained('course_offerings')
                ->onUpdate('cascade')
                ->nullOnDelete();
            $table->integer('sks');
            $table->float('rate');
            $table->float('subtotal');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('honor_payment_details');
    }
};
