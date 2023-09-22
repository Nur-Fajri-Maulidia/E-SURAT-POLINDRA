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
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->integer('category_id');
            $table->integer('from_user_id');
            $table->integer('to_unit_kerja_id')->nullable();
            $table->integer('to_user_id')->nullable();
            $table->integer('to_tembusan_user_id')->nullable();
            $table->string('hal');
            $table->text('deskripsi');
            $table->text('keterangan');
            $table->longText('body')->nullable();
            $table->string('no_surat');
            $table->foreignId('tte_created_user_id')->nullable()->constrained('users');
            $table->timestamp('tte_created')->nullable();
            $table->string('tte_file')->nullable();
            $table->char('uuid', 36);
            $table->string('qrcode')->nullable();
            $table->longText('visum_umum')->nullable();
            $table->foreignId('tte_visum_umum_created_user_id')->nullable()->constrained('users');
            $table->dateTime('tte_visum_umum_created')->nullable();
            $table->string('visum_umum_qrcode')->nullable();
            $table->string('tte_visum_umum_file')->nullable();
            $table->longText('spd')->nullable();
            $table->foreignId('tte_spd_created_user_id')->nullable()->constrained('users');
            $table->dateTime('tte_spd_created')->nullable();
            $table->string('spd_qrcode')->nullable();
            $table->string('tte_spd_file')->nullable();
            $table->timestamps();
            // $table->id();
            // $table->foreignId('category_id')->nullable()->constrained('categories');
            // $table->foreignId('from_user_id')->nullable()->constrained('users');
            // $table->foreignId('to_unit_kerja_id')->nullable()->constrained('unit_kerjas');
            // $table->foreignId('to_tembusan_unit_kerja_id')->nullable()->constrained('unit_kerjas');
            // $table->string('kode_hal');
            // $table->string('hal');
            // $table->text('deskripsi');
            // $table->text('keterangan');
            // $table->text('body');
            // $table->timestamp('read_at')->nullable();
            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documents');
    }
};
