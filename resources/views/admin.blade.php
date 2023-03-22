@extends('template/home')

@section('isi_konten')
<!-- SRC DATATABLE -->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script> 
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<div class="main-content">

        <div class="row report-group">

            <div class="col-md-12" >
                <div class="item-big-report col-md-12">
                  <a class="btn btn-primary float-right" style="background-color:#C2A890" href="/addadmin" role="button">+ Tambah Admin</a>


                    <table class="table-wisata table-tiketsaya table table-borderless" id ="admin-table">
                        <thead>
                            <tr class="1" style="background-color: white">
                                <th scope="col" >Nama Admin</th>
                                <th scope="col">Gaji</th>
                                <th scope="col">Alamat</th>
                                <th scope="col">Nomor Telepon</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>

                        <!-- BENTAR YA GENGS TA REMARK SEK -->

                            <!-- <tr class="2" style="background-color: #DAC1AE;">
                                <td>Monas</td>
                                <td>Jakarta, Indonesia</td>
                                <td>January 22, 2019</td>
                                <td>US$ 20</td>
                                <td>
                                    <a href="manage_wisata.html" class="btn btn-small-table btn-primary ">Details</a>
                                </td>
                            </tr>

                            <tr class="3" style="background-color: #DAC1AE">
                                <td>Candi</td>
                                <td>Magelang, Indonesia</td>
                                <td>March 1, 2019</td>
                                <td>US$ 220</td>
                                <td>
                                    <a href="manage_wisata.html" class="btn btn-small-table btn-primary ">Details</a>
                                </td>
                            </tr>

                            <tr class="4" style="background-color: #DAC1AE">
                                <td>Pisa</td>
                                <td>Plance, Italy</td>
                                <td>August 16, 2019</td>
                                <td>US$ 120</td>
                                <td>
                                    <a href="manage_wisata.html" class="btn btn-small-table btn-primary ">Details</a>
                                </td>
                            </tr> -->


                        </tbody>
                    </table>


                </div>



            </div>



        </div>
</div>
<script>
  $(document).ready(function() {
    $('#admin-table').DataTable({
      processing: true,
      serverside: true,
      ajax: 'admin/admin_json',
      columns: [{
          data: 'nama_admin',
          name: 'nama_admin'
        },
        {
          data: 'gaji',
          name: 'gaji'
        },
        {
          data: 'alamat',
          name: 'alamat'
        },
        {
          data: 'nomor_telepon',
          name: 'nomor_telepon'
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