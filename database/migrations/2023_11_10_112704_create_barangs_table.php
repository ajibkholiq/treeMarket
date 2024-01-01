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
        Schema::create('barangs', function (Blueprint $table) {
            $table->id();
            $table->string("uuid");
            $table->unsignedBigInteger('kategori_id');
            $table->string("nama");
            $table->string("gambar");
            $table->string("harga");
            $table->integer("jumlah");
            $table->string("deskripsi");
            $table->timestamps();
            
            $table->foreign("kategori_id")->references("id")->on("kategoris")->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barangs');
    }
};
