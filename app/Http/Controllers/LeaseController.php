<?php

namespace App\Http\Controllers;

use App\Models\Lease;
use App\Models\Room;
use App\Models\User;
use Illuminate\Http\Request;

class LeaseController extends Controller
{
    public function index()
    {
        $leases = Lease::with(['user', 'room.branch', 'room.type'])->get();
        return view('admin.leases.index', compact('leases'));
    }

    public function create()
    {
        // Get available rooms
        $rooms = Room::with(['branch', 'type'])->where('status', 'available')->get();
        // Get tenants
        $tenants = User::where('role', 'tenant')->get();

        return view('admin.leases.create', compact('rooms', 'tenants'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'room_id' => 'required|exists:rooms,id',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after:start_date',
        ]);

        $lease = Lease::create($validated);

        // Update room status
        $room = Room::find($validated['room_id']);
        $room->update(['status' => 'occupied']);

        return redirect()->route('admin.leases.index')->with('success', 'Lease created successfully.');
    }

    public function show(Lease $lease)
    {
        return view('admin.leases.show', compact('lease'));
    }

    public function edit(Lease $lease)
    {
        // Simple edit not implemented for now, maybe just change dates.
        return redirect()->route('admin.leases.index');
    }

    public function update(Request $request, Lease $lease)
    {
        //
    }

    public function destroy(Lease $lease)
    {
         $room = $lease->room;
         $room->update(['status' => 'available']);
         $lease->delete();
         return redirect()->route('admin.leases.index')->with('success', 'Lease deleted successfully.');
    }
}
