<?php

namespace App\Http\Controllers;
use App\Models\Pembelian;
use App\Models\Supplier;
use App\Models\Obat;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class PembelianController extends Controller
{
    public function index()
    {
        $supplier=Supplier::select('id','nama')->get();
        $data = Pembelian::join()->get();
        $tanggal=Carbon::now()->format('Y-m-d');
        $now=Carbon::now();
        $thnBulan=$now->year.$now->month;
        $cek=Pembelian::count();
        if($cek==0){
            $urut=10000001;
            $nomer='FKTR'.$thnBulan.$urut;
        }else{
            $ambil=Pembelian::all()->last();
            $urut=(int)substr($ambil->faktur, -8)+1;
            if((int)substr($ambil->faktur, -8)==99999999)
            {
                $urut=10000001;
            }
            $nomer='FKTR'.$thnBulan.$urut;

        }
        return view('owner.Pembelian', compact('tanggal','nomer','supplier'));
    }
    public function store(Request $request)
    {
        
        $simpan = Pembelian::create($request->all());
        if($simpan){
            return response()->json(['text'=>'Data Berhasil Disimpan'], 200);
        }
        else{
            return response()->json(['text'=>'Data Gagal Disimpan'], 422);
        }
    }
    public function dataTable(Request $request)
    {
        $faktur=$request->id;
        $data=Pembelian::join()
        ->where('pembelians.faktur', $faktur)
        ->latest();
        if(request()->ajax()){
            return datatables()->of($data)
            ->addColumn('aksi', function($data)
            {
                    $button= ' <button class="hapus btn btn-danger" hidden id="'.$data->id.'" name"hapus" > Hapus</button>';
                    return $button;
                
            })
            ->rawColumns(['aksi'])
            ->make(true);
        }
    }
}
