<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoryRoomUserTariff extends Model
{
    use HasFactory;
    protected $guarded = false;
    public function room() {
        return Room::where('id', $this->room_id)->first();
    }
}
