<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('safaris', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->integer('min_guests');
            $table->string('time_estimate');
            $table->string('location');
            $table->string('price');
            $table->string('image');
            $table->text('description')->nullable();
            $table->text('inclusions')->nullable();
            $table->text('exclusions')->nullable();
            $table->text('additional_info')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('safaris');
    }
};
