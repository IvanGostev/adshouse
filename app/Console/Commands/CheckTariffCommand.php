<?php

namespace App\Console\Commands;

use App\Models\BalanceApplication;
use App\Models\RoomUserTariff;
use App\Models\User;
use App\Models\UserTariff;
use Carbon\Carbon;
use Illuminate\Console\Command;

class CheckTariffCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tariff:check';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Automatic renewal or deactivation of the tariff';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $UTs = UserTariff::join('tariffs', 'tariffs.id', '=', 'user_tariffs.tariff_id')
            ->where('tariffs.status', 'approved')
            ->where('user_tariffs.finish_date', '<', Carbon::now());

        foreach ($UTs as $UT) {
            $user = $UT->user();
            if ($user->balance >= $UT->user()->price) {
                $user->balance = $user->balance - $UT->tarrif()->price;
                $user->update();
                BalanceApplication::create([
                    'user_id' => $user->id,
                    'amount' => $UT->tarrif()->price,
                    'type' => 'renewal tariff',
                    'status' => 'approved'
                ]);
            } else {
                $RUTs = RoomUserTariff::where('user_tariff', $UT->id)->get();
                foreach ($RUTs as $RUT) {
                    $room = $RUT->room();
                    $RUT->delete();
                    $room->condition = 'free';
                    $room->update();
                }
            }

        }

    }
}
