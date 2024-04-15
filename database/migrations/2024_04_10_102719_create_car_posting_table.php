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
        Schema::create('car_posting', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            //
            $table->unsignedBigInteger('car_id');
            $table->decimal('price',9, 3)->default(0.00);
            $table->decimal('excess_charges', 9, 3)->default(0.00);
            $table->integer('days');
            //
            $table->dateTime('post_date');
            $table->dateTime('expiry_date');
            $table->boolean('never_expires')->default(false);
            // Fk
            $table->foreign('car_id')->references('id')->on('car')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('car_posting');
    }
};
