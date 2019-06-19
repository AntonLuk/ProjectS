<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
class CreateObjComplexsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('obj_complexs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('obj_id')->unsigned();
            $table->foreign('obj_id')->references('id')->on('objs')->ondelete('cascade');
            $table->integer('complex_id')->unsigned();
            $table->foreign('complex_id')->references('id')->on('complexs')->ondelete('cascade');
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
        Schema::dropIfExists('obj_complexs');
    }
}