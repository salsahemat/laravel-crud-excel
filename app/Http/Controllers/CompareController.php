<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Need,Quote,PurchaseOrder,POItem};

class CompareController extends Controller
{
     public function show(Need $need){
    $quotes = Quote::with(['supplier','items'])->latest()->take(2)->get();
    $need->load('items.item');
    return view('compare.show',compact('need','quotes'));
  }

  public function choose(Request $r, Need $need){
    $r->validate(['quote_id'=>'required|exists:quotes,id','shipping_method'=>'required','payment_method'=>'required']);
    $q = Quote::with('items')->findOrFail($r->quote_id);
    $po = PurchaseOrder::create([
      'po_num'=>'PO-'.now()->format('ymd').'-'.str_pad((int)(PurchaseOrder::max('id')+1),3,'0',STR_PAD_LEFT),
      'supplier_id'=>$q->supplier_id,'need_id'=>$need->id,
      'shipping_method'=>$r->shipping_method,'payment_method'=>$r->payment_method,
      'status'=>'draft'
    ]);
    foreach($need->items as $ni){
      $qi = $q->items->firstWhere('item_id',$ni->item_id); if(!$qi) continue;
      POItem::create(['purchase_order_id'=>$po->id,'item_id'=>$ni->item_id,'qty'=>$ni->qty,'unit_price'=>$qi->price,'subtotal'=>$ni->qty*$qi->price]);
    }
    return redirect()->route('proc.pos.show',$po);
  }
}
