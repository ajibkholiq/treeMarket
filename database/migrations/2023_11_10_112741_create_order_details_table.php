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
        Schema::create('order_details', function (Blueprint $table) {
            $table->id();
            // $table->string('uuid');
            $table->unsignedBigInteger('order_id');
            $table->string("nama");
            $table->string("gambar");
            $table->string("harga");
            // $table->string("keterangan");
            $table->integer("jumlah");
            $table->timestamps();

            $table->foreign("order_id")->references("id")->on("orders")->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_details');
    }
};
