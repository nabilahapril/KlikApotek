<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePembeliansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pembelians', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('faktur',30)->nullable();
            $table->date('tanggal');
            $table->string('qty',30);
            $table->decimal('total', 9, 2)->nullable();
            $table->decimal('harga', 9, 2)->nullable();
            $table->unsignedBigInteger('supplier');
            $table->foreign('supplier')->references('id')->on('suppliers')->onDelete('cascade');
            $table->unsignedBigInteger('kodeobat');
            $table->foreign('kodeobat')->references('id')->on('obats')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pembelians');
    }
}
