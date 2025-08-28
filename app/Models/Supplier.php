<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $fillable = ['name', 'contact_name','phone', 'email', 'address'];
    public function quotes()
    {
        return $this->hasMany(Quote::class);
    }
}
