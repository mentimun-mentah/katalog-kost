<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kosts', function (Blueprint $table) {
          $table->id();
          $table->text('image');
          $table->string('name');
          $table->text('slug');
          $table->string('category');
          $table->integer('total_rooms');
          $table->bigInteger('price_day')->nullable();
          $table->bigInteger('price_month')->nullable();
          $table->bigInteger('price_year')->nullable();
          $table->text('facilities');
          $table->double('lat');
          $table->double('lng');
          $table->text('address');
          $table->text('desc');
          $table->bigInteger('user_id')->unsigned();
          $table->timestamps();
        });

        Schema::table('kosts', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kosts');
    }
}
