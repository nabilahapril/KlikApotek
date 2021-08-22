<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Pembelian extends Model
{
    use HasFactory;
    protected $fillable=[
        'faktur',
        'tanggal',
        'qty',
        'supplier',
        'kodeobat',
        'harga',
        'total',
        'keterangan',
    ];
    public static function join (){
        $data=DB::table('pembelians')
        ->join('suppliers','suppliers.id','pembelians.supplier')
        ->select('pembelians.*','suppliers.nama as suppliers');
        return $data;
    }
}
