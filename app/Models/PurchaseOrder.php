<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PurchaseOrder extends Model
{
    protected $fillable = ['po_num','supplier_id','need_id','shipping_method','payment_method','status','approved_by','approved_at'];
     public function items()
    {
        return $this->hasMany(POItem::class);
    }
    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
   
}
