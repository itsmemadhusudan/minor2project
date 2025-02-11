<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Upload;

class AdminController extends Controller
{
    public function index()
    {
        $uploads = Upload::all();
        return view('admin.admincontroller', ['uploads' => $uploads]);
    }

    public function adminController()
    {
        $uploads = Upload::all();
        return view('admin.admincontroller', compact('uploads'));
    }
    public function edit($id)
    {
        $upload = Upload::findOrFail($id);
        return view('admin.edit', compact('upload'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'designer_name' => 'required|string|max:255',
            'email' => 'required|email',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'category' => 'required|string',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $upload = Upload::findOrFail($id);
        $upload->designer_name = $request->designer_name;
        $upload->email = $request->email;
        $upload->description = $request->description;
        $upload->price = $request->price;
        $upload->category = $request->category;

        if ($request->hasFile('profile_picture')) {
            $file = $request->file('profile_picture');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public', $filename);
            $upload->profile_picture = $filename;
        }

        $upload->save();

        return redirect()->route('admin.admincontroller')->with('success', 'Upload updated successfully.');
    }
      public function destroy($id)
    {
        $upload = Upload::findOrFail($id);
        $upload->delete();

        return redirect()->route('admin.admincontroller')->with('success', 'Upload deleted successfully.');
    }
}
