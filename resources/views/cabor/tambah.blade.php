<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Sistem Kelola Database KONI</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('gambar_aset/images/koni.png') }}">
    <link rel="stylesheet" href="{{ asset('gambar_aset/vendor/owl-carousel/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('gambar_aset/vendor/owl-carousel/css/owl.theme.default.min.css') }}">
    <link href="{{ asset('gambar_aset/vendor/jqvmap/css/jqvmap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('gambar_aset/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('gambar_aset/vendor/datatables/css/jquery.dataTables.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('gambar_aset/assets/vendor/fonts/boxicons.css') }}" />
</head>

<body>

    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="sk-three-bounce">
            <div class="sk-child sk-bounce1"></div>
            <div class="sk-child sk-bounce2"></div>
            <div class="sk-child sk-bounce3"></div>
        </div>
    </div>
    <!--*******************
        Preloader end
    ********************-->

    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">

        <!--**********************************
            Nav header start
        ***********************************-->
        <div class="nav-header">
            <a href="/coba" class="brand-logo">
                <img class="logo-abbr" src="{{ asset('gambar_aset/images/koni.png') }}" alt="" style="margin-left: 10px; border-radius: 50%;">
                <span class="fw-bolder d-none d-md-inline" style="margin-left: 10px; font-size: 18px; font-weight: 300">Sistem Kelola KONI</span>
            </a>

            <div class="nav-control">
                <div class="hamburger">
                    <span class="line"></span><span class="line"></span><span class="line"></span>
                </div>
            </div>
        </div>
        <!--**********************************
            Nav header end
        ***********************************-->

        <!--**********************************
            Header start
        ***********************************-->
        @include('layouts/header')
        <!--**********************************
            Header end
        ***********************************-->

        <!--**********************************
            Sidebar start
        ***********************************-->
        @include('layouts/sidebar')
        <!--**********************************
            Sidebar end
        ***********************************-->

        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <div class="container-fluid">
                <div class="row page-titles mx-0">
                    <div class="col-sm-6 p-md-0">
                        <div class="welcome-text">
                            <h4>Hi, Selamat Datang kembali!</h4>
                            <p class="mb-1"><span class="text-success">{{ Auth::user()->name }},</span> Anda login sebagai <span class="text-success">{{ Auth::user()->level }}</span></p>
                        </div>
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Cabor</a></li>
                            <li class="breadcrumb-item active"><a href="javascript:void(0)">Tambah +</a></li>
                        </ol>
                    </div>
                </div>
                <!-- row -->
                <div class="row">
                    <div class="col-xxl">
                        <div class="card mb-4">
                            <div class="card-header d-flex align-items-center justify-content-between">
                                <h5 class="mb-0">Tambah Data Kategori Olahraga</h5>
                            </div>
                            <div class="card-body">
                                <form action="/sportcategories" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row mb-3">
                                        <label class="col-sm-2 col-form-label" for="nama_cabor">Nama Federasi</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="nama_cabor" class="form-control" placeholder="Masukkan nama kategori olahraga..." required />
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="cabor" class="col-sm-2 col-form-label">Nama Cabor</label>
                                        <div class="col-sm-8">
                                            <input type="text" name="sport_category" class="form-control" placeholder="Tulis nama cabor (ex : Sepak Bola)" />
                                        </div>
                                      </div>
                                    <div class="row mb-3">
                                        <label for="deskripsi" class="col-sm-2 col-form-label">Deskripsi</label>
                                        <div class="col-sm-10">
                                            <textarea name="deskripsi" class="form-control" placeholder="Masukkan deskripsi kategori olahraga..."></textarea>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="puslatcab" class="col-sm-2 col-form-label">Pusat Latihan Cabang</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="puslatcab" class="form-control" placeholder="Masukkan pusat latihan cabang..." />
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="kontak" class="col-sm-2 col-form-label">Kontak</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="kontak" class="form-control" placeholder="Masukkan kontak (nomor telepon/email)..." />
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="level" class="col-sm-2 col-form-label">Level</label>
                                        <div class="col-sm-4">
                                            <input type="text" name="level" class="form-control" placeholder="ex : Pengurus Cabor Sepakbola" />
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label class="col-sm-2 col-form-label" for="gambar">Logo</label>
                                        <div class="col-sm-4">
                                            <input class="form-control" type="file" name="logo" id="gambar"
                                                onchange="previewImage()" />
                                            <img id="preview" src="#" alt="Preview logo"
                                                class="img-fluid mt-3 d-none"
                                                style="max-height: 200px; border: 1px solid #ddd; padding: 5px;" />
                                        </div>
                                    </div>
                                    <div class="row justify-content-end">
                                        <div class="col-sm-10">
                                            <button type="submit" class="btn btn-primary">Tambah Kategori Olahraga</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                
                
                
                <!--**********************************
                    Content body end
                ***********************************-->

            </div>
        </div>
        @include('layouts/footer')
        <!--**********************************
            Main wrapper end
        ***********************************-->

        <!--**********************************
           Scripts
        ***********************************-->
        <script src="{{ asset('gambar_aset/vendor/global/global.min.js') }}"></script>
        <script src="{{ asset('gambar_aset/js/quixnav-init.js') }}"></script>
        <script src="{{ asset('gambar_aset/js/custom.min.js') }}"></script>
        <script src="{{ asset('gambar_aset/vendor/datatables/js/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('gambar_aset/js/plugins-init/datatables.init.js') }}"></script>
        <script src="{{ asset('gambar_aset/js/sport-category.js') }}"></script>
        <script src="{{ asset('gambar_aset/js/imgpreview.js') }}"></script>

    </div>
</body>

</html>
