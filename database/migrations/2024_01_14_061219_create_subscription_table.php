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
        Schema::create('subscription', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            //
            $table->string('name');
            $table->string('description');
            $table->decimal('price', 18, 2)->default(0.00);
            $table->integer('max_cars')->default(1);
            $table->integer('max_company')->default(1);
            $table->boolean('is_analytics_enabled')->default(false);
            $table->boolean('is_tracking_enabled')->default(false);
            $table->boolean('is_search_priority')->default(false);
            $table->integer('tracking_interval_in_minutes')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscription');
    }
};
