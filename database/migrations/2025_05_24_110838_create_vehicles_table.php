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
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->string('vehicle_number');
            $table->string('color');
            $table->foreignId('category_id');
            $table->foreignId('vehicle_type_id');
            $table->foreignId('car_type_id');
            $table->foreignId('motor_type_id');
            $table->foreignId('building_id');
            $table->foreignId('Unit_id');
            $table->date('date_End');
            $table->foreignId('user_id');
            $table->softDeletes();


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};
