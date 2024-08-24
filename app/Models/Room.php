<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;
    protected $guarded = false;
    public function type() {
        return RoomType::where('id', $this->room_type_id)->first();
    }
    public function house() {
        return House::where('id', $this->house_id)->first();
    }
}
