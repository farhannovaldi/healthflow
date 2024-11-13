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
        Schema::create('obat', function (Blueprint $table) {
            $table->id();
            $table->string('nama_obat');
            $table->string('jenis'); // Jenis obat, misalnya kapsul, tablet, cair, dll.
            $table->integer('stok')->default(0); // Stok tersedia
            $table->string('dosis'); // Dosis obat, misalnya 500mg, 10ml, dll.
            $table->decimal('harga', 8, 2); // Harga per unit
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Obat');
    }
};
