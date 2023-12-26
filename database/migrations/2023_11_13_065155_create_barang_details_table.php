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
        Schema::create('barang_details', function (Blueprint $table) {
            $table->id();
            $table->string("uuid");
            $table->unsignedBigInteger('barang_id');
            $table->string("type");
            $table->string("nama_type");
            $table->timestamps();
            $table->foreign("barang_id")->references("id")->on("barangs");

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barang_details');
    }
};
