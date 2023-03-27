@extends('template/home')

@section('isi_konten')
<!-- SRC DATATABLE -->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script> 
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <div class="main-content">

            <div class="row report-group">

                <div class="col-md-12">
                    <div class="item-big-report col-md-12">
                      <a class="btn btn-primary float-right" style="background-color:#C2A890" href="/stockopname/add" role="button">+ Catat Stock Opname</a>
                      <!-- <a class="btn btn-primary float-right mr-2" style="background-color:#d9b38c" href="/stockopname/laporan" role="button">Laporan Tahunan</a> -->

                        <table class="table-wisata table-tiketsaya table " id ="sopname-table">
                            <thead>
                                <tr class="1">
                                    <th scope="col">ID Stock Opname </th>
                                    <th scope="col">Tanggal</th>
                                    <th scope="col">Nama Admin</th>
                                    <th scope="col">Nama Produk</th>
                                    <th scope="col">Satuan</th>
                                    <th scope="col">Jumlah di Sistem</th>
                                    <th scope="col">Jumlah Hitung Manual</th>
                                    <th scope="col">Selisih</th>
                                    <th scope="col">Alasan</th>
                                    <!-- <th scope="col">Aksi</th> -->
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>


                    </div>



                </div>



            </div>
    </div>
<script>
  $(document).ready(function() {
    $('#sopname-table').DataTable({
      processing: true,
      serverside: true,
      ajax: 'stockopname/sopname_json',
      columns: [{
          data: 'opname_id',
          name: 'opname_id'
        },
        {
          data: 'tanggal',
          name: 'tanggal'
        },
        {
          data: 'nama_admin',
          name: 'nama_admin'
        },
        {
          data: 'nama_produk',
          name: 'nama_produk'
        },
        {
          data: 'satuan_id',
          name: 'satuan_id'
        },
        {
          data: 'jumlah_sistem',
          name: 'jumlah_sistem'
        },
        {
          data: 'jumlah_hitung',
          name: 'jumlah_hitung'
        },
        {
          data: 'perbedaan',
          name: 'perbedaan'
        },
        {
          data: 'alasan',
          name: 'alasan'
        },
        // {
        //   data: 'action',
        //   name: 'action'
        // }
      ]
    });
  });
</script>
  
@endsection