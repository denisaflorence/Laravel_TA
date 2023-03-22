@extends('template/home')

@section('isi_konten')
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
<body>
<form action="/stockopname/insert" method="POST">
@csrf
    <h3 class="text-primary mt-5 ml-2"> Tambah stock opname</h3>
      <div class="col-md-12 row  ml-4">
          <div class="col-md-3"><label for="inputID">ID opname</label></div>
          <div class="col-md-3"><label for="inputtanggal">Tanggal</label></div>
      <div class="col-md-12 row mb-3">
            <div class="col-md-3">
                <input type="text" class="form-control" id="ID" value="{{$id[0]->ID}}" name="opname_id" readonly>
            </div>
            <div class="col-md-3">
                  <input type="text" class="form-control datepicker" id="from-datepicker"
                                  value="{{ now()->format('d/m/Y') }}" name="tanggal">
            </div>
      </div>
      </div>
      <div class="row">
        <div class="col-md-12 row  ml-4">
          <div class="col-md-3" style="margin-left: 15px"><label for="inputproduk">Nama produk</label></div>
        </div>
        <div class="col-md-12 row row-nota  ml-4 mb-3">
          <div class="col-md-3" style="margin-left: 15px">
                  <select class="form-control" name="produk" id="produk" >
                        <option value="">--Nama Produk--</option>
                        @foreach($produk as $items)
                          <option value="{{ $items->produk_id }}">{{ $items->nama_produk }}</option>
                        @endforeach
                  </select>
          </div>
        </div>
      </div>
        <div class="roww">
          <div class="col-md-12 row  ml-4">
            <div class="col-md-3"><label for="inputID">Jumlah Sistem</label></div>
            <div class="col-md-3"><label for="inputID1">Jumlah Hitung</label></div>
            <div class="col-md-3"><label for="inputtanggal">Perbedaan</label></div>
          <div class="col-md-12 row row-nota mb-3">
              <div class="col-md-3">
                  <select class="form-control" name="jumlah_sistem" id="jumlah_sistem" readonly>
                        <option value="">--Jumlah Sistem--</option>
                        @foreach($produk as $items)
                          <option value="{{ $items->jumlah_stok }}">{{ $items->jumlah_stok }}</option>
                        @endforeach
                  </select>
                </div>
              <div class="col-md-3"><input type="text" class="form-control" name="jumlah_hitung" id="jumlah_hitung"></div>
              <div class="col-md-3"><input type="text" class="form-control" name="perbedaan" id="perbedaan" readonly ></div>
          </div>
          </div>
        </div>
        <div class="roww">
          <div class="col-md-12 row  ml-4">
            <div class="col-md-3"><label for="inputalasan">Alasan</label></div>
          </div>
          <div class="col-md-12 row  ml-4">
            <div class="col-md-5"><input type="text" class="form-control" name="alasan" required></div>
          </div>
        </div>
        <div class="row gutters">
          <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
              <div class="text-center mt-5">
                  <button type="reset" class="btn btn-secondary btn-lg">Batal</button>
                  <button type="submit" class="btn btn-primary btn-lg">Tambah</button>
              </div>
          </div>
      </div>
</form>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
@endsection


@section('js')
<script>

var jumlahHitung = document.getElementById('jumlah_hitung').value;
var perbedaan = document.getElementById('perbedaan').value;
var jumlahSistem;

$(document).on('change', '[name^="produk"]', function () {
        document.getElementById("jumlah_sistem").selectedIndex = document.getElementById("produk").selectedIndex;
        jumlahSistem = document.getElementById('jumlah_sistem').value;
});

    


$(document).on('keyup', '[name="jumlah_hitung"]', function () {
    $(this).closest('.row-nota').find('[name^="perbedaan"]')
    .val(jumlahSistem - this.value);
    console.log(jumlahSistem);
})

</script>
@endsection