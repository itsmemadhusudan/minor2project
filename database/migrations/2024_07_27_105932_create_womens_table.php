<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('womens', function (Blueprint $table) {
            $table->id();
            $table->string('image'); // Assuming you will store the image path
            $table->string('designer_name');
            $table->string('email');
            $table->string('address');
            $table->text('description');
            $table->decimal('price', 8, 2); // Adjust precision and scale as needed
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('womens');
    }
};
