<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Quote,Supplier,Item};

class QuoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $quotes=Quote::with('supplier')->latest()->paginate(10);
        return view('quotes.index', compact('quotes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $suppliers=Supplier::all();
        return view('quotes.create', compact('suppliers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $quote = Quote::create($request->validate([
            'quote_num' => 'nullable',
            'supplier_id' => 'required|exists:suppliers,id'
        ]));
        return redirect()->route('proc.quotes.edit',$quote);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Quote $quote)
    {
     $quote->load('items.item','supplier');
     $items=Item::all();
     return view('quotes.edit', compact('quote','items'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Quote $quote)
    {
        $quote->update($request->validate([
            'shipping_method' => 'nullable',
            'payment_method' => 'nullable',
            'status' => 'nullable'
        ]));
        return back()->with('success', 'Quote updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Quote $quote)
    {
        $quote->delete();
        return back()->with('success', 'Quote deleted successfully.');
    }
}
