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
                                <th scope="col">Total Harga</th>
                                <th scope="col">Aksi</th>
                                <!-- <th scope="col">Menu</th> -->
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
                            <!-- NANTI DIHAPUS -->
                            <!-- Modal -->
                            <div class="modal fade" id="myModalHorizontal" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <!-- Modal Header -->
                                        <div class="modal-header" style="background: orange">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"
                                                    class="ion-android-close"></span></button>
                                            <h4 class="modal-title" id="myModalLabel" style="color: whitesmoke;">Donation For Siddhyog Sadhan Mandal
                                            </h4>
                                        </div> <!-- Modal Body -->
                                        <div class="modal-body">
                                            <div>
                                                Payment Option
                                            </div>
                                            <form id="frm-donation" name="frm-donation">
                                                <div class="header-btn">
                                                    <div id="div-physical">
                                                        <label>
                                                            <input id="rdb_physical" name="rdb_donation" value="0" type="radio" checked=""
                                                                class="validate[required]"
                                                                data-errormessage-value-missing="Donation Type is required!">
                                                            Physical Entity Donation
                                                        </label>
                                                    </div>
                                            </form>
                                            <div class="modal-body">
                                                <div class="modal-footer" id="modal_footer">
                                                    <!--<input id="btnSubmit" name="btnSubmit" value="Donate" class="btn btn-default-border-blk" type="submit">-->
                                                    <a id="btnDonate" class="btn btn-default-border-blk">Donate</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                          <!-- DIHAPUS -->
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
        {
          data: 'total_harga',
          name: 'total_harga',
          render: $.fn.dataTable.render.number( '.', '.', 0, 'Rp' )
        },
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