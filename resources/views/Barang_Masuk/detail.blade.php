<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
</head>
<style>
    #invoice{
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
  color:black;
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
  background:#DAC1AE;
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
  color:black;
  font-size: 1.2em
}

.invoice table .qty,.invoice table .total,.invoice table .unit {
  text-align: right;
  font-size: 1.2em
}

.invoice table .no {
  color:black;
  font-size: 1.6em;
  background:#DAC1AE;
}

.invoice table .unit {
  background:#DAC1AE;
}

.invoice table .total {
  background:#DAC1AE;
  color:black;
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
  color:black;
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
      font-size: 11px!important;
      overflow: hidden!important
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
    {{-- <div id="invoice">
            <hr style="color: #B28E6B;">
      </div> --}}
      <form action="/barangmasuk/cetak_pdf/{{$incoming->invoice_id}}" method="GET">
      @csrf
        <div class="invoice overflow-auto">
            <div style="min-width: 600px">
                <header>
                    <div class="row" style="display: block">
                        <div class="col">
                                <img src="{{asset('assets/img/logokk.png')}}" style="width: 150px; display: block; margin-left: auto; margin-right: auto; " data-holder-rendered="true" />
                        </div>
                        <div class="col company-details text-center">
                            <div class = "text-center"><h2>Kutus - Kutus</h2></div>
                            <div class = "text-center">Jl. Sawo No.88, Bakbakan,
                                Kabupaten Gianyar, Bali 80515</div>
                            <div>081999919777</div>
                            <div>support@kutuskutusherbal.co.id</div>
                        </div>
                    </div>
                </header>
                <main>
                    <div class="row contacts">
                        <div class="col invoice-to">
                            <div class="text-gray-light">Kepada</div>
                            <h3 class="to">Nyoman Veni</h3>
                            <div class="address">Jl. Taman Giri </div>
                        </div>
                        <div class="col invoice-details">
                            <h2 class="invoice-id">No. Invoice: {{$incoming->invoice_id}} </h2>
                            <div class="date"> Tanggal:</div>
                            <div class="date"><h5>{{$incoming->tanggal}}</h5></div>
                        </div>
                    </div>
                    <table  cellspacing="0" cellpadding="0">
                        <thead>
                            <tr>
                                <!-- <th>#</th> -->
                                <th class="text-center"><h5>Nama produk</h5></th>
                                <th class="text-center"><h5>Harga satuan</h5></th>
                                <th class="text-center"><h5>Jumlah</h5></th>
                                <th class="text-center"><h5>Satuan</h5></th>
                                <th class="text-center"><h5>Subtotal</h5></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($det as $d)
                              <tr>
                                  <!-- <td class="no">01</td> -->
                                  <td class="text-left">
                                      <h3>
                                      {{$d->produk->nama_produk}}
                                      </h3>
                                  </td>
                                  <td class="unit">@currency($d->harga)</td>
                                  <td class="qty" style="text-align:center;">{{$d->jumlah}}</td>
                                  <td style="text-align:center;">pcs</td>
                                  <td class="total">@currency(($d->jumlah)*($d->harga))</td>
                              </tr>
                            @endforeach 
                            
                        </tbody>
                        <tfoot>
                            <tr>
                                
                                <td colspan="4">Total Harga</td>
                                <td>@currency($incoming->total_harga)</td>
                            </tr>
                        </tfoot>
                    </table>
                </main>
              <!-- <button type="submit"class="btn btn-primary btn-lg" >Print Nota</button> -->
        </div>
      </form>
    </div>


<script>
    $('#printInvoice').click(function(){
    Popup($('.invoice')[0].outerHTML);
    function Popup(data) 
    {
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