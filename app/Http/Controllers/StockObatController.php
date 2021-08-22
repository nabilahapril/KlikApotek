<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\StockObat;
use App\Models\Obat;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StockObatController extends Controller
{
    public function index()
    {
        $obat=Obat::where('ready', 'N')->get();
        $stock=StockObat::join()->get();
        if(request()->ajax()){
            return datatables()->of($stock)
            ->addColumn('aksi', function($stock)
            {
                    $button = ' <button class="edit btn btn-warning" hidden id="'.$stock->id.'" name"edit" >Edit</button>';
                    $button .= ' <button class="hapus btn btn-danger" hidden id="'.$stock->id.'" name"hapus" > Hapus</button>';
                    return $button;
                
            })
            ->rawColumns(['aksi'])
            ->make(true);
        }
        return view('owner/StockObat', compact('obat'));
        
    }
    public function store(Request $request)
    {
        $data=new StockObat();
        $data->idObat=$request->obat;
        $data->masuk=$request->masuk;
        $data->jual=$request->jual;
        $data->keluar=$request->keluar;
        $data->beli=$request->beli;
        $data->stock=$request->stock;
        $data->expired=$request->expired;
        $data->keterangan=$request->keterangan;
        $data->admin=Auth::user()->id;
        $simpan= $data->save();
        if($simpan){
            DB::table('obats')->where('id', $request->obat)->update(['ready'=>'Y']);
            return response()->json(['text'=>'Data Berhasil Disimpan'], 200);
        }else{
            return response()->json(['text'=>'Data Gagal Disimpan'], 400);
        }
    }
    public function getObat(Request $request)
    {
        $data=StockObat::where('idObat', $request->id)->first();
        $null=[
            'stock'=>0
        ];
        if($data!=null){
            return response()->json(['data'=>$data]);
        }
        else{
            return response()->json(['data'=>$null]);
        }
        
    }
    
    public function updates(Request $request)
    {
        $data=StockObat::find($request->id);
        $datas=$this->data($request->all());
        $simpan=$data->update($datas);
        if($simpan){
            return response()->json(['text'=>'Data Berhasil Disimpan'], 200);
        }
        else{
            return response()->json(['text'=>'Data Gagal Disimpan'], 500);
        }
    }
    private function data(array $data)
    {
        $data=[
            'idObat'=>$data['obat'],
            'masuk'=>$data['masuk'],
            'keluar'=>$data['keluar'],
            'jual'=>$data['jual'],
            'beli'=>$data['beli'],
            'expired'=>$data['expired'],
            'stock'=>$data['stock'],
            'keterangan'=>$data['keterangan'],
            'admin'=>Auth::user()->id,
        ];
        return $data;
    }
    public function getDataObat(Request $request)
    {
        $data=StockObat::where('idObat', $request->id)->first();
        return response()->json($data);
    }
}
