<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Menu</title>
    <style>
        #header { position: relative; border-collapse: collapse; }
        #header img { width: 100%;}
        #header tr td h4 { font-size: 22px; margin: 0; padding: 0; text-align: center;}
        #header tr td p { font-size: 18px; margin: 0; padding: 0; text-align: center;}
        h3 { margin: 5px 0 15px 0; padding: 5px 0; border-top: 1px solid #000; border-bottom: 1px solid #000;}
        #data { position: relative; border-collapse: collapse; border: 1px solid #000;}
        #data thead { background-color: burlywood;}
        #data thead tr th,#data tbody tr td { padding: 5px; text-align: center; color: #000; font-family: Arial; border: 1px solid #000; }
        #data tbody tr td { text-align: left; }
        #data tbody tr td.right { text-align: right; }
    </style>
</head>
<body>
    <table id="header" width="100%">
        <tr>
            <td width="10%">
                <img src="{{ asset('images/logo-cafe.png') }}" alt="Logo">
            </td>
            <td width="90%">
                <h4 >SENJA COFFE</h4>
                <p >Jalan Kelapa Manis No.12 Madiun</p>
            </td>
        </tr>
    </table>
    <h3>Laporan Data Menu</h3>
    <table id="data" width="100%">
        <thead>
            <tr>
                <th width="5px">No.</th>
                <th>Kode Menu</th>
                <th>Nama</th>
                <th>Kategori</th>
                <th>Harga</th>
                <th>Stok</th>
                <th>Satuan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($rsMenu as $menu)
                <tr>
                    <td>{{$no++}}</td>
                    <td>{{ $menu->kd_menu }}</td>
                    <td>{{ $menu->nm_menu }}</td>
                    <td>{{ $menu->kategori }}</td>
                    <td class="right">{{ number_format($menu->harga,"0",",",".") }}</td>
                    <td>{{ $menu->stok }}</td>
                    <td>{{ $menu->satuan }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
    {{-- Print --}}
    <script>
        window.print();
    </script>
</body>
</html>
