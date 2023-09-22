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
        Schema::create('tujuan', function (Blueprint $table) {
            $table->id();
            // $table->foreignId('tugas_id')->constrained('tugas')->cascadeOnDelete()->cascadeOnUpdate();
            $table->integer('tugas_id');
            $table->string('from')->nullable();
            $table->timestamp('from_time')->nullable();
            $table->string('to')->nullable();
            $table->timestamp('to_time')->nullable();
            $table->timestamps();
            // $table->foreign('tugas_id')->references('id')->on('tugas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tujuan');
    }
};
