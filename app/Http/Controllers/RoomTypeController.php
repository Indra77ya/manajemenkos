<?php

namespace App\Http\Controllers;

use App\Models\RoomType;
use App\Models\Branch;
use Illuminate\Http\Request;

class RoomTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roomTypes = RoomType::with('branch')->get();
        return view('admin.room_types.index', compact('roomTypes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $branches = Branch::all();
        return view('admin.room_types.create', compact('branches'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'branch_id' => 'required|exists:branches,id',
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'facilities' => 'nullable|string',
        ]);

        RoomType::create($validated);

        return redirect()->route('admin.room-types.index')->with('success', 'Room Type created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(RoomType $roomType)
    {
        return view('admin.room_types.show', compact('roomType'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RoomType $roomType)
    {
        $branches = Branch::all();
        return view('admin.room_types.edit', compact('roomType', 'branches'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, RoomType $roomType)
    {
        $validated = $request->validate([
            'branch_id' => 'required|exists:branches,id',
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'facilities' => 'nullable|string',
        ]);

        $roomType->update($validated);

        return redirect()->route('admin.room-types.index')->with('success', 'Room Type updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RoomType $roomType)
    {
        $roomType->delete();
        return redirect()->route('admin.room-types.index')->with('success', 'Room Type deleted successfully.');
    }
}
