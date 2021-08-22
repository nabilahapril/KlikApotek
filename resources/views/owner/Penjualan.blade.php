
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Penjualan') }}
        </h2>
    </x-slot>
    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
    <div class="row">
          
          <div class="col-md-4">
            
            <div class="card card-danger">
              <div class="card-header">
                <h3 class="card-title">Data Customer</h3>
              </div>
              <hr style="border: 1px solid red;">
              <form action="{{('penjualan.store')}}" method="post" id="forms">
              {{ csrf_field() }}
                  <div class="form-group">
                    <label for="exampleInputEmail1">Nama Pasien</label>
                    <input type="text" class="form-control" id="nama" placeholder="Nama" name="nama">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Nomor Telepon</label>
                    <input type="text" class="form-control" onkeypress="return isNumberKey(event)" id="telp" name="telp" placeholder="No Telepon">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Alamat</label>
                    <textarea class="form-control" id="alamat" name="alamat" placeholder="Alamat" cols="30" rows="5"></textarea>
                  </div>
                  <hr style="border: 1px solid red;">
                  <div class="col-12">
                    <div class="row">
                      <div class="form-group col-6">
                      <label for="exampleInputPassword1">Nomor Resep</label>
                      <input type="text" class="form-control" id="resep" name="resep" placeholder="Isi Jika Ada Resep">
                      </div>
                      <div class="form-group col-6">
                      <label for="exampleInputPassword1">Pengirim</label>
                      <input type="text" class="form-control" id="pengirim" name="pengirim" placeholder="Isi Jika Ada Resep">
                      </div>
                      
                        </div>
                        <hr style="border: 1px solid red;">
                        </div>
                        
</div>
</div>

<div class="col-md-8">
            
            <div class="card card-danger">
              <div class="card-header">
                <h3 class="card-title">Data Pembelian</h3>
              </div>
              <div class="row">
                  <div class="form-group col-3">
                    <label>Obat</label>
                     <select class="custom-select mr-sm-2 js-example-basic-single form-control" id="obat" name="obat">
                     <option value="">Pilih</option>
                     @foreach($obat as $item)
                     <option value="{{$item->idObat}}">{{$item->namaObat}}</option>
                     @endforeach
                      </select>
                  </div>
                  <div class="form-group col-3">
                    <label >Stock Tersedia</label>
                    <input type="text" class="form-control" id="stock" name="stock" readonly>
                  </div>
                  <div class="form-group col-3">
                    <label >No Kwitansi</label>
                    <input type="text" class="form-control" id="nota" name="nota" readonly value="{{$nomer}}">
                  </div>
                  <div class="form-group col-3">
                    <label >Tanggal</label>
                    <input type="text" class="form-control" id="tanggal" name="tanggal" readonly value="{{$tanggals}}">
                  </div>
              </div>
              <div class="row">
                  <div class="form-group col-3">
                    <label>Jumlah Pembelian</label>
                    <input type="text" class="form-control" onkeypress="return isNumberKey(event)" id="qty" name="qty" >
                  </div>
                  <div class="form-group col-3">
                    <label >Harga Satuan</label>
                    <input type="text" class="form-control" id="harga" name="harga" readonly onkeypress="return isNumberKey(event)" >
                  </div>
                  <div class="form-group col-3">
                    <label >Diskon</label>
                    <input type="text" class="form-control" id="diskon" name="diskon">
                  </div>
                  <div class="form-group col-3">
                    <label >Total Harga</label>
                    <input type="text" class="form-control" id="subTotal" name="subTotal" readonly onkeypress="return isNumberKey(event)">
                  </div>
              </div>
              <hr style="border: 1px solid red;">
              <div>
              <button type="submit" id="tambah" name="tambah" class="btn btn-success">Simpan</button>
</form>
              <button type="submit" id="buka" name="buka" class="btn btn-primary">Tambah Obat</button>
</div>
<div>
<br><br>
<div class="card card-danger table-responsive">
<table class="table table-bodered table-stripped table-sm " id="tabel" style="width: 100%">
                <thead>
                    <tr>
                        <th>No</th>
                      <th>Nama Obat</th>
                        <th>QTY</th>
                        <th>Harga</th>
                        <th>Total Harga</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
            </table>
</div>
<div class="row">
<div class="col-3">
 
</div>
<div class="col-3">
<button type="button" id="btn-bayar" class="btn btn-info" data-toggle="modal" data-target="#modal-info">
                  Proses
        </button>
</div>
<div class="modal fade" id="modal-info">
        <div class="modal-dialog">
          <div class="modal-content bg-info">
            <div class="modal-header">
              <h4 class="modal-title">Info Modal</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
            <div>
                   FORM PEMBAYARAN
                    <hr style="border:1px solid red;"/>
                </div>
                <form action="{{('simpanPenjualan')}}" method="post" id="forms">  
              {{ csrf_field() }}
              <div class="row">
                <div class="col-6">
                <label for="exampleInputPassword1">Nota Penjualan</label>
                    <input type="text" class="form-control"  onkeypress="return isNumberKey(event)" id="nota" name="nota" readonly value="{{$nomer}}" >
                </div>
                <div class="col-6">
                    <label for="label-warning">Kasir : {{Auth::user()->name}} </label>
                </div>
              </div>
              
                <div class="form-group">
                    <label for="exampleInputPassword1">Total Harga</label>
                    <input type="text" class="form-control" onkeypress="return isNumberKey(event)" readonly autocomplete="off" id="totalharga" name="totalharga" onkeypress="return isNumberKey(event)">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Diskon</label>
                    <input type="text" class="form-control" readonly onkeypress="return isNumberKey(event)" id="modalDiskon" name="modalDiskon" maxlength="3" value=0>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Harga Yang Harus Dibayar</label>
                    <input type="text" name="yangHarus" readonly onkeypress="return isNumberKey(event)" class="form-control" id="yangHarus" >
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Bayar</label>
                    <input type="text" name="diBayar"  onkeypress="return isNumberKey(event)" class="form-control" id="diBayar" >
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Kembalian</label>
                    <input type="text" name="kembali"  onkeypress="return isNumberKey(event)"  id="kembali" disabled class="form-control" >
                </div>
                <button type="button" id="simpanBayar" class="btn btn-outline-light btn-success btn-block">Bayar</button>
            </div>
            
            <div class="modal-footer justify-content-between">
              <button type="button" id="tutup2" class="btn btn-outline-light" data-dismiss="modal">Batal</button>
    
            </div>
        </form>
          </div>
