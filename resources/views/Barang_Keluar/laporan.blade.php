
<form action='/preview/laporan/keluar' method="POST">
@csrf
<style>
    @import url('https://fonts.googleapis.com/css?family=Montserrat:400,800');
    
    * {
        box-sizing: border-box;
    }
    
    body {
        background: #f6f5f7;
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
        font-family: 'Montserrat', sans-serif;
        height: 100vh;
        margin: -20px 0 50px;
    }
    
    h1 {
        font-weight: bold;
        margin: 0;
    }
    
    h2 {
        text-align: center;
    }
    
    p {
        font-size: 14px;
        font-weight: 100;
        line-height: 20px;
        letter-spacing: 0.5px;
        margin: 20px 0 30px;
    }
    
    span {
        font-size: 12px;
    }
    
    a {
        color: #333;
        font-size: 14px;
        text-decoration: none;
        margin: 15px 0;
    }
    
    button {
        border-radius: 20px;
        border: 1px solid #B28E6B;
        background-color:#B28E6B;
        color: #FFFFFF;
        font-size: 12px;
        font-weight: bold;
        padding: 12px 45px;
        letter-spacing: 1px;
        text-transform: uppercase;
        transition: transform 80ms ease-in;
    }
    
    button:active {
        transform: scale(0.95);
    }
    
    button:focus {
        outline: none;
    }
    
    button.ghost {
        background-color: transparent;
        border-color: #FFFFFF;
    }
    
    form {
        background-color: #FFFFFF;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        padding: 0 50px;
        height: 100%;
        text-align: center;
    }
    
    input {
        background-color: #eee;
        border: none;
        padding: 12px 15px;
        margin: 8px 0;
        width: 100%;
    }
    
    .container-1 {
        background-color: #fff;
        border-radius: 10px;
          box-shadow: 0 14px 28px rgba(0,0,0,0.25), 
                0 10px 10px rgba(0,0,0,0.22);
        position: relative;
        overflow: hidden;
        width: 768px;
        max-width: 100%;
        min-height: 480px;
    }
    
    .form-container {
        position: absolute;
        top: 0;
        height: 100%;
        transition: all 0.6s ease-in-out;
    }
    
    .sign-in-container {
        left: 0;
        width: 50%;
        z-index: 2;
    }
    
    .container-1.right-panel-active .sign-in-container {
        transform: translateX(100%);
    }
    
    .sign-up-container {
        left: 0;
        width: 50%;
        opacity: 0;
        z-index: 1;
    }
    
    .container-1.right-panel-active .sign-up-container {
        transform: translateX(100%);
        opacity: 1;
        z-index: 5;
        animation: show 0.6s;
    }
    
    @keyframes show {
        0%, 49.99% {
            opacity: 0;
            z-index: 1;
        }
        
        50%, 100% {
            opacity: 1;
            z-index: 5;
        }
    }
    
    .overlay-container {
        position: absolute;
        top: 0;
        left: 50%;
        width: 50%;
        height: 100%;
        overflow: hidden;
        transition: transform 0.6s ease-in-out;
        z-index: 100;
    }
    
    .container-1.right-panel-active .overlay-container{
        transform: translateX(-100%);
    }
    
    .overlay {
        background:#B28E6B;
        background-repeat: no-repeat;
        background-size: cover;
        background-position: 0 0;
        color: #FFFFFF;
        position: relative;
        left: -100%;
        height: 100%;
        width: 200%;
          transform: translateX(0);
        transition: transform 0.6s ease-in-out;
    }
    
    .container-1.right-panel-active .overlay {
          transform: translateX(50%);
    }
    
    .overlay-panel {
        position: absolute;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        padding: 0 40px;
        text-align: center;
        top: 0;
        height: 100%;
        width: 50%;
        transform: translateX(0);
        transition: transform 0.6s ease-in-out;
    }
    
    .overlay-left {
        transform: translateX(-20%);
    }
    
    .container-1.right-panel-active .overlay-left {
        transform: translateX(0);
    }
    
    .overlay-right {
        right: 0;
        transform: translateX(0);
    }
    
    .container-1.right-panel-active .overlay-right {
        transform: translateX(20%);
    }
    /* .overlay-panel .overlay-left {
        background-image: url('img/logo.png')
    } */
    </style>
    <body>
    <div class="container-1" id="container">
        <div class="form-container sign-up-container">
            <form action="/forgotpass" method="POST">
            @csrf
                <h1>Lupa Password</h1>
                <input type="email" placeholder="Email" name="email"/>
                <button>Kirim Email</button>
            </form>
        </div>
        <div class="form-container sign-in-container">
        <!-- ALERT -->
        <!-- FORM -->
            {{-- <form >
                <h1>MASUK</h1>
                <input type="text" placeholder="ID Admin" name="username"required/>
                <input type="password" placeholder="Password" name="password"required/>
                <button type = "submit">MASUK</button>
            </form> --}}
            <img src="/assets/img/logo.png" style="width: 60%; margin-bottom: 10%;margin-top: 140px;">
        </div>
        <div class="overlay-container">
            <div class="overlay">
                {{-- <div class="overlay-panel overlay-left"> --}}
                    {{-- <h1>KUTUS - KUTUS</h1>
                    <p>Silahkan masuk jika sudah punya akun</p>
                    <button class="ghost" id="signIn">MASUK</button>
                </div> --}}
                <div class="overlay-panel overlay-right">
                    <h3 > Laporan Penjualan Bulanan</h3>
                    {{-- <img src="assets/img/logo.png" style="width: 50%; margin-bottom: 10%;"> --}}
                    <h2 style="margin-bottom: 5px"> Pilih Bulan</h2>
                    <!-- <p>Silahkan membuat akun jika belum punya akun</p> -->
                    <select class="form-control mt-2 ab-t-rpt-4" style="height: 40px;
                    width: 120px; font-size:18px;" name="month">
                        <option value="1">Januari</option>
                        <option value="2">Februari</option>
                        <option value="3">Maret</option>
                        <option value="4">April</option>
                        <option value="5">Mei</option>
                        <option value="6">Juni</option>
                        <option value="7">Juli</option>
                        <option value="8">Agustus</option>
                        <option value="9">September</option>
                        <option value="10">Oktober</option>
                        <option value="11">November</option>
                        <option value="12">Desember</option>
                    </select>
                    <button type="submit" id="signUp" class="ghost"style="margin-top: 15px;">Pilih</button>
                </div>
            </div>
        </div>
    
</form>