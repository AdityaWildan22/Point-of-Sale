<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>NOTA</title>
        <style>
            @page , body { margin:0; padding: 0; }
            #nota { max-width: 190px; }
            #nota header { text-align: center; }
            #nota header .logo { width: 70%; }
            #nota header p { font-family: Tahoma; font-size: 12px; margin: 0; padding: 0; }
            #nota header table { margin: 5px 0; padding: 5px 0; border-top: 1px solid #000; border-bottom: 1px solid #000;  }
            #nota header table td  { font-family: Tahoma; font-size: 12px; margin: 0; padding: 0; text-align: left; }
            #nota .content table { border-collapse: collapse; }
            #nota .content table td { font-size: 12px; font-family: Tahoma; }
            #nota .right { text-align: right; }
            #nota td.price { vertical-align: top; text-align: right; font-size: 16px; }
            #nota .grandtotal { border-top: 1px solid #000; border-bottom: 1px solid #000; margin: 5px 0; padding: 5px 0; }
            #nota .grandtotal table tr td { font-size: 12px; font-family: Tahoma; }
            #nota .thank p { text-align: center;font-size: 13px }

            #nota .qrcode > div { margin: 0 auto; margin-top: 10px; margin-bottom: 5px; }
        </style>
    </head>
    <body>
        <div id="nota">
            <header>
                <img src="{{ asset('images/logo-cafe.png')}}" alt="" class="logo">
                {{-- <p>SENJA CAFE</p> --}}
                <p class="mb-2">Jalan Kelapa Manis </p>
                <p class="mb-2">No.12 Madiun</p>
                <p class="mt-2">{{ $rsTransaksi->tanggal=Carbon\Carbon::now()->isoFormat('DD-MMM-Y HH:mm:ss') }}</p>
                <table width="100%">
                    <tr>
                        <td width="35%">Meja</td>
                        <td width="1%">: </td>
                        <td width="64%">{{ $rsTransaksi->kd_meja }}</td>
                    </tr>
                    <tr>
                        <td>Kasir</td>
                        <td>: </td>
                        <td>{{ $rsTransaksi->name }}</td>
                    </tr>
                    <tr>
                        <td>Pelanggan</td>
                        <td>: </td>
                        <td>{{ $rsTransaksi->nm_member }}</td>
                    </tr>
                </table>
            </header>
            <div class="content">
                <table width="100%">
                    @foreach ($rsDetail as $detail)
                        <tr>
                            <td width="65%">
                                {{ $detail->nm_menu }}<br/>
                                @ {{ number_format($detail->harga,"0",",",",") }} x {{ $detail->jumlah }}
                            </td>
                            <td width="35%" class="right price">{{ number_format($detail->subtotal,"0",",",",")}}</td>
                        </tr>

                        {{-- Menjalankan Subtotal --}}
                        @php
                            $total += $detail->subtotal;
                        @endphp
                    @endforeach
                </table>
            </div>
            <div class="grandtotal">
                {{-- Hitung Bayar --}}
                @php
                $bayar = ($total - $rsTransaksi->diskon) + $rsTransaksi->ppn;   
                @endphp
                <table width="100%">
                    <tr>
                        <td width="65%"><strong>TOTAL</strong></td>
                        <td class="right">{{ number_format($total,"0",",",",")}}</td>
                    </tr>
                    <tr>
                        <td width="65%"><strong>DISKON</strong></td>
                        <td class="right">{{ number_format($rsTransaksi->diskon,"0",",",",")}}</td>
                    </tr>
                    <tr>
                        <td width="100%"><strong>TAX</strong></td>
                        <td class="right">{{ number_format($rsTransaksi->ppn,"0",",",",")}}</td>
                    </tr>
                    <tr>
                        <td width="100%"><strong>TOTAL BAYAR</strong></td>
                        <td class="right">{{ number_format($bayar,"0",",",",")}}</td>
                    </tr>
                </table>
            </div>
            <div class="qrcode">
                {!! DNS2D::getBarcodeHTML(($rsTransaksi->nota), 'QRCODE',4,4) !!}
            </div>
            <div class="thank">
                <p>Terimakasih Atas Kunjungan Anda</p>
            </div>
        </div>
        {{-- Print --}}
        <script>
            window.print();
        </script>
    </body>
</html>