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
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            // Information about the customer
            $table->string('customer_name');
            $table->string('email')->nullable();
            $table->string('phone');

            // Information about the salon visit
            $table->string('service_type')->nullable(); // e.g., Haircut, Coloring, Styling
            $table->dateTime('appointment_time');
            
            // Status for your Dashboard counters (0 Pending, etc.)
            // We set 'pending' as the default so new ones show up automatically
            $table->string('status')->default('pending'); 

            $table->text('message')->nullable(); // For any special requests
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};