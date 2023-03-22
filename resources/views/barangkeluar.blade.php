@extends('template/home')

@section('isi_konten')
<!-- SRC DATATABLE -->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script> 
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<div class="main-content">

        <div class="row report-group">

            <div class="col-md-12">
                <div class="item-big-report col-md-12">
                  <a class="btn btn-primary float-right" style="background-color:#C2A890" href="/addexit" role="button">+ Buat Nota</a>
                  <!-- <a class="btn btn-primary float-right mr-2" style="background-color:#d9b38c" href="/laporan/bln" role="button">Laporan Periodik</a>
                  <a class="btn btn-primary float-right mr-2" style="background-color:#d9b38c" href="/laporan/thn" role="button">Laporan Tahunan</a> -->



                    <table class="table-wisata table-tiketsaya table " id ="exit-table">
                        <thead>
                            <tr class="1">
                                <th scope="col">Nomor Nota</th>
                                <th scope="col">Tanggal</th>
                                <th scope="col">Nama Reseller</th>
                                <th scope="col">Status</th>
                                <th scope="col">Aksi</th>
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
    $('#exit-table').DataTable({
      processing: true,
      serverside: true,
      ajax: 'barangkeluar/exit_json',
      order: [[3, 'desc']],
      columns: [{
          data: 'nota_id',
          name: 'nota_id'
        },
        {
          data: 'tanggal',
          name: 'tanggal'
        },
        {
          data: 'nama_reseller',
          name: 'nama_reseller'
        },
        {
          data: 'status',
          name: 'status'
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