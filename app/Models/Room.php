<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Room extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = false;
    public function type() {
        return RoomType::where('id', $this->room_type_id)->first();
    }
    public function house() {
        return House::where('id', $this->house_id)->first();
    }
}
