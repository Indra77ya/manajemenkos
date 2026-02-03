<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TenantDashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Get active lease
        $activeLease = $user->leases()
                            ->where('status', 'active')
                            ->with(['room.branch', 'room.type'])
                            ->latest()
                            ->first();

        // Get all invoices for this user (through leases)
        // Since we defined HasMany Through logic manually via collection or relationships
        // Let's just fetch all leases and their invoices.
        $leases = $user->leases()->with('invoices')->get();
        $invoices = $leases->pluck('invoices')->flatten()->sortByDesc('due_date');

        return view('tenant.dashboard', compact('activeLease', 'invoices'));
    }
}
