<?php

namespace App\Http\Controllers;

use App\Models\Retailer;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Payment;

class RetailerController extends Controller
{
    public function index(Request $request)
    {
        $query = Retailer::query();

        if ($request->has('search')) {
            $search = $request->get('search');
            $query->where(function($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                  ->orWhere('area', 'LIKE', "%{$search}%")
                  ->orWhere('contact_person', 'LIKE', "%{$search}%");
            });
        }

        if ($request->has('area')) {
            $query->where('area', 'LIKE', "%{$request->get('area')}%");
        }

        $retailers = $query->latest()->paginate(10);
        return view('retailers.index', compact('retailers'));
    }

    public function create()
    {
        return view('retailers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'contact_person' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'address' => 'nullable|string',
            'area' => 'nullable|string|max:255',
            'credit_limit' => 'nullable|numeric|min:0',
            'due_date_days' => 'nullable|integer|min:0',
            'bnpl_active' => 'nullable|boolean',
        ]);

        $data = $request->all();
        $data['bnpl_active'] = $request->has('bnpl_active');

        Retailer::create($data);

        return redirect()->route('retailers.index')->with('success', 'Retailer created successfully.');
    }

    public function edit(Retailer $retailer)
    {
        return view('retailers.edit', compact('retailer'));
    }

    public function show(Retailer $retailer)
    {
        return redirect()->route('retailers.ledger', $retailer);
    }

    public function update(Request $request, Retailer $retailer)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'contact_person' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'address' => 'nullable|string',
            'area' => 'nullable|string|max:255',
            'credit_limit' => 'nullable|numeric|min:0',
            'due_date_days' => 'nullable|integer|min:0',
            'bnpl_active' => 'nullable|boolean',
        ]);

        $data = $request->all();
        $data['bnpl_active'] = $request->has('bnpl_active');

        $retailer->update($data);

        return redirect()->route('retailers.index')->with('success', 'Retailer updated successfully.');
    }

    public function destroy(Retailer $retailer)
    {
        $retailer->delete();
        return redirect()->route('retailers.index')->with('success', 'Retailer deleted successfully.');
    }

    public function bnplIndex()
    {
        $retailers = Retailer::where('bnpl_active', true)
            ->orWhere('current_due', '>', 0)
            ->latest()
            ->paginate(10);
            
        $availableRetailers = Retailer::where('bnpl_active', false)
            ->orderBy('name')
            ->get();

        return view('retailers.bnpl_index', compact('retailers', 'availableRetailers'));
    }

    public function enrollBnpl(Request $request)
    {
        $request->validate([
            'retailer_id' => 'required|exists:retailers,id',
            'credit_limit' => 'required|numeric|min:0',
            'due_date_days' => 'required|integer|min:0',
        ]);

        $retailer = Retailer::findOrFail($request->retailer_id);
        $retailer->update([
            'bnpl_active' => true,
            'credit_limit' => $request->credit_limit,
            'due_date_days' => $request->due_date_days,
            'penalty_rate' => $request->penalty_rate ?? 2.0,
        ]);

        return redirect()->route('retailers.index')->with('success', "{$retailer->name} enrolled in BNPL successfully!");
    }

    public function ledger(Retailer $retailer, Request $request)
    {
        $orders = Order::where('retailer_id', $retailer->id)->latest()->limit(50)->get();
        $payments = \App\Models\Payment::where('retailer_id', $retailer->id)->latest()->limit(50)->get();

        if ($request->has('download')) {
            $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('retailers.ledger_pdf', compact('retailer', 'orders', 'payments'));
            return $pdf->download('Ledger-' . str_replace(' ', '_', $retailer->name) . '-' . date('Y-m-d') . '.pdf');
        }

        return view('retailers.ledger', compact('retailer', 'orders', 'payments'));
    }

    public function bnpl(Retailer $retailer)
    {
        return view('retailers.bnpl', compact('retailer'));
    }

    public function updateBnpl(Request $request, Retailer $retailer)
    {
        $request->validate([
            'credit_limit' => 'required|numeric|min:0',
            'due_date_days' => 'required|integer|min:0',
            'penalty_rate' => 'required|numeric|min:0',
        ]);

        $retailer->update($request->only(['credit_limit', 'due_date_days', 'penalty_rate', 'bnpl_active']));

        return redirect()->route('retailers.index')->with('success', 'BNPL settings updated.');
    }
}
