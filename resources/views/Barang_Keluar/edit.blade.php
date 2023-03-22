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
    <form action="/barangkeluar/edit/update" method="POST" enctype="multipart/form-data" onsubmit="return validateForm()" name="" id="">
    @csrf
        <div class="card-body" style="margin-top: 40px">
            <div class="row gutters">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <h3 class="mb-2 text-primary" style="padding-bottom:20px;">Ubah Barang Keluar</h3>
                </div>
                <div class="ini">
                    <div class="col">
                        <label for="fullName" class='font-weight-bold'>Nota No.</label>
                        <input type="text" class="form-control" id="fullName" value="{{$exit->nota_id}}" name="nota_id" readonly>
                    </div>

                    
                    <div class="col ">
                        <label for="fullName" class='font-weight-bold'>Nama Reseller </label>
                        <input type="text" class="form-control" id="fullName" value="{{$exit->reseller->nama_reseller}}"
                            readonly>
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-4 ml-4">
                        <label for="phone" class='font-weight-bold'>Tanggal</label>
                        <input type="date" class="form-control" id="from-datepicker" value="{{$exit->tanggal ?? now()}}" readonly>
                    </div>
                </div>
                <div class="row align-items-end">
                    <div class="col ml-3 mt-5">
                        <label for="fullName" class='font-weight-bold'>Harga Total Penjualan </label>
                        <input type="text" class="form-control" value="{{$exit->total_harga_penjualan}}" id="total_harga_penjualan" name="total_harga_penjualan" readonly>
                    </div>
                    <div class="col">
                        <label for="eMail" class='font-weight-bold'>Sudah Dibayar</label>
                        <input type="text" class="form-control" value="{{$exit->sudah_dibayar}}" id="sudah_dibayar" onkeyup="myFunction()" name="sudah_dibayar">
                    </div>
                    <div class="col">
                        <label for="eMail" class='font-weight-bold'>Sisa Bayar</label>
                        <input type="text" class="form-control" value="{{$exit->total_harga_penjualan - $exit->sudah_dibayar}}" id="mySelect" name="belum_dibayar" readonly>
                    </div>
                </div>
                <div class="row col" style="margin-top:30px;">
                    <div class="col-md-12 row">
                        <div class="col-md-3"><label for="fullName" class='font-weight-bold'>Nama Produk </label></div>
                        <div class="col-md-3"><label for="fullName" class='font-weight-bold'>Jumlah</label></div>
                        <div class="col-md-3"><label for="eMail" class='font-weight-bold'>Harga Satuan</label></div>
                        <div class="col-md-3"><label for="eMail" class='font-weight-bold'>Harga Total</label></div>
                    </div>

                    @foreach($detail as $d)
                    <div class="col-md-12 row" style="margin-top:10px;">
                        <div class="col-md-3">
                            <!-- <label for="fullName" class='font-weight-bold'>Nama Produk </label> -->
                            <input type="text" class="form-control" id="fullName" value="{{$d->produk->nama_produk}}"
                                readonly>
                            <!-- <input type="text" class="form-control" id="fullName" value="Minyak Tanamu Tanami" readonly> -->
                        </div>
                        <div class="col-md-3">
                            <!-- <label for="fullName" class='font-weight-bold'>Jumlah</label> -->
                            <input type="text" class="form-control" id="fullName" value="{{$d->jumlah}}" readonly>
                            <!-- <input type="text" class="form-control" id="fullName" value="10" readonly> -->
                        </div>
                        <div class="col-md-3">
                            <!-- <label for="eMail" class='font-weight-bold'>Harga Satuan</label> -->
                            <input type="text" class="form-control" value="{{$d->harga_satuan}}" readonly>
                            <!-- <input type="text" class="form-control" value="325000" readonly> -->
                        </div>
                        <div class="col-md-3">
                            <!-- <label for="eMail" class='font-weight-bold'>Harga Total</label> -->
                            <input type="text" class="form-control" value="{{($d->jumlah)*($d->harga_satuan)}}" readonly>
                            <!-- <input type="text" class="form-control" value="3250000" readonly> -->
                        </div>

                    </div>
                    @endforeach
                </div>
            </div>

            <div class="row gutters">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="text-right mt-5">
                        <button type="button" id="submit" name="submit" class="btn btn-secondary btn-lg">Batal</button>
                        <button type="submit" id="submit" name="submit" class="btn btn-primary btn-lg">Ubah</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script type="text/javascript" src="js/jquery-3.5.1.js"></script>
    <script type="text/javascript" src="js/popper.min.js"></script>
    <script type="text/javascript" src="./js/bootstrap.min.js"></script>

    <script>
        function myFunction() {
            var total = document.getElementById("total_harga_penjualan").value;
            var sudah = document.getElementById("sudah_dibayar").value;
            // alert(total-sudah);
            // var sudah = document.getElementById("mySelect").value;
            document.getElementById("mySelect").value = total-sudah;
        } 
    </script>


    @endsection