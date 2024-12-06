<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BalanceApplication extends Model
{
    use HasFactory;
    protected $guarded = false;

    public function user() {
        $user =  User::where('id', $this->user_id)->first();
        if (!$user) {
            $user = User::onlyTrashed()->where('id', $this->user_id)->first();
        }
        return $user;
    }

}
