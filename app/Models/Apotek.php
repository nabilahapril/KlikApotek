<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Apotek extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama',
        'telp',
        'emailapotek',
        'rekening',
        'alamat',
        'direktur',
        'balance',
        'logo',
    ];
}
