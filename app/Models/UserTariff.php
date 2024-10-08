<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserTariff extends Model
{
    use HasFactory;
    protected $guarded = false;


    public function tariff() {
        return Tariff::where('id', $this->tariff_id)->first();
    }
}
