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
        Schema::create('notification_rules', function (Blueprint $table) {
           $table->id();
   $table->string('entity_type'); // section, vehicle, camera
   $table->string('event_type');  // create, update, delete, move
   $table->enum('target_audience', ['all', 'admin']);
   $table->json('channels');      // ["system", "email", "sms"]
   $table->string('title');
   $table->text('message');
   $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notification_rules');
    }
};
