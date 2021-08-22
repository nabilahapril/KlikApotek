<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Obat;
use App\Models\Satuan;
use App\Models\Kategori;

class ObatController extends Controller
{
    public function index()
    {
        $satuan=Satuan::select('id','satuan')->get();
        $kategori=Kategori::select('id','kategori')->get();
        $data = Obat::join()->get();
        if(request()->ajax()){
            return datatables()->of($data)
            ->addColumn('aksi', function($data)
            {
                    $button = ' <button class="edit btn btn-warning" id="'.$data->id.'" name"edit" >Edit</button>';
                    $button .= ' <button class="hapus btn btn-danger" id="'.$data->id.'" name"hapus" > Hapus</button>';
                    return $button;
                
            })
            ->rawColumns(['aksi'])
            ->make(true);
        }
        return view('owner/ObatHome', compact('satuan','kategori'));
        
    }
    public function store(Request $request)
    {
        
        $simpan = Obat::create($request->all());
        if($simpan){
            return response()->json(['text'=>'Data Berhasil Disimpan'], 200);
        }
        else{
            return response()->json(['text'=>'Data Gagal Disimpan'], 422);
        }
    }
    public function edits(Request $request)
    {
        $data=Obat::find($request->id);
        return response()->json($data);
    }
    public function updates(Request $request)
    {
        $data=Obat::find($request->id);
        $simpan=$data->update($request->all());
        if($simpan){
            return response()->json(['text'=>'Data Berhasil Disimpan'], 200);
        }
        else{
            return response()->json(['text'=>'Data Gagal Disimpan'], 400);
        }
    }
    public function hapus(Request $request)
    {
        $data=Obat::find($request->id);
        $simpan=$data->delete($request->all());
        if($simpan){
            return response()->json(['text'=>'Data Berhasil Dihapus'], 200);
        }
        else{
            return response()->json(['text'=>'Data Gagal Dihapus'], 400);
        }
    }
}
