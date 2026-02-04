<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use Illuminate\Http\Request;

class BranchController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $branches = Branch::all();
        return view('admin.branches.index', compact('branches'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.branches.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:255',
            'address' => 'required|string',
            'manager_name' => 'required|string|max:255',
            'assistant_1_name' => 'nullable|string|max:255',
            'assistant_2_name' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:255',
            'manager_phone' => 'nullable|string|max:255',
            'cost' => 'nullable|numeric|min:0',
            'description' => 'nullable|string',
        ]);

        Branch::create($validated);

        return redirect()->route('admin.branches.index')->with('success', 'Lokasi Kos berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Branch $branch)
    {
        return view('admin.branches.show', compact('branch'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Branch $branch)
    {
        return view('admin.branches.edit', compact('branch'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Branch $branch)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:255',
            'address' => 'required|string',
            'manager_name' => 'required|string|max:255',
            'assistant_1_name' => 'nullable|string|max:255',
            'assistant_2_name' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:255',
            'manager_phone' => 'nullable|string|max:255',
            'cost' => 'nullable|numeric|min:0',
            'description' => 'nullable|string',
        ]);

        $branch->update($validated);

        return redirect()->route('admin.branches.index')->with('success', 'Lokasi Kos berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Branch $branch)
    {
        $branch->delete();
        return redirect()->route('admin.branches.index')->with('success', 'Lokasi Kos berhasil dihapus.');
    }
}
