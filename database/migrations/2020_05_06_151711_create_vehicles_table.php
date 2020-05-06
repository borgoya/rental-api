<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVehiclesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('reg_no');
            $table->string('vehicle_type', 255);
            $table->string('model');
            $table->string('brand');
            $table->string('fuel_type');
            $table->string('rent_price');
            $table->string('mfd');
            $table->string('booking_status');
            $table->longText('description');
            $table->longText('img_link');
            $table->integer('owner_id')->unsigned(); // owner id is a foreign key
            $table->foreign('owner_id')
                    ->references('id')->on('users')
                    ->onDelete('cascade');
            
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
        Schema::dropIfExists('posts');
    }
}
