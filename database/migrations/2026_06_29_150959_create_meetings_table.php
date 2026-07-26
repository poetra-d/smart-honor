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
        Schema::create('meetings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('schedule_id')
                ->nullable()
                ->constrained('schedules')
                ->onUpdate('cascade')
                ->nullOnDelete();
            $table->integer('meeting_number');
            $table->date('meeting_date')->nullable();
            $table->text('topic')->nullable();
            $table->text('description')->nullable();
            $table->string('status')->default('Terjadwal')->comment('1=terjadwal, 2=selesai pertemuan, 3=pertemuan sudah dibayar');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('meetings');
    }
};
