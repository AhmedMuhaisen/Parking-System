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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('website_Logo');
            $table->string('website_Name');
            $table->string('Website_Email');
            $table->string('Website_phone');
            $table->string('Address');
            $table->string('Header_image');
            $table->string('Header_title');
              $table->string('Header_subtitle');
            $table->string('About_image');
            $table->string('About_title');
            $table->string('About_content');
                $table->string('Advantage_image');
            $table->string('Advantage_title');
            $table->string('Advantages');

            $table->string('Number_spots_parking');
            $table->string('Number_spots_building');
            $table->string('Number_HandelCapSpots_parking');
            $table->string('Number_HandelCapSpots__building');
            $table->string('Number_RegularSpots_parking');
            $table->string('Number_RegularSpots_building');
            $table->string('Number_VisitorSpots_parking');
            $table->string('Number_VisitorSpots_building');
            $table->string('Number_Vehicles_parking');
            $table->string('Number_Vehicles_building');
            $table->string('Number_Vehicles_Unit');
            $table->string('Number_Vehicles_User');
            $table->string('Number_Guests_Unit');
             $table->string('Number_Camera_parking');
            $table->string('Number_Gates_parking');
            $table->softDeletes();


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
