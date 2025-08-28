<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Need extends Model
{
    protected $fillable = ['uploaded_by'];
    public function items()
    {
        return $this->hasMany(NeedItem::class);
    }
}
