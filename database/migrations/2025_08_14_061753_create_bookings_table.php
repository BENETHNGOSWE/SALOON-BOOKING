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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->string('booking_name');
            $table->string('booking_phonenumber');
            $table->string('booking_service')->default('kunyoa');
            $table->date('booking_date');
            $table->time('booking_time');
            $table->string('booking_number')->unique();
            $table->enum('booking_status',['pending', 'accepted', 'rejected'])->default('pending')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
