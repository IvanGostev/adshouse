<?php

use App\Models\City;
use App\Models\Country;
use App\Models\District;
use App\Models\Region;
use App\Models\Street;
use App\Models\User;
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
        Schema::create('houses', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->longText('about')->nullable();
            $table->foreignIdFor(User::class)->constrained();
            $table->foreignIdFor(Country::class)->constrained();
            $table->foreignIdFor(City::class)->constrained();
            $table->foreignIdFor(District::class)->constrained();
            $table->string('img')->nullable();
            $table->text('street');
            $table->string('number');
            $table->string('apartment_number')->nullable();

            $table->string('status')->default('moderation');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('houses');
    }
};
