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
    <form action="/reseller/insert" method="POST">
    @csrf
            <div class="card-body" style="margin-top: 40px">
                <div class="row gutters">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <h3 class="mb-2 text-primary">Tambah Reseller Baru</h3>
                    </div>
                    <div class="roww ml-2 mt-4">
                        <div class="col-md-12 row">
                            <div class="col-md-3 "><label for="fullName" class='font-weight-bold'>ID Reseller</label></div>
                            <div class="col-md-3"><label for="fullName" class='font-weight-bold'>Total Kutus </label></div>
                            <div class="col-md-4"><label for="eMail" class='font-weight-bold'>Tanggal Kutus</label></div>
                        </div>
                        <div class="col-md-12 row">
                            <div class="col-md-3 mb-2"><input type="text" class="form-control" id="fullName" name="reseller_id" value="{{$reseller_id[0]->ID}}"
                                    readonly></div>
                            <div class="col-md-3 mb-4"><input type="text" class="form-control" name="total_kutus" id="fullName" value="0"></div>
                            <div class="col-md-4"><input type="text" class="form-control datepicker" id="from-datepicker"
                            value="{{ now()->format('d/m/Y') }}" name="tanggal"></div>
                        </div>
                    </div>
                    <div class="row  ml-2">
                        <div class="col-md-12 row">
                            <div class="col-md-4"><label for="fullName" class='font-weight-bold'>Nama Reseller</label></div>
                            <div class="col-md-3"><label for="fullName" class='font-weight-bold'>Jenis Grade</label></div>
                        </div>
                        <div class="col-md-12 row">
                            <div class="col-md-4 mb-2"><input type="text"  name ="nama_reseller" class="form-control" id="fullName" value=""></div>
                            <div class="col-md-3 mb-4">
                                <select class="form-control" name="grade" id="sel1">
                                    @foreach($grade as $items)
                                    <option value="{{ $items->grade_id }}">{{ $items->jenis_grade }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 ml-2">
                <div class="form-group col-md-8" style="text-align:left;padding-left:0px;">
                    <label for="inputalamat"  class='font-weight-bold'>Alamat</label>
                </div>
                <div class="form-group col-md-8" style="text-align:left;padding-left:0px;">
                    <textarea class="form-control" rows="3" id="inputalamat" name="alamat" placeholder="Alamat"></textarea>
                </div>
            </div>
            <div class="row gutters">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="text-center mt-4">
                        <button type="reset"  class="btn btn-secondary btn-lg">Batal</button>
                        <button type="submit"  class="btn btn-primary btn-lg">Tambah</button>
                    </div>
                </div>
            </div>
    </form>
</div>
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script type="text/javascript" src="js/jquery-3.5.1.js"></script>
<script type="text/javascript" src="js/popper.min.js"></script>
<script type="text/javascript" src="./js/bootstrap.min.js"></script>
@endsection
