<?php

namespace App\Http\Controllers;

use App\Models\Guide;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class GuideController extends Controller
{
    public function index()
    {
        $guides = Guide::all();
        return response()->json($guides);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'gender' => 'required|string',
            'phone' => 'required|string',
            'email' => 'required|email|unique:guides,email',
            'role' => 'required|string',
            'image' => 'nullable|image'
        ]);

        $imageName = null;
        if ($request->hasFile('image')) {
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('images'), $imageName);
        }

        $guide = Guide::create([
            'name' => $request->name,
            'gender' => $request->gender,
            'phone' => $request->phone,
            'email' => $request->email,
            'role' => $request->role,
            'image' => $imageName,
        ]);

        return response()->json($guide, 201);
    }

    public function show($id)
    {
        $guide = Guide::find($id);
        if (!$guide) {
            return response()->json(['error' => 'Guide not found'], 404);
        }
        return response()->json($guide);
    }

    public function update(Request $request, $id)
    {
        $guide = Guide::find($id);
        if (!$guide) {
            return response()->json(['error' => 'Guide not found'], 404);
        }

        $request->validate([
            'name' => 'sometimes|required|string',
            'gender' => 'sometimes|required|string',
            'phone' => 'sometimes|required|string',
            'email' => 'sometimes|required|email',
            'role' => 'sometimes|required|string',
            'image' => 'nullable|image'
        ]);

        if ($request->hasFile('image')) {
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            if ($guide->image) {
                Storage::delete(public_path('images').'/'.$guide->image);
            }
            $guide->image = $imageName;
        }

        $guide->update($request->only(['name', 'phone', 'email', 'role']));

        return response()->json($guide);
    }

    public function destroy($id)
    {
        $guide = Guide::find($id);
        if (!$guide) {
            return response()->json(['error' => 'Guide not found'], 404);
        }

        if ($guide->image) {
            Storage::delete(public_path('images').'/'.$guide->image);
        }

        $guide->delete();

        return response()->json(['message' => 'Guide deleted successfully']);
    }

    public function totalGuides()
    {
        $total = Guide::count();
        return response()->json(['total' => $total]);
    }
}
