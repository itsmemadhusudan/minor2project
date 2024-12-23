<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Upload; // Import the Upload model

class DesignerController extends Controller
{
    public function aboutUs()
    {
        return view('aboutus');
    }

    public function culturalProduct(){
        $uploads = Upload::where('category','Cultural')->get();

        return view('cultural',compact('uploads'));
    }

    public function westernProduct(){
        $uploads = Upload::where('category','Western')->get();

        return view('western',compact('uploads'));
    }

    public function showDesignerPage()
    {
        $uploads = Upload::all();

        return view('designer',compact('uploads'));
    }

    public function profile()
    {
        return view('profile');
    }

    public function updateProfile(Request $request)
    {
        // Add your update profile logic here
        return redirect()->route('profile')->with('status', 'Profile updated!');
    }

    public function index()
    {
        // Fetch uploads data from the database
        $uploads = Upload::all();

        // Pass the data to the view
        return view('designer', compact('uploads'));
    }

    // Other methods...
}
