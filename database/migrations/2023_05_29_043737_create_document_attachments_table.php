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
        Schema::create('document_attachments', function (Blueprint $table) {
            $table->id();
            $table->integer('document_id');
            $table->string('file');
            $table->timestamps();

            // $table->id();
            // $table->integer('document_id')->constrained('documents')->cascadeOnDelete()->cascadeOnUpdate();
            // $table->string('file');
            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('document_attachments');
    }
};
