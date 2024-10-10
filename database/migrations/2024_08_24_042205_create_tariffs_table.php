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
        Schema::create('tariffs', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('about')->nullable();
            $table->bigInteger('transitions');
            $table->bigInteger('number_rooms');
            $table->double('price');
            $table->bigInteger('days');
            $table->integer('percent_owner');
            $table->integer('percent_user');
            $table->string('type');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tariffs');
    }
};
