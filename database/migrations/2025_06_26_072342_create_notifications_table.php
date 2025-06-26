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
        Schema::create('notifications', function (Blueprint $table) {
                $table->id();
    $table->string('entity_type'); // vehicle, camera, gate, department
    $table->unsignedBigInteger('entity_id');
    $table->string('event_type'); // create, move, open, delete, edit
    $table->string('title');
    $table->text('message');
    $table->unsignedBigInteger('created_by');
    $table->enum('target_audience', ['all', 'admin']);
            $table->softDeletes();
    $table->timestamps();


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
