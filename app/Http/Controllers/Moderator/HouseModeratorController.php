<?php

namespace App\Http\Controllers\Moderator;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\District;
use App\Models\House;
use App\Models\PaymentTransaction;
use Illuminate\Http\Request;


class HouseModeratorController extends Controller
{

    public function search(Request $request) {
        $houses = House::query();
        $data = $request->all();
        $houses->join('users', 'users.id', '=', 'houses.user_id');
        if ($data['status'] != 'all') {
            $houses->where('houses.status',  $data['status']);
        }

        if ($data['city_id'] != 'all') {
            $houses->where('houses.city_id',  $data['city_id']);
        }

        if ($data['district_id'] != 'all') {
            $houses->where('houses.district_id',  $data['district_id']);
        }

        if (isset($data['street'])) {
            $houses->where('houses.street','LIKE',"%{$data['street']}%");
        }
        if (isset($data['email'])) {
            $houses->where('users.email','LIKE',"%{$data['email']}%");
        }
        $cities = City::all();
        $districts = District::all();
        $houses = $houses->paginate($data['paginateNumber'] ?? 12);
        return view('moderator.house.index', compact('houses', 'cities', 'districts'));
    }


    public function index()
    {
        $houses = House::paginate(12);
        $cities = City::all();
        $districts = District::all();
        return view('moderator.house.index', compact('houses', 'cities', 'districts'));
    }

    public function update(House $house)
    {
        if ($house->status == 'approved') {
            $house->status = 'moderation';
            $house->update();
        } else {
            $house->status = 'approved';
            $house->update();
        }
        $house->update();
        deleteNotification('house');
        return back();
    }
}
