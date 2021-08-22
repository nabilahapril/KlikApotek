
<html>
<head>
	<title>Document</title>
	
</head>
<body>
    <div class="container">
        <center><h1 >APOTEK SUMBER SEHAT</h1></center>
        <p style="font-size:18px;text-align:center">Jl. Mahar Martanegara No.166, Baros, Kec. Cimahi Sel., Kota Cimahi, Jawa Barat 40533</p>
        <hr style="border:1px solid blue;">

        <div class="row">
            <div>
                <table style="width:60% font-size:15px " >
                <tr > <td width="200px">No Kwitansi</td>
                <td>:</td>
                <td>{{$data[0]->nota}}</td></tr>
                <tr><td width="100px">Nama</td>
                <td width="15px">:</td>
                <td>{{$data[0]->customer}}</td></tr>
                <tr ><td width="200px">Telepon</td>
                <td>:</td>
                <td>{{$data[0]->telp}}</td></tr>
                <tr><td width="200px">Alamat</td>
                <td>:</td>
                <td>{{$data[0]->alamat}}</td></tr>
                <tr><td width="200px">Tanggal</td>
                <td>:</td>
                <td>{{$data[0]->tanggal}}</td></tr>
                <tr><td width="200px">Kasir</td>
                <td>:</td>
                <td>{{Auth::user()->name}}</td></tr>
                
                </table>
            </div>
        </div>
        <br>
        
        <div>
        <hr style="border:1px solid blue;">
            <table style="width:100%; ">
            <tr >
            
                <td>Nama Barang</td>
                <td>QTY</td>
                <td>Harga Satuan</td>
                <td>Jumlah</td>
               
            </tr>
            
            @foreach($data as $item)
            
            <tr>
                <td>{{$item->nama_obat}}</td>
                <td>{{$item->qty}}</td>
                <td>{{$item->jual}}</td>
                <td>{{$item->subTotal}}</td>
            </tr>
            @endforeach
        </table>
        
        <p >Total Harga: {{$penjualans}}</p>
        </div>    
</div>
</div>

</body>
</html>