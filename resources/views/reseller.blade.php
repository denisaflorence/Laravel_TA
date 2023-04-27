@extends('template/home')

@section('isi_konten')
<!-- SRC DATATABLE -->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script> 
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<div class="main-content">

        <div class="row report-group">

            <div class="col-md-12">
                <div class="item-big-report col-md-12">
                  <a class="btn btn-primary float-right" style="background-color:#C2A890" href="/reseller/add" role="button">+ Tambah Pembeli</a>


                    <table class="table-wisata table-tiketsaya table " id ="reseller-table">
                        <thead>
                            <tr class="1">
                                <th scope="col">Nama Pembeli</th>
                                <th scope="col">Alamat</th>
                
                                <th scope="col">Grade</th>
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
    $('#reseller-table').DataTable({
      processing: true,
      serverside: true,
      ajax: 'reseller/reseller_json',
      columns: [{
          data: 'nama_reseller',
          name: 'nama_reseller'
        },
        {
          data: 'alamat',
          name: 'alamat'
        },
      
        {
          data: 'jenis_grade',
          name: 'jenis_grade'
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