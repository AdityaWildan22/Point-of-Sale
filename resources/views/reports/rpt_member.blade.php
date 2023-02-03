<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Member</title>
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
    {{-- <div class="col-md-1" style="font-size: 30px">
        <a href="{{ url('/reports') }}"><i class="fas fa-arrow-left" style="color:white"></i></a>
    </div> --}}
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
    <h3>Laporan Data Pelanggan</h3>
    <table id="data" width="100%">
        <thead>
            <tr>
                <th width="5px">No.</th>
                <th>Kode Member</th>
                <th>Nama</th>
                <th>Alamat</th>
                <th>Kota</th>
                <th>Jenis Kelamin</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($rsMember as $member)
                <tr>
                    <td>{{$no++}}</td>
                    <td>{{ $member->kd_member }}</td>
                    <td>{{ $member->nm_member }}</td>
                    <td>{{ $member->alamat }}</td>
                    <td>{{ $member->kota }}</td>
                    <td>{{ $member->jk==1 ? "Laki-laki" : "Perempuan" }}</td>
                    <td>{{ $member->status==1 ? "Available" : "Not Available" }}</td>
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
