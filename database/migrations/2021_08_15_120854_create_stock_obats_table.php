<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStockObatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock_obats', function (Blueprint $table) {
            $table->id();
            $table->string('masuk',20);
            $table->string('keluar',20);
            $table->decimal('beli', 10, 2)->nullable();
            $table->decimal('jual', 10, 2)->nullable();
            $table->date('expired');
            $table->string('stock',20);
            $table->text('keterangan', 255);
            $table->unsignedBigInteger('idObat');
            $table->foreign('idObat')->references('id')->on('obats')->onDelete('cascade');
            $table->unsignedBigInteger('admin');
            $table->foreign('admin')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stock_obats');
    }
}
