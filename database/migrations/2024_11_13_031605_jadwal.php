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
        Schema::create('jadwal_dokter', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('doctor_id'); // Kolom untuk menyimpan id dokter
            $table->unsignedBigInteger('pasien_id'); // Kolom untuk menyimpan id pasien
            $table->dateTime('jadwal'); // Kolom untuk menyimpan jadwal dokter
            $table->timestamps();

            // Menambahkan foreign key untuk doctor_id yang merujuk ke tabel 'dokter'
            $table->foreign('doctor_id')->references('id')->on('dokter')->onDelete('cascade');

            // Menambahkan foreign key untuk pasien_id yang merujuk ke tabel 'pasien'
            $table->foreign('pasien_id')->references('id')->on('pasien')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwal_dokter');
    }
};
