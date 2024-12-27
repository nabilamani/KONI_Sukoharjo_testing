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

    <div id="preloader">
        <div class="sk-three-bounce">
            <div class="sk-child sk-bounce1"></div>
            <div class="sk-child sk-bounce2"></div>
            <div class="sk-child sk-bounce3"></div>
        </div>
    </div>

    <div id="main-wrapper">
        <div class="nav-header">
            <a href="/home" class="brand-logo">
                <img class="logo-abbr" src="{{ asset('gambar_aset/images/koni.png') }}" alt="Logo"
                    style="margin-left: 10px; border-radius: 50%;">
                <span class="fw-bolder d-none d-md-inline" style="margin-left: 10px; font-size: 18px; font-weight: 300">Sistem Kelola
                    KONI</span>
            </a>
            <div class="nav-control">
                <div class="hamburger">
                    <span class="line"></span><span class="line"></span><span class="line"></span>
                </div>
            </div>
        </div>

        @include('layouts/header')

        @include('layouts/sidebar')

        <!-- Main content start -->
        <div class="content-body">
            <div class="container-fluid">
                <div class="row page-titles mx-0">
                    <div class="col-sm-6 p-md-0">
                        <div class="welcome-text">
                            <h4>Tambah Event Baru</h4>
                            <p class="mb-1">Formulir untuk menambahkan event KONI baru</p>
                        </div>
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end d-flex">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Event</a></li>
                            <li class="breadcrumb-item active"><a href="javascript:void(0)">Tambah +</a></li>
                        </ol>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xxl">
                        <div class="card mb-4">
                            <div class="card-header d-flex align-items-center justify-content-between">
                                <h5 class="mb-0">Tambah Data Event</h5>
                            </div>
                            <div class="card-body">
                                <form action="/events" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row mb-3">
                                        <label class="col-sm-2 col-form-label" for="name">Nama Event</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="name" class="form-control"
                                                placeholder="Masukkan nama event..." required />
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label class="col-sm-2 col-form-label" for="event_date">Tanggal</label>
                                        <div class="col-sm-4">
                                            <input type="date" name="event_date" class="form-control"
                                                placeholder="Masukkan durasi event..." required />
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
                                        <label class="col-sm-2 col-form-label" for="location">Lokasi</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="location" class="form-control"
                                                placeholder="Masukkan lokasi event..." required />
                                        </div>
                                    </div>

                                    <!-- Banner Input -->
                                    <div class="row mb-3">
                                        <label class="col-sm-2 col-form-label" for="banner">Banner/Foto</label>
                                        <div class="col-sm-10">
                                            <input type="file" name="banner" class="form-control"
                                                accept="image/*" />
                                        </div>
                                    </div>

                                    <!-- Lokasi Peta (iframe) -->
                                    <div class="row mb-3">
                                        <label class="col-sm-2 col-form-label" for="location_map">Peta
                                            (iframe)</label>
                                        <div class="col-sm-10">
                                            <textarea name="location_map" class="form-control" placeholder="Masukkan iframe peta..." required></textarea>
                                            <small class="form-text text-muted">
                                                Masukkan kode iframe dari Google Maps.
                                                <a href="https://www.google.com/maps" target="_blank"
                                                    class="text-primary">Buka Google Maps</a> untuk mendapatkan iframe.
                                            </small>
                                        </div>
                                    </div>


                                    <div class="row justify-content-end">
                                        <div class="col-sm-10">
                                            <button type="submit" class="btn btn-primary">Tambah Event</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        @include('layouts/footer')
        <!-- Main content end -->
    </div>

    Scripts
    ***********************************-->
    <!-- Required vendors -->
    <script src="{{ asset('gambar_aset/vendor/global/global.min.js') }}"></script>
    <script src="{{ asset('gambar_aset/js/quixnav-init.js') }}"></script>
    <script src="{{ asset('gambar_aset/js/custom.min.js') }}"></script>


    <!-- Vectormap -->
    <script src="{{ asset('gambar_aset/vendor/raphael/raphael.min.js') }}"></script>
    <script src="{{ asset('gambar_aset/vendor/morris/morris.min.js') }}"></script>


    <script src="{{ asset('gambar_aset/vendor/circle-progress/circle-progress.min.js') }}"></script>
    <script src="{{ asset('gambar_aset/vendor/chart.js') }}/Chart.bundle.min.js') }}"></script>

    <script src="{{ asset('gambar_aset/vendor/gaugeJS/dist/gauge.min.js') }}"></script>

    <!--  flot-chart js -->
    <script src="{{ asset('gambar_aset/vendor/flot/jquery.flot.js') }}"></script>
    <script src="{{ asset('gambar_aset/vendor/flot/jquery.flot.resize.js') }}"></script>

    <!-- Owl Carousel -->
    <script src="{{ asset('gambar_aset/vendor/owl-carousel/js/owl.carousel.min.js') }}"></script>

    <!-- Counter Up -->
    <script src="{{ asset('gambar_aset/vendor/jqvmap/js/jquery.vmap.min.js') }}"></script>
    <script src="{{ asset('gambar_aset/vendor/jqvmap/js/jquery.vmap.usa.js') }}"></script>
    <script src="{{ asset('gambar_aset/vendor/jquery.counterup/jquery.counterup.min.js') }}"></script>


    <script src="{{ asset('gambar_aset/js/dashboard/dashboard-1.js') }}"></script>

    <!-- Datatable -->
    <script src="{{ asset('gambar_aset/vendor/datatables/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('gambar_aset/js/plugins-init/datatables.init.js') }}"></script>
    <script src="{{ asset('gambar_aset/js/sport-category.js') }}"></script>
</body>

</html>
