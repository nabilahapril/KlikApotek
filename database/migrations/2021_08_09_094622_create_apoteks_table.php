<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApoteksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apoteks', function (Blueprint $table) {
            $table->id();
            $table->string('nama',30);
            $table->string('telp',12);
            $table->text('logo',12)->nullable();
            $table->decimal('balance', 9, 2)->nullable();
            $table->string('direktur',12);
            $table->string('emailapotek',30);
            $table->string('rekening',30);
            $table->string('alamat',150);
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
        Schema::dropIfExists('apoteks');
    }
}
