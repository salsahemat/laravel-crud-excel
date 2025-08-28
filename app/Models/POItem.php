<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class POItem extends Model
{
    protected $table='p_o_items';
    protected $fillable = ['purchase_order_id', 'item_id', 'qty', 'unit_price', 'subtotal'];
    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}
