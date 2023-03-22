@extends('template/home')

@section('isi_konten')
{{-- <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script> --}}
<!------ Include the above in your HEAD tag ---------->

<link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet'>
<style>
    body {
    font-family: 'Roboto';font-size: 16px;
}

.aboutus-section {
    padding: 90px 0;
}
.aboutus-title {
    font-size: 30px;
    letter-spacing: 0;
    line-height: 32px;
    margin: 0 0 39px;
    padding: 0 0 11px;
    position: relative;
    text-transform: uppercase;
    color: #000;
}
.aboutus-title::after {
    background: #fdb801 none repeat scroll 0 0;
    bottom: 0;
    content: "";
    height: 2px;
    left: 0;
    position: absolute;
    width: 54px;
}
.aboutus-text {
    color: #606060;
    font-size: 15px;
    line-height: 22px;
    margin: 0 0 35px;
}

a:hover, a:active {
    color: #ffb901;
    text-decoration: none;
    outline: 0;
}
.aboutus-more {
    border: 1px solid #fdb801;
    border-radius: 25px;
    color: #fdb801;
    display: inline-block;
    font-size: 14px;
    font-weight: 700;
    letter-spacing: 0;
    padding: 7px 20px;
    text-transform: uppercase;
}
.feature .feature-box .iconset {
    background: #fff none repeat scroll 0 0;
    float: left;
    position: relative;
    width: 18%;
}
.feature .feature-box .iconset::after {
    background: #fdb801 none repeat scroll 0 0;
    content: "";
    height: 150%;
    left: 43%;
    position: absolute;
    top: 100%;
    width: 1px;
}

.feature .feature-box .feature-content h4 {
    color: #0f0f0f;
    font-size: 18px;
    letter-spacing: 0;
    line-height: 22px;
    margin: 0 0 5px;
}


.feature .feature-box .feature-content {
    float: left;
    padding-left: 28px;
    width: 78%;
}
.feature .feature-box .feature-content h4 {
    color: #0f0f0f;
    font-size: 18px;
    letter-spacing: 0;
    line-height: 22px;
    margin: 0 0 5px;
}
.feature .feature-box .feature-content p {
    color: #606060;
    font-size: 13px;
    line-height: 22px;
}
.iconset {
    color : #f4b841;
    padding:0px;
    font-size:40px;
    border: 1px solid #fdb801;
    border-radius: 100px;
    color: #fdb801;
    font-size: 28px;
    height: 70px;
    line-height: 70px;
    text-align: center;
    width: 70px;
}
}
</style>

<div class="aboutus-section">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="aboutus">
                        <h2 class="aboutus-title">Tentang Kami</h2>
                        <p class="aboutus-text">Semua berawal dari sebuah desa Bona, sebuah desa kecil yang terletak di kabupaten 
                            Gianyar Bali. Dengan niat untuk berbagi kesembuhan untuk sebanyak mungkin orang, dan dengan keyakinan                     
                        dalam menyajikan sebuah ramuan yang menjadi warisan Nusantara yang telah terbukti menyembuhkan dan menyehatkan 
                        dari sejak jaman Majapahit, lahirlah produk Tamba Waras bernama Kutus-Kutus. </p>
                        <p class="aboutus-text">Warisan yg dulu terpendam, kini 
                            bersinar kembali untuk menjadi bagian dalam keseharian kita untuk memperoleh kesembuahan dan kesehatan.</p>
                        {{-- <a class="aboutus-more" href="#">read more</a> --}}
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="aboutus-banner" >
                        <img src="assets/img/logokk.png" style="width: 300px;">
                    </div>
                </div>
                <div class="col-md-5 col-sm-6 col-xs-12">
                    <div class="feature">
                        <div class="feature-box">
                            <div class="clearfix">
                                <div class="iconset">
                                    <i class="fas fa-2x fa-heart mt-2"></i>
                                </div>
                                <div class="feature-content">
                                    <h4>Meneruskan Warisan Nusantara</h4>
                                    <p>Jamu adalah sebutan untuk obat tradisional dari Indonesia, khususnya masyarakat Jawa. 
                                        Jamu merupakan ramuan yang berasal dari tumbuh-tumbuhan alam yang diracik tanpa 
                                        menggunakan bahan kimia sebagai aditif (bahan tambahan).</p>
                                </div>
                            </div>
                        </div>
                        <div class="feature-box">
                            <div class="clearfix">
                                <div class="iconset">
                                    <i class="fas fa-2x fa-cog mt-2"></i>
                                </div>
                                <div class="feature-content">
                                    <h4>Ramuan Tradisional Jamu</h4>
                                    <p>Jamu adalah ramuan unik untuk pengobatan herbal di Indonesia, and dan digunakan untuk
                                         mengobati apapun sesuai dengan efektifitas tanaman yang dikenal 
                                         secara empiris turun-temurun.</p>
                                </div>
                            </div>
                        </div>
                        <div class="feature-box">
                            <div class="clearfix">
                                <div class="iconset">
                                    <i class="fas fa-2x fa-headset mt-2"></i>
                                </div>
                                <div class="feature-content">
                                    <h4>Berbagi Kesembuhan dan Kesehatan</h4>
                                    <p>Merupakan sebuah niat tulus dari kami untuk dapat berbagi dan membantu penyembuhan kepada 
                                        sebanyak-banyaknya teman ataupun kerabat dari hasil penemuan kami dengan mengombinasikan berbagai 
                                        macam tanaman herbal yang selama ini telah terbukti dapat membantu dan menyembuhkan berbagai macam penyakit.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection