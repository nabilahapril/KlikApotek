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
use App\Exports\PembayaranExport;
use Maatwebsite\Excel\Facades\Excel;
use PDF;

class PenjualanController extends Controller
{
    public function index(){
        
       $obat=Obat::joinStock();
        $tanggals=Carbon::now()->format('Y-m-d');
        $now=Carbon::now();
        $thnBulan=$now->year.$now->month;
        $cek=Penjualan::count();
        if($cek==0){
            $urut=10000001;
            $nomer='NT'.$thnBulan.$urut;
        }else{
            $ambil=Penjualan::all()->last();
            $urut=(int)substr($ambil->nota, -8)+1;
            if((int)substr($ambil->nota, -8)==99999999)
            {
                $urut=10000001;
            }
            $nomer='NT'.$thnBulan.$urut;

        }
        return view('owner.Penjualan', compact( 'obat','tanggals','nomer'));
    }
    public function store(Request $request){
        $rules=[
            "nama"=>'required',
            "telp"=>'required',
            "obat"=>'required',
            "qty"=>'required',
            "alamat"=>'required',
        ];
    
        $text=[
            'nama.required'=>'Kolom nama tidak boleh kosong',
            'telp.required'=>'Kolom telepon tidak boleh kosong',
            'obat.required'=>'Kolom obat tidak boleh kosong',
            'alamat.required'=>'Kolom alamat tidak boleh kosong',
            'qty.required'=>'Kolom qty tidak boleh kosong',
            
        ];
        $validasi=Validator::make($request->all(),$rules,$text);
        if($validasi->fails()){
            return response()->json(['success'=>0,'text'=>$validasi->errors()->first()], 422);
        }
        $pasien=[
            'nama'=>$request->nama,
            'telp'=>$request->telp,
            'alamat'=>$request->alamat,
            'resep'=>$request->resep,
            'pengirim'=>$request->pengirim,
        ];
        $consumer=Pasien::create($pasien);
        $idPasien=$consumer->id;
        $penjualan=[
            'nota'=>$request->nota,
            'tanggal'=>$request->tanggal,
            'qty'=>$request->qty,
            'diskon'=>$request->diskon,
            'subTotal'=>$request->subTotal,
            'item'=>$request->obat,
            'consumer'=>$idPasien,
            'kasir'=>Auth::user()->id,
        ];
        $transaksi=Penjualan::create($penjualan);
        if($transaksi){
            $stock=StockObat::where('idObat',$request->obat)->first();
            $stock->update(['stock'=>$request->stock]);
            return response()->json(['text'=>'Pembelian DItambahkan'], 200);
        }else{
            return response()->json(['text'=>'Pembelian DItambahkan'], 422);
        }
    }
    public function dataTable(Request $request)
    {
        $nota=$request->id;
        $data=Penjualan::join()
        ->where('penjualans.nota', $nota)
        ->latest();
        if(request()->ajax()){
            return datatables()->of($data)
            ->addColumn('aksi', function($data)
            {
                    $button= ' <button class="hapus btn btn-danger" id="'.$data->id.'" name"hapus" > Hapus</button>';
                    return $button;
                
            })
            ->rawColumns(['aksi'])
            ->make(true);
        }
    }
    // @param mixed $request
    // @return void
    public function hapus(Request $request){
        $id=$request->id;
        $hapusJual=Penjualan::find($id);
        $stock=StockObat::where('idObat',$hapusJual->item)->first();
        $tambah=$hapusJual->qty + $stock->stock;
        $stock->update(['stock'=>$tambah]);
        if($stock){
            $hapus=$hapusJual->delete();
            return response()->json(['text'=>'Data Berhasil Dikurangi'],200);
        }else{
            return response()->json(['text'=>'Data Gagal Dikurangi'],500);
        }
        
    }
    public function hitung(Request $request){
        $id=$request->id;
        $data=Penjualan::hitung($id)->get();
        $datas=Penjualan::where('nota', $id)->get();
        $discount=[];
        foreach($datas as $key)
        {
            array_push($discount,($key->diskon/100*$key->subTotal));
        }
        $diskon=array_sum($discount);
        return response()->json(['data'=>$data, 'diskon'=>$diskon], 200);
    }
    // * @param mixed $request
    // * @return void
    public function cetak()
	{
		return view('owner.Cetak');
	}
    public function cetakNota(Request $request)
	{
       
		$cari = $request->cari;
        
		$data=Penjualan::joinCetak()
		->where('nota','like',"%".$cari."%")
		->paginate();
        $penjualans=Penjualan::where('nota','like',"%".$cari."%")
        ->sum('subTotal');
		$pdf = PDF::loadview('owner.cetakNota',compact('data','penjualans'));
    	return $pdf->stream();
 
	}
    public function datajual()
    {
        $data = Pembayaran::all();
        if(request()->ajax()){
            return datatables()->of($data)
            ->addColumn('aksi', function($data)
            {
                    $button = ' <button  hidden id="detail" class="btn btn-info" data-toggle="modal" data-target="#modal-info">Detail</button>';
                    
                    return $button;
                
            })
            ->rawColumns(['aksi'])
            ->make(true);
        }
        return view('owner.DataPenjualan');
    }
    public function export_excel()
	{
		return Excel::download(new PembayaranExport, 'pembayaran.xlsx');
	}
   
}
