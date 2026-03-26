<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Enquiry;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index()
    {
        $featuredProducts = Product::where('quantity', '>', 0)->latest()->take(4)->get();
        return view('welcome', compact('featuredProducts'));
    }

    public function store(Request $request)
    {
        $query = Product::where('quantity', '>', 0);
        
        if ($request->has('search')) {
            $query->where('name', 'LIKE', "%{$request->search}%");
        }

        $products = $query->paginate(12);

        if ($request->ajax()) {
            return view('partials.product_grid', compact('products'))->render();
        }

        return view('frontend.store', compact('products'));
    }

    public function submitEnquiry(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required',
            'subject' => 'required',
            'message' => 'required',
        ]);

        $enquiry = Enquiry::create($request->all());

        // Notify via WhatsApp (Mock)
        \App\Services\WhatsAppService::sendMessage(
            config('mail.from.address'), // Sending to admin
            "New Web Enquiry from {$enquiry->name}: {$enquiry->subject}"
        );

        return back()->with('success', 'Thank you! Our team will contact you soon.');
    }
}
