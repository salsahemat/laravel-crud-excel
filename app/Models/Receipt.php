<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Receipt extends Model
{
    protected $fillable = ['purchase_order_id','received_by','received_at'];
    public function items()
    {
        return $this->hasMany(ReceiptItem::class);
    }
}
