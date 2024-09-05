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
        Schema::create('professionals', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->string('specialty', 255);
            $table->string('crm', 50)->unique();
            $table->string('contact', 20)->nullable();
            $table->string('email', 255)->unique();
            $table->date('hire_date')->nullable();
            $table->time('start_time')->nullable();
            $table->time('end_time')->nullable();
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('professionals');
    }
};
