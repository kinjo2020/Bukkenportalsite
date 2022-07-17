<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePicturesTable extends Migration
{
    public function up()
    {
        Schema::create('pictures', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBiginteger('bukken_id');
            $table->string('image_path');
            $table->timestamps();
        });
    }

    public function down()
    {
         Schema::dropIfExists('pictures');
    }
}
