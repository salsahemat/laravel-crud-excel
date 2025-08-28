<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $table = 'table_b';

    protected $fillable = [
        'kode_toko',
        'nominal_transaksi'
    ];

    public $timestamps = false;


    protected $primaryKey = 'kode_toko';
    public $incrementing = false; 
}
