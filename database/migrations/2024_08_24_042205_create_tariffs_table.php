<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tariffs', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('about')->nullable();
            $table->double('price');
            $table->string('type'); // standard or shared
            $table->string('method'); // Rooms or Transitions

            // Общие
            $table->bigInteger('number_rooms'); // Видно для Плана по комнатам и скрыт для переходного

            // План по количеству переходов
            $table->bigInteger('transitions')->nullable();
            $table->double('percent_owner')->nullable();
            $table->double('percent_user')->nullable();

            // План по комнатам
            $table->bigInteger('days')->nullable();
            $table->double('amount_owner')->nullable();
            $table->double('amount_user')->nullable();

            // Работают планы одинаково разница в:
            // 1) Transitions перестанет работать, когда количество уникальных переходов будет выполнено
            //    Rooms, когда закончиться дни на которые был расчет
            // 2) У Transitions мы даем процент, а в Rooms сумму

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