</x-app-layout>
@push('js')
<script src={{asset("plugins/datatables/jquery.dataTables.js")}}></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.2/dist/sweetalert2.all.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script>
 $(document).ready(function()
    {
        $('#obat')
        
        $('#transaksiBaru').hide()
    })
 
    $('#tabel').DataTable({
            serverside: true,
            processing: true,
           
            ajax: {
                url : "{{route('penjualan.dataTable')}}",
                data:{
                  id:$('#nota').val()
                }
            },
            columns: [
                {
                    data:null,
                    "sortable":false,
                    render:function(data, type, row, meta){
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                { data: 'nama_obat', name: 'nama_obat'},
                { data: 'qty', name: 'qty'},
                { data: 'jual', name: 'jual'},
                { data: 'subTotal', name: 'subTotal'},
                { data: 'aksi', name: 'aksi', orderable: false},
            ]
        })

    function isNumberKey(evt){
        var charCode=(evt.which)?evt.which:event.keyCode
        if(charCode>31 && (charCode<48||charCode>57))
            return false;
        return true;
    }
    
    $('#obat').change (function(){
        let id=$(this).val()
        $.ajax({
            url:"{{route('getDataObat')}}",
            type:'post',
            data:{
                id:id,
                _token:"{{csrf_token()}}"
            }, success: function(res){
                console.log(res);
                $('#harga').val(res.jual)
                $('#stock').val(res.stock)
            }
        })
    })
    $(document).on('blur','#qty', function(){
      let harga=$('#harga').val();
        let qty=$('#qty').val();
        let stock=$('#stock').val();
        let akhir= stock-qty
        $('#subTotal').val(qty*harga)
        $('#stock').val(akhir)
    })
    
    $(document).on('submit', 'form', function (event){
      
      event.preventDefault();
      $.ajax({
          url: $(this).attr('action'),
          type: $(this).attr('method'),
          typeData:"JSON",
          data : new FormData(this),
          processData:false,
          contentType:false,
          success:function(res){
              console.log(res);
              $('#obat').prop('disabled', true);
              $('#qty').attr('disabled', true);
              $('#diskon').attr('disabled', true);
              $('#tambah').hide()
              $('#tabel').DataTable().ajax.reload()
              toastr.success(res. text, 'Sukses')
             
              
          },
          error:function(xhr){
              toastr.error(xhr.responseJSON.text, 'Gagal')
          }
      })
  })
  

    $(document).on('click','.hapus',function(){
      let id=$(this).attr('id')
      $.ajax({
        url:"{{route('penjualan.hapusOrder')}}",
        type:'post',
        data:{
                id:id,
                _token:"{{csrf_token()}}"
        },
        success: function(res){
          toastr.success(res.text,'Sukses')
          $('#tabel').DataTable().ajax.reload()
        },
        error:function(xhr){
          toastr.error(xhr.responseJSON.text,'Gagal')
        }
      })
    })
    $('#buka').click(function(){
      $('#tambah').show()
      $('#obat').prop('disabled', false);
      $('#qty').attr('disabled', false)
      $('#qty').val(null)
      $('#diskon').val(null)
      $('#diskon').attr('disabled', false)
    })
    $('#btn-bayar').click(function(){
      console.log('asdasd');
      let id=$('#nota').val()
      $.ajax({
        url:"{{route('hitung')}}",
        type:'post',
        data:{
          id:id,
          _token:"{{csrf_token()}}"
        },
        success:function(res){
          console.log(res);
          $('#totalharga').val(res.data[0].totalharga)
          $('#yangHarus').val(parseInt(res.data[0].totalharga)-parseInt(res.diskon))
          $('#modalDiskon').val(res.diskon)
          $('#nota').val(res.data[0].nota)
        }
      })
    })
   $(document).on('blur','#diBayar',function(){
     let a = parseInt($('#yangHarus').val())
     let b = $(this).val()
     let c = b- a
     if(c<0)
     {
        toastr.info('periksa Inputan', 'Info')
        $('#simpanBayar').hide()
     }else{
      $('#kembali').val(c)
      $('#simpanBayar').show()
     }
   })
   $('#simpanBayar').click(function(){
     $.ajax({
       url:"{{route('simpanPenjualan')}}",
       type:'post',
       data:{
         kembali:$('#kembali').val(),
         totalharga:$('#totalharga').val(),
         diskon:$('#modalDiskon').val(),
         diBayar:$('#diBayar').val(),
         nota:$('#nota').val(),
         kembali:$('#kembali').val(),
         _token:"{{csrf_token()}}"
       },
       success:function(res){
         toastr.success(res.text,'Sukses')
         $('#tutup2').click()
         $('#tambah').hide()
         $('#cetak').show()
         $('#transaksi').show()
       }
     })
   })
</script>