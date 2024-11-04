<?php

use App\Models\City;
use App\Models\Country;
use App\Models\District;
use App\Models\Tariff;
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
        Schema::create('user_tariffs', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->constrained();
            $table->text('url');
            $table->string('img')->nullable();
            $table->foreignIdFor(Tariff::class)->constrained();
            $table->foreignIdFor(Country::class)->nullable()->constrained();
            $table->foreignIdFor(City::class)->nullable()->constrained();
            $table->foreignIdFor(District::class)->nullable()->constrained();
            $table->string('status')->default('moderation');
            $table->dateTime('finish_date')->nullable();
            $table->bigInteger('fulfilled_transitions')->default(0);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_tariffs');
    }
};
