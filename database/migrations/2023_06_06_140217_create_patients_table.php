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
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->string('surname');
            $table->string('name');
            $table->date('date');
            $table->string('city');
            $table->string('cf', 16);
            $table->string('ts')->nullable();
            $table->date('expiry')->nullable();
            $table->string('address');
            $table->string('cap', 5);
            $table->string('phone', 10);
            $table->string('email')->nullable();
            $table->boolean('consent');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patients');
    }
};
