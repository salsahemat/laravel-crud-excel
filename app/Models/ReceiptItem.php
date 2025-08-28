<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReceiptItem extends Model
{
    protected $fillable = ['receipt_id', 'item_id', 'qty_received'];
    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}
