<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Stock Obat') }}
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <table class="table table-stripped " id="tabel" style="width: 100%">
                <thead>
                    <tr>
                        <th>No</th>
                    <th>Nama Obat</th>
                        <th>Harga Beli</th>
                        <th>Harga Jual</th>
                        <th>Stock</th>
                        <th>Keterangan</th>
                        <th>Update Terakhir</th>
                        <th>Admin</th>
                    </tr>
                </thead>
            </table>
            </div>
        </div>
        <button type="button" id="btn-tambah" class="btn btn-info" data-toggle="modal" data-target="#modal-info">
                  Tambah
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
              <form action="{{('stock.store')}}" method="post" id="forms">
              {{ csrf_field() }}
                <div class="form-group">
                    <label for="exampleInputPassword1">Nama Obat</label>
                    <select class="cusstom-select mr-sm-2 js-example-basic-single form-control form-control"name="obat" id="obat" >
                        <option value="">Pilih Obat</option>
                        @foreach($obat as $item)
                            <option value="{{$item->id}}">{{$item->nama}}</option>
                        @endforeach
                    </select> 
                </div>
                <div>
                   STOCK OBAT
                    <hr style="border:1px solid red;"/>
                </div>
                <div class="row">
                <div class="form-group col-md-4">
                    <label for="exampleInputPassword1">Stock Awal</label>
                    <input type="text" class="form-control"  readonly onkeypress="return isNumberKey(event)" id="stockLama" name="stockLama" value="0" />
                </div>

                <div class="form-group form-group col-md-4">
                    <label for="exampleInputPassword1">Masuk</label>
                    <input type='text' class='form-control' onkeypress="return isNumberKey(event)"  id="masuk" name="masuk" value="0" class="form-control" />
                </div>
                <div class="form-group form-group col-md-4">
                    <label for="exampleInputPassword1">Keluar</label>
                    <input type='text' name="keluar" class='form-control' onkeypress="return isNumberKey(event)"  id="keluar" class="form-control"/>
                </div>
            </div>
            <div class="form-group">
                    <label for="inlineForm">Stock Akhir</label>
                    <input type='text' class='form-control'  readonly  onkeypress="return isNumberKey(event)" id="stock" name="stock"  class="form-control"/>
                </div>
                <div>
                   STOCK OBAT
                    <hr style="border:1px solid red;">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Harga Beli</label>
                    <input type="text" class="form-control"  onkeypress="return isNumberKey(event)"  id="beli" name="beli" >
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Harga Jual</label>
                    <input type="text" class="form-control"  onkeypress="return isNumberKey(event)"  id="jual" name="jual" >
                </div>
                <div class="form-group ">
                    <label for="exampleInputPassword1">Tanggal Expired</label>
                    <input type="text" class="form-control"    id="expired" name="expired" >
                </div>
                <div class="form-group ">
                    <label for="exampleInputPassword1">Keterangan</label>
                    <input type="text" class="form-control"   id="keterangan" name="keterangan" >
                </div>
                <button type="submit" id="simpan" class="btn btn-outline-light btn-success btn-block">Simpan</button>
            <div class="modal-footer justify-content-between">
              <button type="button" name="batal" id="btn-tutup" class="btn btn-outline-light" data-dismiss="modal">Close</button>
            </div>
        </form>
          </div>
        </div>
    
      </div>
     
</x-app-layout>
@stack('js')
<script src={{asset("plugins/datatables/jquery.dataTables.js")}}></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.2/dist/sweetalert2.all.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script>
    $(document).ready(function()
    {
        loadData()
    })
    
    function loadData() {
        $('#tabel').DataTable({
            serverside: true,
            processing: true,
           
            ajax: {
                url : "{{route('stock.index')}}"
            },
            columns: [
                {
                    data:null,
                    "sortable":false,
                    render:function(data, type, row, meta){
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                { data: 'namaObat', name: 'namaObat'},
                { data: 'beli', name: 'beli'},
                { data: 'jual', name: 'jual'},
                { data: 'stock', name: 'stock'},
                { data: 'keterangan', name: 'keterangan'},
                { data: 'updated_at', name: 'updated_at'},
                { data: 'admins', name: 'admins'},
            ]
        })
    }
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
                $('#btn-tutup').click()
                $('#tabel').DataTable().ajax.reload()
                toastr.success(res. text, 'Sukses')
                $('forms')[0].reset()
                
            },
            error:function(xhr){
                toastr.error(xhr.responseJSON.text, 'Gagal')
            }
        })
    })
    function isNumberKey(evt){
        var charCode=(evt.which)?evt.which:event.keyCode
        if(charCode>31 && (charCode<48||charCode>57))
            return false;
        return true;
    }
    
    $(document).on('change','#obat', function(){
        let id=$(this).val()
        $.ajax({
            url:"{{route('getObat')}}",
            type:'post',
            data:{
                id:id,
                _token:"{{csrf_token()}}"
            }, success: function(res){
                $('#stockLama').val(res.data.stock)
                console.log(res);
                
            },
            error:function(xhr){
                console.error(xhr);
            }
        })
    })
    $(document).on('blur','#masuk', function(){
  
        let stockLama = $('#stockLama').val();
        let masuk=$('#masuk').val();
        let keluar=$('#keluar').val();
        let akhir=(stockLama + masuk)-keluar
        $('#stock').val(akhir)
    })
    $(document).on('blur','#keluar', function(){
 
        let stockLama = $('#stockLama').val();
        let masuk=$('#masuk').val();
        let keluar=$('#keluar').val();
        let akhir=(stockLama + masuk)-keluar
        $('#stock').val(akhir)
    })
    
    
    
</script>