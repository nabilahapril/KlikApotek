<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <table class="table table-stripped " id="tabel" style="width: 100%">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Kode</th>
                        <th>Dosis</th>
                        <th>Indikasi</th>
                        <th>Kategori</th>
                        <th>Satuan</th>
                        <th>Aksi</th>
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
              <form action="{{('obat.store')}}" method="post" id="forms">
              {{ csrf_field() }}
             
                <div class="form-group">
                    <label for="exampleInputPassword1">Nama Obat</label>
                    <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Obat">
                    <input type="text" hidden class="form-control" id="id" name="id" placeholder="Nama Obat">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Kode</label>
                    <input type="text" class="form-control" maxlength="8"  id="kode" name="kode" placeholder="Kode">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Dosis</label>
                    <input type="text" class="form-control" id="dosis" name="dosis" placeholder="Dosis">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Indikasi</label>
                    <input type="text" class="form-control" id="indikasi" name="indikasi" placeholder="Indikasi">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Kategori</label>
                    <select name="kategori" id="kategori" class="form-control">
                        <option value="">Pilih Kategori</option>
                        @foreach($kategori as $item)
                            <option value="{{$item->id}}">{{$item->kategori}}</option>
                        @endforeach
                    </select> 
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Satuan</label>
                    <select name="satuan" id="satuan" class="form-control">
                        <option value="">Pilih Satuan</option>
                        @foreach($satuan as $item)
                            <option value="{{$item->id}}">{{$item->satuan}}</option>
                        @endforeach
                    </select> 
                </div>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" name="batal" id="btn-tutup" class="btn btn-outline-light" data-dismiss="modal">Close</button>
              <button type="submit" id="simpan" class="btn btn-outline-light">Save</button>
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
        loaddata()
        
    })
    function loaddata() {
        $('#tabel').DataTable({
            serverside: true,
            processing: true,
            language:{
                url:"{{asset('js/bahasa.json')}}"
            },
            ajax: {
                url : "{{route('obat.index')}}"
            },
            columns: [
                { data: 'nama', name: 'nama'},
                { data: 'kode', name: 'kode'},
                { data: 'dosis', name: 'dosis'},
                { data: 'indikasi', name: 'indikasi'},
                { data: 'kategoris', name: 'kategoris'},
                { data: 'satuans', name: 'satuanS'},
                { data: 'aksi', name: 'aksi', orderable: false},
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
                $('#forms')[0].reset();
                toastr.success(res. text, 'Sukses')
            },
            error:function(xhr){
                toastr.error(xhr.responseJSON.text, 'Gagal')
            }
        })
    })
    $(document).on('click', '.edit', function (){
        $('#forms').attr('action', "{{('obat.updates')}}")
        let id=$(this).attr('id')
        $.ajax({
            url:"{{('obat.edits')}}",
            type:'post',
            data:{
                id:id,
                _token:"{{csrf_token()}}"
            },
            success:function(res){
                console.log(res);
                $('#id').val(res.id)
                $('#nama').val(res.nama)
                $('#kode').val(res.kode)
                $('#indikasi').val(res.indikasi)
                $('#dosis').val(res.dosis)
                $('#satuan').val(res.satuan)
                $('#kategori').val(res.kategori)
                $('#btn-tambah').click()
            },
            error:function(xhr){
                console.log(xhr);
            }
        })
    })
    $(document).on('click', '.hapus', function(){
        let id=$(this).attr('id')
        Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                    url:"{{('obat.hapus')}}",
                    type:'post',
                    data:{
                        id:id,
                        _token:"{{csrf_token()}}"
                    },
                    success:function(res, status){
                        if(status='200'){
                            setTimeout(() => {
                                Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: 'Data Berhasil Dihapus',
                                showConfirmButton: false,
                                timer: 1500
                                }).then((res)=>{
                                     $('#tabel').DataTable().ajax.reload()
                                })
                            });
                        }
                    },
                    error:function(xhr){
                        Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Gagal Menghapus',
                        footer: '<a href="">Why do I have this issue?</a>'
                        })
                    }
                })
        }
        
    })
    })
</script>