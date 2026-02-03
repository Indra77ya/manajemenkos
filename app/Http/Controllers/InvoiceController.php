<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Lease;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function index()
    {
        $invoices = Invoice::with(['lease.user', 'lease.room'])->latest()->get();
        return view('admin.invoices.index', compact('invoices'));
    }

    public function create()
    {
        // Active leases only
        $leases = Lease::where('status', 'active')->with(['user', 'room.branch', 'room.type'])->get();
        return view('admin.invoices.create', compact('leases'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'lease_id' => 'required|exists:leases,id',
            'amount' => 'required|numeric|min:0',
            'due_date' => 'required|date',
        ]);

        Invoice::create($validated);

        return redirect()->route('admin.invoices.index')->with('success', 'Invoice created successfully.');
    }

    public function show(Invoice $invoice)
    {
        return view('admin.invoices.show', compact('invoice'));
    }

    public function edit(Invoice $invoice)
    {
        return view('admin.invoices.edit', compact('invoice'));
    }

    public function update(Request $request, Invoice $invoice)
    {
        if ($request->has('mark_paid')) {
            $invoice->update([
                'paid_at' => now(),
                'status' => 'paid',
            ]);
            return back()->with('success', 'Invoice marked as paid.');
        }

        // Standard update if needed
        return redirect()->route('admin.invoices.index');
    }

    public function destroy(Invoice $invoice)
    {
        $invoice->delete();
        return redirect()->route('admin.invoices.index')->with('success', 'Invoice deleted successfully.');
    }
}
