<?php

use App\Models\Currency;
use App\Models\Room;
use App\Models\User;
use App\Models\UserTariff;
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
        Schema::create('transitions', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Room::class)->nullable()->constrained();
            $table->foreignIdFor(User::class)->nullable()->constrained();
            $table->foreignIdFor(UserTariff::class)->constrained();
            $table->string('browser');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transitions');
    }
};
