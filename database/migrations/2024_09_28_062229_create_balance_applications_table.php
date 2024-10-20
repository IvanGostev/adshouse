<?php

use App\Models\Tariff;
use App\Models\Transition;
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
        Schema::create('balance_applications', function (Blueprint $table) {
            $table->id();
            $table->double('amount');
            $table->string('type');
            $table->string('method');
            $table->longText('information')->nullable();
            $table->string('status')->default('moderation'); // cancelled // approved
            $table->foreignIdFor(User::class)->constrained();
            $table->foreignIdFor(Tariff::class)->nullable()->constrained();
            $table->foreignIdFor(Transition::class)->nullable()->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('balance_applications');
    }
};
