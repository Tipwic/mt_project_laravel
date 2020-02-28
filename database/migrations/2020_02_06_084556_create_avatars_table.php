<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAvatarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('avatars', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id');
            $table->bigInteger('grade_id')->nullable(); 
            $table->bigInteger('guild_id')->nullable();   
            $table->bigInteger('game_id')->nullable();    
            $table->string('name');
            $table->string('portrait_url')->nullable(); 
            $table->string('nick_name')->nullable();      
            $table->bigInteger('biography')->nullable();
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
        Schema::dropIfExists('avatars');
    }
}
