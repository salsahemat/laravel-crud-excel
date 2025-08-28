<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{PurchaseOrder,Receipt,ReceiptItem};

class ReceiptController extends Controller
{
  public function create(PurchaseOrder $po){ 
    $po->load('items.item'); 
    return view('receipts.create',compact('po')); 
}
  public function store(Request $r, PurchaseOrder $po){
    $r->validate(['items'=>'required|array']); 
    $rec=Receipt::create(['purchase_order_id'=>$po->id,'received_by'=>auth()->id(),'received_at'=>now()]);
    foreach($r->items as $item_id=>$qty){ 
        if($qty>0){ 
            ReceiptItem::create(['receipt_id'=>$rec->id,'item_id'=>$item_id,'qty_received'=>$qty]); 
        } 
    }
    return redirect()->route('proc.pos.show',$po)->with('success','Barang diterima');
  }
}
