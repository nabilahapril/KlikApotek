<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use\App\Models\Obat;
use\App\Models\Pasien;
use\App\Models\StockObat;
use\App\Models\Penjualan;
use\App\Models\Pembayaran;
use GrahamCampbell\ResultType\Result;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class PembayaranController extends Controller
{
    public function store(Request $request){
        $simpan = Pembayaran::create($request->all());
    }
}
