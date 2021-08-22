
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Cetak Nota') }}
        </h2>
    </x-slot>
    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="box-body"><center>
            <form action="/cetaknota" method="GET" target="...blank">
		  <div class="input-group">
    <input type="text" class="form-control" autocomplete="off" name ="cari" placeholder="Masukkan No Kwitansi" value="{{ old('cari') }}">
    <div class="input-group-append">
      <button class="btn btn-secondary" type="button" >
        <i class="fa fa-search"></i>
      </button>
    </div>
  </div>
	</form>
    
</x-app-layout>
@push('js')
<script src={{asset("plugins/datatables/jquery.dataTables.js")}}></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.2/dist/sweetalert2.all.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script>

</script>