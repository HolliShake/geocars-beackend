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
        Schema::create('car_photo', function (Blueprint $table) {
            $table->id();
            //
            $table->string('path');
            $table->string('file');
            $table->string('extension');
            $table->unsignedBigInteger('car_id');
            // FK
            $table->foreign('car_id')->references('id')->on('car')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('car_photo');
    }
};
