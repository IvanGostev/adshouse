<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Qrcode extends Model
{
    use HasFactory;
    protected $guarded = false;
    public function advertiser() {
        return RoomUserTariff::where('room_id', $this->room_id)
            ->join('user_tariffs', 'room_user_tariffs.user_tariff_id', 'user_tariffs.id')
            ->join('users', 'user_tariffs.user_id', 'users.id')->first();
    }
    public function room() {
        return Room::where('id', $this->room_id)->first();
    }
}
