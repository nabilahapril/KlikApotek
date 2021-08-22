<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenjualansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penjualans', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('nota',30)->nullable();
            $table->date('tanggal');
            $table->char('status',1);
            $table->string('qty',30);
            $table->decimal('diskon', 9, 2)->nullable();
            $table->decimal('subTotal', 9, 2)->nullable();
            $table->unsignedBigInteger('item');
            $table->foreign('item')->references('id')->on('obats')->onDelete('cascade');
            $table->unsignedBigInteger('consumer');
            $table->foreign('consumer')->references('id')->on('pasiens')->onDelete('cascade');
            $table->unsignedBigInteger('kasir');
            $table->foreign('kasir')->references('id')->on('users')->onDelete('cascade');
        
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('penjualans');
    }
}
