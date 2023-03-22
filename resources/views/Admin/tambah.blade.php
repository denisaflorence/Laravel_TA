@extends('template/home')

@section('isi_konten')
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<form action="/insertadmin" method="POST">
@csrf
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
        <div class="card-body" style="margin-top: 40px">
            <div class="row ">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <h3 class="mb-4 text-primary">Tambah Admin Baru</h3>
                </div>
                <div class="col-md-12 row  ml-4">
                    <div class="col-md-2"><label for="fullName" class='font-weight-bold'>ID Admin</label></div>
                    <div class="col-md-4 "><label for="phone" class='font-weight-bold'>Nama Admin</label></div>
                    <div class="col-md-3"><label for="eMail" class='font-weight-bold'>Password</label></div>
                </div>
                <div class="col-md-12 row ml-4 mb-3">
                    <div class="col-md-2"> <input type="text" class="form-control" name="admin_id"></div>
                    <div class="col-md-4"><input type="text" class="form-control" name="nama_admin"></div>
                    <div class="col-md-3"><input type="password" class="form-control" name="password"></div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 row  ml-4">
                    <div class="col-md-2"><label for="fullName" class='font-weight-bold'>Gaji</label></div>
                    <div class="col-md-4 "><label for="phone" class='font-weight-bold'>Nomor Telpon</label></div>
                    <div class="col-md-3"><label for="eMail" class='font-weight-bold'>Email</label></div>
                </div>
                <div class="col-md-12 row  ml-4">
                    <div class="col-md-2"> <input type="text" class="form-control" name="gaji"></div>
                    <div class="col-md-4"><input type="text" class="form-control"  name="nomor_telepon"></div>
                    <div class="col-md-3"><input type="text" class="form-control" name="email"></div>
                </div>
            </div>
        </div>
        <div class="col-md-12 row  ml-4">
            <div class="col-md-8" style="margin-top:30px;">
                <label for="inputalamat" class='font-weight-bold'>Alamat</label>
            </div>
            <div class="col-md-8">
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
    </div>
</form>
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script type="text/javascript" src="js/jquery-3.5.1.js"></script>
<script type="text/javascript" src="js/popper.min.js"></script>
<script type="text/javascript" src="./js/bootstrap.min.js"></script>
@endsection
