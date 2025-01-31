<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->constrained()->onDelete('cascade');
            $table->bigInteger('product_id')->constrained()->onDelete('cascade');
            $table->integer('quantity');
            $table->string('size');
            $table->string('status')->default("pending"); 
            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('carts');
    }
};
