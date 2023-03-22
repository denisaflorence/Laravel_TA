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
<form action="/admin/update" method="POST">
@csrf
        <div class="card-body" style="margin-top: 40px">
            <div class="row gutters">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <h5 class="mb-2 text-primary">Ubah Data Admin</h5>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                    <div class="form-group mt-4">
                        <label for="fullName">Nama Admin</label>
                        <!-- <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="Oh Sehun"> -->
                        <input type="text" class="form-control" name="nama_admin" value="{{$admin->nama_admin}}" >
                        <input type="hidden" name="admin_id" value="{{$admin->admin_id}}">
                    </div>
                    <div class="form-group">
                        <label for="fullName">Password</label>
                        <!-- ditampilinnya kan mesti decrypt -->
                        <input type="password" name="password" class="form-control" id="fullName" value="*****" >
                    </div>
                    <div class="form-group">
                        <label for="phone">Gaji</label>
                        <input type="text" name = "gaji" class="form-control" id="phone" value="{{$admin->gaji}}">
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                    <div class="form-group mt-4">
                        <label for="eMail">E-mail</label>
                        <input type="text" name="email" class="form-control" value="{{$admin->email}}" >
                    </div>
                    <div class="form-group mt-4">
                        <label for="eMail">Alamat</label>
                        <input type="text" name="alamat" class="form-control" value="{{$admin->alamat}}" >
                    </div>
                    <div class="form-group">
                        <label for="eMail">Nomor Telpon</label>
                        <input type="text" name="nomor_telepon" class="form-control" value="{{$admin->nomor_telepon}}" >
                    </div>
                </div>
            </div>
            <div class="row gutters">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="text-center">
                        <button type="reset"  class="btn btn-secondary btn-lg">Batal</button>
                        <button type="submit" class="btn btn-primary btn-lg">Ubah</button>
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
