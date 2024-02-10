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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string("uuid");
            $table->string("no_trans");
            $table->unsignedBigInteger('costumer_id');
            $table->date("tgl");
            $table->string("status");
            $table->string("type");
            $table->string("total");
            $table->string("note")->nullable();
            $table->timestamps();

            $table->foreign("costumer_id")->references("id")->on("costumers")->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
