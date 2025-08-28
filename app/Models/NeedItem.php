<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NeedItem extends Model
{
    protected $fillable = ['need_id', 'item_id', 'qty'];
    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}
