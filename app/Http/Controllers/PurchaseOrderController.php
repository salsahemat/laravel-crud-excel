<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PurchaseOrder;
use Illuminate\Support\Facades\Mail;

class PurchaseOrderController extends Controller
{
public function index(){ 
    $pos=PurchaseOrder::with('supplier')->latest()->paginate(10); 
    return view('pos.index',compact('pos')); 
}
  public function show(PurchaseOrder $po){ 
      $po->load('items.item','supplier'); 
      return view('pos.show',compact('po')); 
  }
public function submit(PurchaseOrder $po)
{
    if ($po->status !== 'draft') {
        return back()->with('error', 'Hanya PO berstatus DRAFT yang bisa di-submit.');
    }
    $po->update(['status' => 'submitted']);
    return back()->with('success', 'Submitted');
}

public function approve(PurchaseOrder $po)
{
    if ($po->status !== 'submitted') {
        return back()->with('error', 'Hanya PO berstatus SUBMITTED yang bisa di-approve.');
    }
    $po->update([
        'status' => 'approved',
        'approved_by' => auth()->id(),
        'approved_at' => now(),
    ]);
    return back()->with('success', 'Approved');
}

public function pdf(PurchaseOrder $po)
{
    if (!in_array($po->status, ['approved','emailed'])) {
        return back()->with('error', 'PO harus Approved sebelum diunduh.');
    }
    $po->load('items.item','supplier');
    $pdf = \PDF::loadView('pos.pdf', compact('po'));
    return $pdf->download("PO-{$po->po_num}.pdf");
}

public function csv(PurchaseOrder $po)
{
    if (!in_array($po->status, ['approved','emailed'])) {
        return back()->with('error', 'PO harus Approved sebelum di-export.');
    }
    $po->load('items.item');
    $filename = "PO-{$po->po_num}.csv";
    return response()->streamDownload(function() use($po) {
        $out = fopen('php://output', 'w');
        fputcsv($out, ['Item','Qty','Unit','Harga','Subtotal']);
        foreach ($po->items as $it) {
            fputcsv($out, [$it->item->name, $it->qty, $it->item->unit, $it->unit_price, $it->subtotal]);
        }
        fclose($out);
    }, $filename);
}

public function email(PurchaseOrder $po)
{
    if ($po->status !== 'approved') {
        return back()->with('error', 'PO harus Approved sebelum dikirim ke supplier.');
    }
    $po->load('supplier');
    if (!$po->supplier?->email) {
        return back()->with('error','Supplier belum punya email');
    }
    \Mail::raw("PO {$po->po_num} terlampir.", function($m) use ($po) {
        $m->to($po->supplier->email)->subject("Purchase Order {$po->po_num}");
    });
    $po->update(['status'=>'emailed']);
    return back()->with('success','PO terkirim');
}

}