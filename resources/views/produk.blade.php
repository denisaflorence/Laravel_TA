@extends('template/home')

@section('isi_konten')
<!-- SRC DATATABLE -->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script> 
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<div class="main-content">
        <div class="row report-group">
                <div class="item-big-report col-md-12">
                    <table class="table-wisata table-tiketsaya table " id ="produk-table">
                        <thead>
                            <tr class="1">
                                <th scope="col">ID Produk</th>
                                <th scope="col">Nama Produk</th>
                                <th scope="col">Jumlah Produk</th>
                                <th scope="col">Satuan</th>
                                <th scope="col">Harga Modal</th>
                                <th scope="col">Harga Jual</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                    </table>
                </div>
        </div>
</div>
<script>
  $(document).ready(function() {
    $('#produk-table').DataTable({
      processing: true,
      serverside: true,
      ajax: 'produk/produk_json',
      columns: [{
          data: 'produk_id',
          name: 'produk_id'
        },{
          data: 'nama_produk',
          name: 'nama_produk'
        },
        {
          data: 'jumlah_stok',
          name: 'jumlah_stok',
          render: $.fn.dataTable.render.number( '.', '.', 0)
        },
        {
          data: 'satuan_id',
          name: 'satuan_id'
        },
        {
          data: 'harga_modal',
          name: 'harga_modal',
          render: $.fn.dataTable.render.number( '.', '.', 0, 'Rp ' )
        },
        {
          data: 'harga_jual',
          name: 'harga_jual',
          render: $.fn.dataTable.render.number( '.', '.', 0, 'Rp ' )
        },
        {
          data: 'action',
          name: 'action'
        }
      ]
    });
  });
</script>
  
@endsection