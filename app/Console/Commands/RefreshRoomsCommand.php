<?php

namespace App\Console\Commands;

use App\Models\Room;
use App\Models\RoomUserTariff;
use App\Models\UserTariff;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

use PhpParser\Node\Stmt\TryCatch;

class RefreshRoomsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'room:refresh';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Redefining room links';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        try {
            DB::beginTransaction();
            $RUTs = RoomUserTariff::all();
            foreach ($RUTs as $RUT) {
                $room = $RUT->room();
                $room->condition = 'free';
                $room->update();
                $RUT->delete();
            }
            $UTs = UserTariff::where('status', 'approved')->inRandomOrder()->get();
            foreach ($UTs as $UT) {
                if ($UT->tariff()->type = 'standard') {
                    $idsRoomUnsuitable = RoomUserTariff::distinct('room_id')->pluck('room_id')->toArray();
                    $rooms = Room::join('houses', 'rooms.house_id', '=', 'houses.id')
                        ->whereNot('rooms.id', $idsRoomUnsuitable)
                        ->where('rooms.condition', 'free')
                        ->where('rooms.status', 'approved')
                        ->distinct('houses.id')
                        ->take($UT->tariff()->number_rooms)
                        ->select('rooms.*')
                        ->get();
                    foreach ($rooms as &$room) {
                        RoomUserTariff::create(['user_tariff_id' => $UT->id, 'room_id' => $room->id]);
                        $room->condition = 'occupied';
                        $room->update();
                    }
                } else {
                    $rooms = Room::join('houses', 'rooms.house_id', '=', 'houses.id')
                        ->where('rooms.condition', 'free')
                        ->where('rooms.status', 'approved')
                        ->distinct('houses.id')
                        ->take($UT->tariff()->number_rooms)
                        ->select('rooms.*')
                        ->get();
                    foreach ($rooms as &$room) {
                        RoomUserTariff::create(['user_tariff_id' => $UT->id, 'room_id' => $room->id]);
                        if (RoomUserTariff::where('room_id', $room->id)->count() >= 5) {
                            $room->condition = 'occupied';
                            $room->update();
                        }
                    }
                }
            }
        } catch (Exception $exception) {
            DB::rollBack();
        }

    }

}
