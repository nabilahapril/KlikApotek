<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Pembayaran extends Model
{
    use HasFactory;
    protected $fillable=[
        'nota',
        'totalharga',
        'diskon',
        'diBayar',
        'kembali',
    ];
    
}
