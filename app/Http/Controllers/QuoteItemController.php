<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Quote,QuoteItem};

class QuoteItemController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Quote $quote)
    {
        $data=$request->validate([
            'item_id' => 'required|exists:items,id',
            'price' => 'required|numeric',
            'pack_info' => 'nullable|string',
        ]);
        QuoteItem::updateOrCreate(['quote_id' => $quote->id, 'item_id' => $data['item_id']], ['price' => $data['price'], 'pack_info' => $data['pack_info']??null]);
        return back()->with('success', 'Quote item added successfully.');
    }
}
