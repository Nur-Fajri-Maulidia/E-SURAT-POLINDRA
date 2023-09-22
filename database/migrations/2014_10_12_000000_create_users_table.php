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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('username')->nullable()->unique();
            $table->string('email')->unique();
            $table->string('nip')->nullable();
            $table->string('jenis_kelamin')->nullable();
            $table->text('alamat')->nullable();
            $table->boolean('status')->default(0);
            $table->boolean('pns')->default(0);
            $table->integer('unit_kerja_id')->nullable();
            $table->integer('jabatan_id')->nullable();
            $table->integer('pangkat_id')->nullable();
            $table->string('foto')->nullable();
            $table->string('tte_pin')->nullable();
            $table->string('password');
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
