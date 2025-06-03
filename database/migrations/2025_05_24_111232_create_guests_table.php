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
        Schema::create('guests', function (Blueprint $table) {
            $table->id();
                       $table->string('name');
            $table->enum('type',['accepted','rejected','expired']);
            $table->string('vehicle_number');
            $table->date('login_date');
            $table->time('login_time');
            $table->date('logOut_date');
            $table->time('logOut_time');
            $table->string('time_remaining');
            $table->string('notes');
            $table->string('number_visits');
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
        Schema::dropIfExists('guests');
    }
};
