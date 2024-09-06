<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Country;
use App\Models\House;
use App\Models\UserTariff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class LinkUserController extends Controller
{
    function index()
    {
        $links = UserTariff::where('status', 'active')->paginate(10);
        return view('user.link.index', compact('links'));
    }
 }
