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
        Schema::create('car', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            //
            $table->string('car_brand');
            $table->string('car_model');
            $table->string('car_year')->default('1990');
            $table->string('car_plate')->default('AAA-0000');
            $table->string('car_description');
            $table->string('car_features'); // JSON LIKE FORMAT
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('car');
    }
};
