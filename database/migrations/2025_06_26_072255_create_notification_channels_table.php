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
        Schema::create('notification_channels', function (Blueprint $table) {
      $table->id();
    $table->unsignedBigInteger('notification_id');
    $table->enum('channel', ['system', 'email', 'sms']);
    $table->boolean('status')->default(false);
    $table->timestamp('sent_at')->nullable();
    $table->timestamps();
        $table->softDeletes();
    $table->foreign('notification_id')->references('id')->on('notifications')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notification_channels');
    }
};
