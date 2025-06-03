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
        Schema::create('vehicles_movements', function (Blueprint $table) {
            $table->id();
            $table->enum('type_Movement',['Enter','Exit']);
            $table->enum('Method_of_passage',['Manual','Automatic']);
            $table->foreignId('vehicle_id');
            $table->foreignId('gate_id');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicles_movements');
    }
};
