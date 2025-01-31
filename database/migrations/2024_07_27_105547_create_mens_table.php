<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('mens', function (Blueprint $table) {
            $table->id();
            $table->string('image');
            $table->string('designer_name');
            $table->string('email');
            $table->string('address');
            $table->text('description');
            $table->decimal('price', 8, 2); 
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mens');
    }
};
