@extends('template/home')

@section('isi_konten')
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<div class="main-content">
    <style>
        body {
            margin: 0;
            color: #2e323c;
            background: #f5f6fa;
            position: relative;
            height: 100%;
        }
        .text-center {
            margin-top: 20px;
        }
    </style>
    <form action="/insertincoming" method="POST">
        @csrf
        <div class="card-body" style="margin-top: 40px">
            <div class="row gutters ml-2">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <h3 class="mb-3 text-primary">Tambah Barang Masuk</h3>
                </div>
                <div class="ini ml-2">
                    <div class="col mb-3">
                        <label for="fullName" class='font-weight-bold'>No. Nota</label>
                        <input type="text" class="form-control" id="fullName" value="{{$nota[0]->ID}}" name="invoice_id"
                            readonly>
                    </div>
                    <div class="col mb-4">
                        <label for="phone" class='font-weight-bold'>Tanggal</label>
                        <input type="text" class="form-control datepicker" id="from-datepicker" name="tanggal"
                            value="{{ now()->format('d/m/Y') }}">
                    </div>

                </div>

                <div class="row ml-2">

                    <div class="col-md-12 row">
                        <div class="col-md-3">
                            <label for="fullName" class='font-weight-bold'>Nama Produk</label>
                        </div>
                        <div class="col-md-2">
                            <label for="fullName" class='font-weight-bold' style="margin-left: -40px;">Jumlah Per Produk </label>
                        </div>
                        <div class="col-md-3">
                            <label for="eMail" class='font-weight-bold'>Harga Satuan</label>
                        </div>
                        <div class="col-md-3 ">
                            <label for="eMail" class='font-weight-bold'>Subtotal</label>
                        </div>
                    </div>

                    <div id="wrapNota">
                        <div class="col-md-12 row row-nota">
                            <div class="col-md-3" style="width:400px;">
                                <select class="form-control mt-2 ab-t-rpt-2" name="produk_id[]">
                                    <option value="">--Nama Produk--</option>
                                    @foreach($produk as $items)
                                    <option value="{{ $items->produk_id }}" id="id_produk" onchange="myFunction()" >
                                        {{ $items->nama_produk }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2" >
                                <input type="text" class="form-control mt-2" name="jumlah[]">
                            </div>
                            <div class="col-md-3" >
                                <input type="text" class="prc form-control mt-2" name="harga_satuan[]" >
                            </div>
                            <div class="col-md-3  mb-3" >
                                <input type="text" class="prc form-control mt-2" name="total_harga_pembelian[]" readonly>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="text-center" style="margin-top:50px;">
                    <button type="button" id="tambah_produk" class="btn btn-success btn-md mt-2 text-right ml-4">Tambah Produk</button>
               </div>
                
            </div>
            <div class="row gutters">
                <div class="col align-self-end">
                    <div class="col-md-12 text-center mt-5">
                        {{-- <button type="button" id="tambah_produk" class="btn btn-success btn-lg mr-5" >Tambah Produk</button> --}}
                        <button type="reset"  class="btn btn-secondary btn-lg ">Batal</button>
                        <button type="submit" id="submit" name="submit" class="btn btn-primary btn-lg">Tambah</button>
                    </div>
                    <div class="col-md-3 offset-md-3">
                    </div>
                </div>
            </div>
        </div>
    </form>

    <div id="templateNota" class="d-none">
        <div class="col-md-12 row row-nota">
            <div class="col-md-3">
                <select class="form-control mt-2 ab-t-rpt-2" name="produk_id[]">
                    <option value="">--Nama Produk--</option>
                    @foreach($produk as $items)
                    <option value="{{ $items->produk_id }}" id="id_produk" onchange="myFunction()">
                        {{ $items->nama_produk }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <input type="text" class="form-control mt-2" name="jumlah[]">
            </div>
            <div class="col-md-3">
                <input type="text" class="prc form-control mt-2" name="harga_satuan[]" >
            </div>
            <div class="col-md-3  mb-3">
                <input type="text" class="prc form-control mt-2" name="total_harga_pembelian[]" readonly>
            </div>
                <div class="col-md-1">
                    <a class="btn btn-danger btn-sm btn-delete-row " style="    height: 40px;width: 35px;
                    margin-top: 6px;"><i class="far fa-2x fa-trash-alt" style="color: white;margin-top: 2px;margin-left: -3px;"></i></a>
                </div>
        </div>
    </div>
    
    <script>
        var produkId,
        pointerHargaProduk;
    
    $(document).on('input','.prc', '[name^="produk_id"]', function () {
        produkId = this.value;
        $(this).closest('.row-nota')
            .find('[name^="harga_satuan"]')
            .eq($(this)[0].selectedIndex)
            .prop('selected', true);
        pointerHargaProduk = $(this).closest('.row-nota')
            .find('[name^="harga_satuan"]');
        let jumlah = $(this).closest('.row-nota')
            .find('[name^="jumlah"]')
            .val();
        if (jumlah)
            $(this).closest('.row-nota')
                .find('[name^="total_harga_pembelian"]')
                .val(jumlah * pointerHargaProduk.val()  );
    });
    $(document).on('click', '[name^="jumlah"]', function () {
        $(this).closest('.row-nota')
                .find('[name^="total_harga_pembelian"]')
                .val(this.value * pointerHargaProduk.val()  );
        
        findTotal();
    })
    $(document).on('click', '.btn-delete-row', function() {
        $(this).closest('.row-nota').remove();
    })
    $('#tambah_produk').click(function () {
        let template = $('#templateNota').html();
        $('#wrapNota').append(template);
    })
    function findTotal(){
        var arr = $("input[name='total_harga_pembelian[]']")
              .map(function(){return $(this).val();}).get();
        var total =0;
        for(var i = 0, len = arr.length; i < len; i++){
            total += arr[i] << 0;
        }
        console.log(total);
        document.getElementById('total_seluruh').value = total;
    }
    // function findTotal(){
    //     var arr = $("input[name='total_harga_pembelian[]']").map(function(){
    //                 return $(this).val().replace(/\./g, "");
    //             }).get();
    //     // arr = parseInt(arr);
    //     var total =0;
    //     for(var i = 0, len = arr.length; i < len; i++){
    //         total += arr[i] << 0;
    //     }
    //     total = total.toLocaleString('en', { minimumFractionDigits: 0 });
    //     total = total.replace(/,/g, '.');
    //     document.getElementById('total_seluruh').value = total;
    // }
    </script>

    <script type="text/javascript" src="js/jquery-3.5.1.js"></script>
    <script type="text/javascript" src="js/popper.min.js"></script>
    <script type="text/javascript" src="./js/bootstrap.min.js"></script>
    @endsection