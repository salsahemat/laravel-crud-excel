<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use App\Models\Item;
use App\Models\Need;
use App\Models\Quote;
use App\Models\PurchaseOrder;

class HomeController extends Controller
{
    public function index()
    {
        $summary = [
            'suppliers' => Supplier::count(),
            'items'     => Item::count(),
            'needs'     => Need::count(),
            'quotes'    => Quote::count(),
            'pos'       => PurchaseOrder::count(),
        ];

        return view('home', compact('summary'));
    }
}
