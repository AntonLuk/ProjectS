<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateObjsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('objs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('address');
            $table->string('city');
            $table->string('street');
            $table->text('description');
            $table->string('house');
            $table->string('flat');
            $table->integer('district_id')->unsigned();
            $table->foreign('district_id')->references('id')->on('districts');
            $table->integer('years_construct');
            $table->integer('type_of_obj_id')->unsigned();
            $table->foreign('type_of_obj_id')->references('id')->on('type_of_objs');
            $table->integer('type_material_id')->unsigned();
            $table->foreign('type_material_id')->references('id')->on('type_materials');
            $table->integer('san_node_id')->unsigned();
            $table->foreign('san_node_id')->references('id')->on('san_nodes');
            $table->integer('room_id')->unsigned();
            $table->foreign('room_id')->references('id')->on('rooms');
            $table->integer('area');
            $table->integer('repair_id')->unsigned();
            $table->foreign('repair_id')->references('id')->on('repairs');
            $table->integer('floor')->nullable();
            $table->integer('floors')->nullable();
            $table->bigInteger('price');
            $table->integer('application_id')->unsigned();
            $table->foreign('application_id')->references('id')->on('applications')->onDelete('cascade');
            $table->string('number_client')->nullable();
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->double('geo_lat');
            $table->double('geo_lon');
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
        Schema::dropIfExists('objs');
    }
}
