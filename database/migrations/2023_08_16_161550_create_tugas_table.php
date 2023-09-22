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
        Schema::create('tugas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('document_id')->constrained('documents')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete()->cascadeOnUpdate();
            // $table->integer('document_id');
            // $table->integer('user_id');
            $table->text('pembuka');
            $table->text('isi');
            $table->text('penutup');
            $table->string('from');
            $table->timestamp('from_time')->nullable();
            $table->string('to');
            $table->timestamp('to_time')->nullable();
            $table->text('tempat');
            $table->timestamp('pembukaan')->nullable();
            $table->time('penutupan')->nullable();
            $table->string('biaya')->nullable();
            $table->string('alat', 50)->nullable();
            $table->text('catatan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tugas');
    }
};
