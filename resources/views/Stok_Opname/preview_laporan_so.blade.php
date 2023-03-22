<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
</head>
<style>
    #invoice {
        padding: 30px;
    }

    .invoice {
        position: relative;
        background-color: #FFF;
        min-height: 680px;
        padding: 15px
    }

    .invoice header {
        padding: 10px 0;
        margin-bottom: 20px;
        border-bottom: 1px solid #B28E6B;
    }

    .invoice .company-details {
        text-align: center;
    }

    .invoice .company-details .name {
        margin-top: 0;
        margin-bottom: 0
    }

    .invoice .contacts {
        margin-bottom: 20px
    }

    .invoice .invoice-to {
        text-align: left
    }

    .invoice .invoice-to .to {
        margin-top: 0;
        margin-bottom: 0
    }

    .invoice .invoice-details {
        text-align: right
    }

    .invoice .invoice-details .invoice-id {
        margin-top: 0;
        color: black;
    }

    .invoice main {
        padding-bottom: 50px
    }

    .invoice main .thanks {
        margin-top: -100px;
        font-size: 2em;
        margin-bottom: 50px
    }

    .invoice main .notices {
        padding-left: 6px;
        border-left: 6px solid #B28E6B;
    }

    .invoice main .notices .notice {
        font-size: 1.2em
    }

    .invoice table {
        width: 100%;
        border-collapse: collapse;
        border-spacing: 0;
        margin-bottom: 20px
    }

    .invoice table td {
        padding: 15px;
        background: #DAC1AE;
    }

    .invoice table th {
        padding: 15px;
        background: #B28E6B;
    }

    .invoice table th {
        white-space: nowrap;
        font-weight: 400;
        font-size: 16px
    }

    .invoice table td h3 {
        margin: 0;
        font-weight: 400;
        color: black;
        font-size: 1.2em
    }

    .invoice table .qty,
    .invoice table .total,
    .invoice table .unit {
        text-align: right;
        font-size: 1.2em
    }

    .invoice table .no {
        color: black;
        font-size: 1.6em;
        background: #DAC1AE;
    }

    .invoice table .unit {
        background: #DAC1AE;
    }

    .invoice table .total {
        background: #DAC1AE;
        color: black;
    }

    .invoice table tbody tr:last-child td {
        border: none
    }

    .invoice table tfoot td {
        background: 0 0;
        border-bottom: none;
        white-space: nowrap;
        text-align: right;
        padding: 10px 20px;
        font-size: 1.2em;
        border-top: 1px solid #aaa;
    }

    .invoice table tfoot tr:first-child td {
        border-top: none
    }

    .invoice table tfoot tr:last-child td {
        color: black;
        font-size: 1.4em;
    }

    .invoice table tfoot tr td:first-child {
        border: none
    }

    .invoice footer {
        width: 100%;
        text-align: center;
        color: #777;
        border-top: 1px solid #aaa;
        padding: 8px 0
    }

    @media print {
        .invoice {
            font-size: 11px !important;
            overflow: hidden !important
        }

        .invoice footer {
            position: absolute;
            bottom: 10px;
            page-break-after: always
        }

        .invoice>div:last-child {
            page-break-before: always
        }
    }
</style>
<!-- <div id="invoice">
    <hr style="color: #B28E6B;">
</div> -->
<div class="invoice overflow-auto">
    <div style="min-width: 600px">
        <header>
            <div class="row" style="display: block">
                <div class="col">
                    <img src="{{asset('assets/img/logokk.png')}}"
                        style="width: 150px; display: block; margin-left: auto; margin-right: auto; "
                        data-holder-rendered="true" />
                </div>
                <div class="col company-details text-center">
                    <div class="text-center">
                        <h2>Kutus - Kutus</h2>
                    </div>
                    <div class="text-center">Jl. Buana Kubu No.48, Tegal Harum, Bali</div>
                    <div>081805554911</div>
                    <!-- <div>company@example.com</div> -->
                </div>
            </div>
        </header>
        <form action="/stockopname/cetak/laporan" method="POST">
        @csrf
            <main>
                <div class="container">
                    <div class="text-center" style="margin-bottom:20px;">
                        <center>
                            <h2>Laporan Stock Opname Tahun {{$year}}</h2>
                        </center>
                        <input type="hidden" name="year" value="{{$year}}">
                    </div>
                </div>
                <table cellspacing="0" cellpadding="0">
                    <thead>
                        <tr>
                            
                            <th class="text-center">Tanggal</th>
                            <th class="text-center">Nama produk</th>
                            <th class="text-center">Jumlah Sistem</th>
                            <th class="text-center">Jumlah Hitung</th>
                            <th class="text-center">Perbedaan</th>
                            <!-- <th class="text-right">Satuan</th> -->
                            <th class="text-center">Alasan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($so as $d)
                        <tr>
                            <td>{{$d->tanggal}}</td>
                            <td class="text-left">
                                <!-- <h3> -->
                                    {{$d->nama_produk}}
                                <!-- </h3> -->
                            </td>
                            <td style="text-align:center;">{{$d->jumlah_sistem}}</td>
                            <td style="text-align:center;">{{$d->jumlah_hitung}}</td>
                            <td style="text-align:center;">{{$d->perbedaan}}</td>
                            <!-- <td class="unit">{{$d->satuan_id}}</td> -->
                            <td>{{$d->alasan}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>

                    </tfoot>
                </table>
                <button type="submit"class="btn btn-primary btn-lg" >Print Nota</button>
            </main>
        </form>
    </div>
</div>


<script>
    $('#printInvoice').click(function () {
        Popup($('.invoice')[0].outerHTML);

        function Popup(data) {
            window.print();
            return true;
        }
    });
</script>

<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
{{-- <script src="invoice.js"></script> --}}
</body>

</html>