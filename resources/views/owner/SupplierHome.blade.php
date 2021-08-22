<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Supplier') }}
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <table class="table table-stripped " id="tabel" style="width: 100%">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Telepon</th>
                        <th>Email</th>
                        <th>Rekening</th>
                        <th>Alamat</th>
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
              <form action="{{('supplier.store')}}" method="post" id="forms">
              {{ csrf_field() }}
             
                <div class="form-group">
                    <label for="exampleInputPassword1">Nama Supplier</label>
                    <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Supplier">
                    <input type="text" hidden class="form-control" id="id" name="id" placeholder="Nama Supplier">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Telepon</label>
                    <input type="text" class="form-control" maxlength="12" onkeypress="return number(event)"  id="telp" name="telp" placeholder="No. Telp">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">E-Mail</label>
                    <input type="text" class="form-control" id="email" name="email" placeholder="Alamat Email">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">No. Rekening</label>
                    <input type="text" class="form-control" onkeypress="return number(event)" id="rekening" name="rekening" placeholder="Rekening">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Alamat</label>
                    <textarea name="alamat" class="form-control" id="alamat" cols="30" rows="10"></textarea>
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
                url : "{{route('supplier.index')}}"
            },
            columns: [
                { data: 'nama', name: 'nama'},
                { data: 'telp', name: 'telp'},
                { data: 'email', name: 'email'},
                { data: 'rekening', name: 'rekening'},
                { data: 'alamat', name: 'alamat'},
                { data: 'aksi', name: 'aksi', orderable: false},
            ]
        })
    }
    function number(evt){
        var charCode=(evt.which)?evt.which:event.keyCode
        if(charCode>31 && (charCode<48||charCode>57))
            return false;
        return true;
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
            },
            error:function(xhr){
                toastr.error(xhr.responseJSON.text, 'Gagal')
            }
        })
    })
    $(document).on('click', '.edit', function (){
        $('#forms').attr('action', "{{('supplier.updates')}}")
        let id=$(this).attr('id')
        $.ajax({
            url:"{{('supplier.edits')}}",
            type:'post',
            data:{
                id:id,
                _token:"{{csrf_token()}}"
            },
            success:function(res){
                console.log(res);
                $('#id').val(res.id)
                $('#nama').val(res.nama)
                $('#telp').val(res.telp)
                $('#alamat').val(res.alamat)
                $('#rekening').val(res.rekening)
                $('#email').val(res.email)
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
                    url:"{{('supplier.hapus')}}",
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