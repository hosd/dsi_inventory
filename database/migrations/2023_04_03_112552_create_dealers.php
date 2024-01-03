<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dealers', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('name','255');
            $table->string('email','255');
            $table->string('phone','255');
            $table->integer('addressID')->unsigned();
            $table->char('status','10');
            $table->string('Contact_person','255');
            $table->string('opening_hours','255');
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
        Schema::dropIfExists('dealers');
    }
};
