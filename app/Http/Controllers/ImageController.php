<?php

namespace App\Http\Controllers;

use App\Jobs\ApplyFilter1;
use App\Jobs\ApplyFilter2;
use App\Jobs\ProcessImageJob;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function uploadImage(Request $request)
    {

        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $path = $request->file('image')->store('public');

        $imagePath = storage_path('app/' . $path);

        $job = (new ProcessImageJob($imagePath)) // process image applies brightness to 30 and rotates 45 degree
        ->chain([
            new ApplyFilter1($imagePath), // invert colors
            new ApplyFilter2($imagePath), // pixelate 20 percent
        ]);

        dispatch($job);
        
        // $imageUrl = Storage::url($path);
        dd(1);

        return view('welcome', compact('imageUrl'));

    }
}