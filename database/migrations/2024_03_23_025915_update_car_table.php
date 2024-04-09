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
        Schema::table('car', function(Blueprint $table) {
            $table->integer('units_available')->after('car_features')->default(0);
            $table->integer('units_left')->after('units_available')->default(0);
            $table->unsignedBigInteger('user_subscription_id')->after('units_left');
            //
            $table->foreign('user_subscription_id')->references('id')->on('user_subscription')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropColumns('car', ['units_available', 'units_left']);
        Schema::table('car', function (Blueprint $table) {
            $table->dropForeign('user_subscription_id');
        });
    }
};
