<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Penjualan') }}
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <table class="table table-stripped " id="tabel" style="width: 100%">
                <thead>
                    <tr>
                        <th>No Kwitanasi</th>
                        <th>Total Harga</th>
                        <th>Diskon</th>
                        <th>Bayar</th>
                        <th>Kembali</th>
                        <th hidden>Aksi</th>
                    </tr>
                </thead>
            </table>
            </div>
            <a href="export_excel" class="btn btn-success my-3" target="_blank">Export Excel</a>
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
            ajax: {
                url : "{{route('penjualan.datajual')}}"
            },
            columns: [
                { data: 'nota', name: 'nota'},
                { data: 'totalharga', name: 'totalharga'},
                { data: 'diskon', name: 'diskon'},
                { data: 'diBayar', name: 'diBayar'},
                { data: 'kembali', name: 'kembali'},
                { data: 'aksi', name: 'aksi', orderable: false},
            ]
        })
    }
    
  
</script>