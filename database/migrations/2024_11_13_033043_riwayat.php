<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('pasien_visit', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pasien_id')->constrained('pasien')->onDelete('cascade'); // Relasi ke pasien
            $table->foreignId('dokter_id')->constrained('dokter')->onDelete('cascade'); // Relasi ke dokter
            $table->date('tanggal_kunjungan'); // Tanggal kunjungan pasien
            $table->text('keluhan')->nullable(); // Keluhan pasien
            $table->text('diagnosis')->nullable(); // Diagnosis dokter
            $table->text('tindakan')->nullable(); // Tindakan yang diberikan, misalnya resep obat atau lainnya
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pasien_visit');
    }
};
