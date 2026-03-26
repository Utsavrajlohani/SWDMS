<?php

namespace App\Http\Controllers;

use App\Models\Payment;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $payments = Payment::with(['user', 'retailer'])->latest()->get();
        return view('payments.index', compact('payments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $retailers = \App\Models\Retailer::where('current_due', '>', 0)->get();
        return view('payments.create', compact('retailers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'retailer_id' => 'required|exists:retailers,id',
            'amount_paid' => 'required|numeric|min:1',
            'payment_mode' => 'required|string',
            'reference_number' => 'nullable|string',
            'payment_date' => 'required|date',
        ]);

        try {
            DB::beginTransaction();

            $retailer = \App\Models\Retailer::findOrFail($request->retailer_id);
            
            $existingPayment = Payment::where('retailer_id', $retailer->id)
                ->whereDate('payment_date', $request->payment_date)
                ->where('payment_mode', $request->payment_mode)
                ->first();

            if ($existingPayment) {
                $existingPayment->amount_paid += $request->amount_paid;
                if ($request->reference_number) {
                    $existingPayment->reference_number = $existingPayment->reference_number 
                        ? $existingPayment->reference_number . ' | ' . $request->reference_number 
                        : $request->reference_number;
                }
                $existingPayment->save();
            } else {
                $paymentData = $request->all();
                $paymentData['retailer_id'] = $retailer->id;
                Payment::create($paymentData);
            }
            
            $retailer->decrement('current_due', $request->amount_paid);

            DB::commit();

            return redirect()->route('payments.index')->with('success', 'Payment recorded successfully.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['msg' => 'Error recording payment: ' . $e->getMessage()]);
        }
    }
}
