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
        Schema::create('mahasiswa', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()
                ->constrained('users')
                ->onUpdate('cascade')
                ->nullOnDelete();
            $table->string('nama_lengkap')->nullable();
            $table->text('alamat_ktp')->nullable();
            $table->text('alamat_domisili')->nullable();
            $table->foreignId('kabupaten_id')->nullable()
                ->constrained('kabupaten')
                ->onUpdate('cascade')
                ->nullOnDelete();
            $table->string('kecamatan')->nullable();
            $table->string('nomor_telepon')->nullable();
            $table->string('nomor_hp')->nullable();
            $table->string('email')->nullable();
            $table->enum('kewarganegaraan', ['WNI Asli', 'WNI Keturunan', ' WNA'])->nullable();
            $table->string('wna')->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->string('negara_tempat_lahir')->nullable();
            $table->string('provinsi_tempat_lahir')->nullable();
            $table->string('kota_tempat_lahir')->nullable();
            $table->enum('jenis_kelamin', ['Pria', 'Wanita'])->nullable();
            $table->enum('status_menikah', ['Belum Menikah', 'Menikah', 'Lain-lain (Janda/Duda)'])->nullable();
            $table->enum('agama', ['Islam', 'Katolik', 'Kristen', 'Hindu', 'Budha', 'Lain-lain'])->nullable();
            $table->string('foto')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mahasiswa');
    }
};
