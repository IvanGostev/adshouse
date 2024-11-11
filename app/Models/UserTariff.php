<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserTariff extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = false;


    public function tariff()
    {
        return Tariff::where('id', $this->tariff_id)->first();
    }
    public function user()
    {
        return User::where('id', $this->user_id)->first();
    }

    public function rooms()
    {
        return Room::join('room_user_tariffs', 'rooms.id', '=', 'room_user_tariffs.room_id')
            ->where('room_user_tariffs.user_tariff_id', $this->id)
            ->select('rooms.*')
            ->get();
    }
}
