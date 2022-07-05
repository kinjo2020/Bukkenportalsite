<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistoriesTable extends Migration
{

    public function up()
    {
        Schema::create('histories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBiginteger('user_id');
            $table->unsignedBiginteger('bukken_id');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
            
            // 外部キー制約
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('bukken_id')->references('id')->on('bukkens')->onDelete('cascade');
            
            // user_idとbukken_idの組み合わせを重複を許さない
            $table->unique(['user_id', 'bukken_id']);
        });
    }


    public function down()
    {
        Schema::dropIfExists('histories');
    }
}
