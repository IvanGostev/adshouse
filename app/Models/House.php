<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class House extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = false;
    public function countRooms() {
        return Room::where('house_id', $this->id)->count();
    }
    public function user() {
        return User::where('id', $this->user_id)->first();
    }
    public function country() {
        return Country::where('id', $this->country_id)->first();
    }
    public function city() {
        return City::where('id', $this->city_id)->first();
    }
    public function district() {
        return District::where('id', $this->district_id)->first();
    }
}
