@extends('template/home')

@section('isi_konten')
<!-- SRC DATATABLE -->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script> 
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<div class="main-content">

        <div class="row report-group">

            <div class="col-md-12">
                <div class="item-big-report col-md-12">
                  <a class="btn btn-primary float-right" style="background-color:#ac7339" href="/addproduk" role="button">+ Tambah Invoice</a>
                  <!-- <a class="btn btn-primary float-right mr-2" style="background-color:#d9b38c" href="/laporan/bulan" role="button">Laporan Periodik</a>
                  <a class="btn btn-primary float-right mr-2" style="background-color:#d9b38c" href="/laporan/tahun" role="button">Laporan Tahunan</a> -->

                    <table class="table-wisata table-tiketsaya table " id ="incoming-table">
                        <thead>
                            <tr class="1">
                                <th scope="col">Nomor Invoice</th>
                                <th scope="col">Tanggal</th>
                                <!-- <th scope="col">Total Harga</th> -->
                                <th scope="col">Aksi</th>
                                <!-- <th scope="col">Menu</th> -->
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
    $('#incoming-table').DataTable({
      processing: true,
      serverside: true,
      ajax: 'barangmasuk/json',
      order: [[0, 'desc']],
      columns: [{
          data: 'invoice_id',
          name: 'invoice_id'
        },
        {
          data: 'tanggal',
          name: 'tanggal'
        },
        // {
        //   data: 'total_harga',
        //   name: 'total_harga',
        //   render: $.fn.dataTable.render.number( '.', '.', 0, 'Rp' )
        // },
        // {
        //   data: 'satuan_id',
        //   name: 'satuan_id'
        // },
        {
          data: 'action',
          name: 'action'
        }
      ]
    });
  });



  // When the user clicks on <div>, open the popup

</script>

<style>
/* Popup container */
.popup {
  position: relative;
  display: inline-block;
  cursor: pointer;
}

/* The actual popup (appears on top) */
.popup .popuptext {
  visibility: hidden;
  width: 160px;
  background-color: #555;
  color: #fff;
  text-align: center;
  border-radius: 6px;
  padding: 8px 0;
  position: absolute;
  z-index: 1;
  bottom: 125%;
  left: 50%;
  margin-left: -80px;
}

/* Popup arrow */
.popup .popuptext::after {
  content: "";
  position: absolute;
  top: 100%;
  left: 50%;
  margin-left: -5px;
  border-width: 5px;
  border-style: solid;
  border-color: #555 transparent transparent transparent;
}

/* Toggle this class when clicking on the popup container (hide and show the popup) */
.popup .show {
  visibility: visible;
  -webkit-animation: fadeIn 1s;
  animation: fadeIn 1s
}

/* Add animation (fade in the popup) */
@-webkit-keyframes fadeIn {
  from {opacity: 0;}
  to {opacity: 1;}
}

@keyframes fadeIn {
  from {opacity: 0;}
  to {opacity:1 ;}
}
</style>
@endsection