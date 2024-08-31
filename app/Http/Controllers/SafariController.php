<?php

namespace App\Http\Controllers;

use App\Models\Safari;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class SafariController extends Controller
{
    public function index()
    {
        try {
            $safaris = Safari::all()->map(function($safari) {
                $safari->image = asset('images/' . $safari->image);
                return $safari;
            });
            
            return response()->json($safaris);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function show($id)
    {
        try {
            $safari = Safari::findOrFail($id);
            $safari->image = asset('images/' . $safari->image);
            return response()->json($safari);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 404);
        }
    }

    
    public function store(Request $request)
    {
        // Validate request
        $request->validate([
            'title' => 'required|string',
            'min_guests' => 'required|integer',
            'time_estimate' => 'required|string',
            'price' => 'required|numeric',
            'location' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'description' => 'nullable|string',
            'inclusions' => 'nullable|string',
            'exclusions' => 'nullable|string',
            'additional_info' => 'nullable|string',
        ]);
    
        // Handle image upload
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName); // Save to new directory
    
            // Save to database
            DB::table('safaris')->insert([
                'title' => $request->title,
                'min_guests' => $request->min_guests,
                'time_estimate' => $request->time_estimate,
                'price' => $request->price,
                'location' => $request->location,
                'image' => $imageName,
                'description' => $request->description,
                'inclusions' => $request->inclusions,
                'exclusions' => $request->exclusions,
                'additional_info' => $request->additional_info,
            ]);
    
            // Return the image path in the response
            return response()->json(['success' => 'Safari added successfully', 'image' => $imageName]);
        } else {
            return response()->json(['error' => 'Image upload failed'], 400);
        }
    }
    

    public function update(Request $request, $id)
    {
        $safari = Safari::findOrFail($id);

        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'price' => 'required|numeric',
            'image' => 'sometimes|image',
            'min_guests' => 'required|integer',
            'location' => 'required|max:255',
            'description' => 'required',
        ]);

        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($safari->image);
            $imagePath = $request->file('image')->store('safaris', 'public');
            $validatedData['image'] = $imagePath;
        }

        $safari->update($validatedData);

        return response()->json($safari);
    }

    public function destroy($id)
    {
        $safari = Safari::findOrFail($id);
        Storage::disk('public')->delete($safari->image);
        $safari->delete();

        return response()->json(null, 204);
    }

    public function totalTours()
    {
        $total = Safari::count();
        return response()->json(['total' => $total]);
    }
    
}
