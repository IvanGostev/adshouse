<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\Message;
use App\Models\Post;
use App\Models\Review;
use App\Models\Work;
use Illuminate\Http\Request;

class LanguageController extends Controller
{
    public function switch(Request $request)
    {
        session()->put('language', Country::where('id', $request->input('country_id'))->first()->language);
        session()->put('country_id', $request->input('country_id'));
        return redirect()->back();
    }
}
