<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Branch;
use App\Models\RoomType;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rooms = Room::with(['branch', 'type'])->get();
        return view('admin.rooms.index', compact('rooms'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $branches = Branch::all();
        // In a real app, we'd use JS to filter types based on branch.
        // For now, pass all types.
        $roomTypes = RoomType::all();
        return view('admin.rooms.create', compact('branches', 'roomTypes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'branch_id' => 'required|exists:branches,id',
            'room_type_id' => 'required|exists:room_types,id',
            'number' => 'required|string|max:255',
            'status' => 'required|in:available,occupied,maintenance',
        ]);

        $type = RoomType::find($validated['room_type_id']);
        if ($type->branch_id != $validated['branch_id']) {
             return back()->withErrors(['room_type_id' => 'Room Type does not belong to the selected Branch.'])->withInput();
        }

        Room::create($validated);

        return redirect()->route('admin.rooms.index')->with('success', 'Room created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Room $room)
    {
        return view('admin.rooms.show', compact('room'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Room $room)
    {
        $branches = Branch::all();
        $roomTypes = RoomType::where('branch_id', $room->branch_id)->get();
        return view('admin.rooms.edit', compact('room', 'branches', 'roomTypes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Room $room)
    {
        $validated = $request->validate([
            'branch_id' => 'required|exists:branches,id',
            'room_type_id' => 'required|exists:room_types,id',
            'number' => 'required|string|max:255',
            'status' => 'required|in:available,occupied,maintenance',
        ]);

        $type = RoomType::find($validated['room_type_id']);
        if ($type->branch_id != $validated['branch_id']) {
             return back()->withErrors(['room_type_id' => 'Room Type does not belong to the selected Branch.'])->withInput();
        }

        $room->update($validated);

        return redirect()->route('admin.rooms.index')->with('success', 'Room updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Room $room)
    {
        $room->delete();
        return redirect()->route('admin.rooms.index')->with('success', 'Room deleted successfully.');
    }
}
