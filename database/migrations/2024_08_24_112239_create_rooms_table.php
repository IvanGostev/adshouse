<?php

use App\Models\House;
use App\Models\RoomType;
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
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(House::class)->constrained();
            $table->foreignIdFor(RoomType::class)->constrained();
//            $table->string('img')->default('images/room-placeholder.jpg');
            $table->string('about')->nullable();
            $table->string('condition')->default('free');
            $table->string('status')->default('moderation');
            $table->softDeletes();
            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};
