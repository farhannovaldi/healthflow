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
            $table->string('hari'); // Kolom untuk menyimpan hari (misalnya 'Senin', 'Selasa', dst)
            $table->time('jam_mulai'); // Kolom untuk menyimpan jam mulai praktek
            $table->time('jam_selesai'); // Kolom untuk menyimpan jam selesai praktek
            $table->timestamps();

            // Menambahkan foreign key untuk doctor_id yang merujuk ke tabel 'dokter'
            $table->foreign('doctor_id')->references('id')->on('dokter')->onDelete('cascade');
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
