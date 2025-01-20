<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Country extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = false;

    public function currency() {
        $currency =  Currency::where('id', $this->currency_id)->first();
        if (!$currency) {
            $currency = Currency::onlyTrashed()->where('id', $this->currency_id)->first();
        }
        return $currency;
    }
}
