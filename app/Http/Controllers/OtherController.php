<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OtherController extends Controller
{
    public function culturalPage()
    {
        return view('cultural');
    }
    public function westernPage()
    {
        return view('western');
    }

}
