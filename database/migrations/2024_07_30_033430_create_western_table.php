<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWesternTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('westerns', function (Blueprint $table) {
            $table->id();
            $table->string('designer_name');
            $table->string('email');
            $table->string('address');
            $table->text('description')->nullable();
            $table->decimal('price', 8, 2);
            $table->string('category');
            $table->string('profile_picture');
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
        Schema::dropIfExists('westerns');
    }
}
