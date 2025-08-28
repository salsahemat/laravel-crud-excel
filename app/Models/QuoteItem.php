<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuoteItem extends Model
{
    protected $fillable = ['quote_id', 'item_id', 'price', 'pack_info'];
    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}
