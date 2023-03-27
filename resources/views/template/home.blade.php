<!DOCTYPE html>
<head>
    <title>Kutus-Kutus: Joss</title>
    <meta charset="UTF-8">
    <meta name="description" content="Login TiketSaya Admin">
    <meta name="keywords" content="TiketSaya, Web Dashboard TiketSaya, Login TiketSaya">
    <meta name="author" content="BWA Team">

    <link rel="stylesheet" type="text/css" href="/assets/bootstrap/css/bootstrap.css" />
    <link rel="stylesheet" type="text/css" href="/css/bootstrap-datepicker.css" />
    <link rel="stylesheet" type="text/css" href="/assets/bootstrap/css/style.css" />
    <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
        integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    @yield('css', '')
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-sm " style="position: fixed; overflow:hidden; width:100%; height:8%; z-index:9999; background-color:#b28e6b">
        <a class="navbar-brand" href=""><img src="/assets/img/logo.png" height="50" alt=""></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">
          </ul>
          <form class="form-inline my-2 my-lg-0">
            <a class="nav-link" href="/logout" style="color:black">Logout</a>
            <!-- <a class="nav-link" href="/about" style="color:black">About </a> -->
            <!-- {{-- <a class="nav-link" href="#" ><i class="fas fa-2x fa-user" style="color:black"></i></a> --}} -->
          </form>
        </div>
      </nav>
    <!-- End Of Navbar -->
    <!-- <div class="wrapper"> -->

    <!-- ini sidebar -->
    <div class="side-left">
        <div class="shortcut">
        </div>
        <div class="admin-profile sidenav" id="sl_ap"  style="padding-top: 20px">
            <ul class="admin-menus">
                <a href="/home">
                    <li style="color: black">
                        <i class="fas fa-home" style= "font-size: 18px"></i>
                        Home
                    </li>
                </a>
                <a href="/barangmasuk">
                    <li style="color: black">
                        <i class="fas fa-sign-in-alt" style= "font-size: 18px"></i>
                        Barang Masuk
                    </li>
                </a>
                <a href="/barangkeluar">
                    <li style="color: black">
                        <i class="fas fa-sign-out-alt" style= "font-size: 18px"></i>
                        Barang Keluar
                    </li>
                </a>
                <a href="/produk">
                    <li style="color: black">
                        <i class="fas fa-box" style= "font-size: 18px"></i>
                        Produk
                    </li>
                </a>
                <!-- @if(session('akses_id') == 0) -->
                <!-- <a href="/admin">
                    <li style="color: black">
                        <i class="fas  fa-people-carry"></i>
                        Admin
                    </li>
                </a> -->
                <a href="/reseller">
                    <li style="color: black" >
                        <i class="fas fa-male" style= "font-size: 30px"></i>
                        Pembeli
                    </li>
                </a>

                <!-- Stock Opname -->
                <a href="/stockopname">
                    <li style="color: black">
                        <i class="fas fa-warehouse" style= "font-size: 18px"></i>
                        Stok Opname
                    </li>
                </a>
                <!-- End of stock opname -->

                <!-- Laporan Penjualan  -->
                <div class="dropdown show">
                    <a class=" dropdown-toggle" style= "font-size: 17px;" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa-solid fa-file-invoice-dollar" style= "font-size: 24px"></i> Laporan Penjualan
                    </a>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                        <a class="dropdown-item" href="/laporan/bln" style="font-size: 16px">Periodik</a>
                        <a class="dropdown-item" href="/laporan/bln" style="font-size: 16px">Tahunan</a>
                    </div>
                </div>
                <!-- End Of Laporan Penjualan -->
                 <!-- Laporan Pembelian  -->

                <div class="dropdown show">
                    <a class=" dropdown-toggle" style= "font-size: 17px;" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa-solid fa-file-lines" style= "font-size: 24px"></i>Laporan Pembelian
                    </a>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                        <a class="dropdown-item" href="" style="font-size: 16px">Periodik</a>
                        <a class="dropdown-item" href="" style="font-size: 16px">Tahunan</a>
                    </div>
                </div>
                <!-- End Of Laporan Pembelian -->

                <!-- Laporan Piutang -->
                <a href="/laporanpiutang">
                    <li style="color: black">
                        <i class="fa-solid fa-file-invoice" style= "font-size: 24px;padding-top:20px"></i>
                        Laporan Piutang
                    </li>
                </a>
                <!-- End of laporan piutang -->
                <!-- @endif -->
            </ul>
        </div>
    </div>

    <div class="main-content" style="padding-top: 10px; margin-left:250px;">
    @yield('isi_konten')

    </div>

    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <!-- <script type="text/javascript" src="/assets/js/jquery-3.5.1.js"></script> -->
    <script type="text/javascript" src="/assets/js/popper.min.js"></script>
    <script type="text/javascript" src="/bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../../assets/bootstrap/js/bootstrap.js"></script>
    <script type="text/javascript" src="../../assets/bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../../assets/js/bootstrap-datepicker.min.js"></script>
    <script>
        $(function () {
            $('.datepicker').datepicker({
                format: 'd/mm/yyyy'
            });

        })

    </script>
    <script>
/* Loop through all dropdown buttons to toggle between hiding and showing its dropdown content - This allows the user to have multiple dropdowns without any conflict */
var dropdown = document.getElementsByClassName("dropdown-btn");
var i;

for (i = 0; i < dropdown.length; i++) {
  dropdown[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var dropdownContent = this.nextElementSibling;
    if (dropdownContent.style.display === "block") {
      dropdownContent.style.display = "none";
    } else {
      dropdownContent.style.display = "block";
    }
  });
}
</script>
    @yield('js', '')
</body>
</html>
