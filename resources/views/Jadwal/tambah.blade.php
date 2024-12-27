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
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Jadwal Pertandingan</a></li>
                            <li class="breadcrumb-item active"><a href="javascript:void(0)">Tambah +</a></li>
                        </ol>
                    </div>
                </div>
                <!-- row -->
                <div class="row">
                    <div class="col-xxl">
                        <div class="card mb-4">
                            <div class="card-header d-flex align-items-center justify-content-between">
                                <h5 class="mb-0">Tambah Data Schedule</h5>
                            </div>
                            <div class="card-body">
                                <form action="/schedules" method="post">
                                    @csrf
                                    <div class="row mb-3">
                                        <label class="col-sm-2 col-form-label" for="name">Nama Pertandingan</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="name" class="form-control" placeholder="Masukkan nama pertandingan..." required />
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label class="col-sm-2 col-form-label" for="date">Tanggal Pertandingan</label>
                                        <div class="col-sm-4">
                                            <input type="date" name="date" class="form-control" required />
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="sportCategorySelect" class="col-sm-2 col-form-label">Pilih
                                            Cabor</label>
                                        <div class="col-sm-4">
                                            <select id="sportCategorySelect" name="sport_category"
                                                class="form-control sport-category-select">
                                                <option value="" hidden selected disabled>Pilih kategori..
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label class="col-sm-2 col-form-label" for="venue_name">Nama Tempat</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="venue_name" class="form-control" placeholder="Masukkan nama tempat..." required />
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label class="col-sm-2 col-form-label" for="venue_map">Peta (iframe)</label>
                                        <div class="col-sm-10">
                                            <textarea name="venue_map" class="form-control" placeholder="Masukkan iframe peta..." required></textarea>
                                            <small class="form-text text-muted">Masukkan kode iframe dari Google Maps.</small>
                                        </div>
                                    </div>
                                    <div class="row justify-content-end">
                                        <div class="col-sm-10">
                                            <button type="submit" class="btn btn-primary">Tambah Schedule</button>
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

    </div>
</body>

</html>
