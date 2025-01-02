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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"
        integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />


</head>
<style>
    .card {
        border-bottom: 3px solid orange;
        /* You can adjust the width (3px) as needed */
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        background-color: #FDEED6;
    }

    .card-hover:hover {
        transform: translateY(-8px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
    }

    .icon-block {
        width: 60px;
        height: 60px;
    }

    .count {
        font-size: 2.5rem;
        font-weight: bold;
    }

    .text-primary {
        color: #007bff !important;
    }

    .text-secondary {
        color: #6c757d !important;
    }

    .hover-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        border-radius: 8px;
    }

    .hover-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
    }

    .card-title {
        font-weight: bold;
        color: #343a40;
        transition: color 0.3s ease;
    }

    .hover-card:hover .card-title {
        color: #FF9800;
    }

    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
        transition: background-color 0.3s ease, box-shadow 0.3s ease;
    }

    .btn-primary:hover {
        background-color: #0056b3;
        box-shadow: 0 5px 15px rgba(0, 123, 255, 0.3);
    }
</style>

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
                <img class="logo-abbr" src="{{ asset('gambar_aset/images/koni.png') }}" alt=""
                    style="margin-left: 10px; border-radius: 50%;">
                <span class="fw-bolder d-none d-md-inline" style="margin-left: 10px; font-size: 18px; font-weight: 300">Sistem
                    Kelola KONI</span>
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
            Header end ti-comment-alt
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
                <div class="row page-titles mx-0 mb-0 shadow-sm" style="background-color: #FDEED6">
                    <div class="col-sm-6 p-md-0">
                        <div class="welcome-text">
                            <h4>Hi, Selamat Datang Kembali!</h4>
                            <p class="mb-1"><span class="text-success">{{ Auth::user()->name }},</span> Anda login
                                sebagai <span class="text-success">{{ Auth::user()->level }}</span></p>
                        </div>
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                            <li class="breadcrumb-item active"><a href="javascript:void(0)">View</a></li>
                        </ol>
                    </div>
                </div>
                <!-- row -->
                <div class="row">
                    <!-- Basic Layout -->
                    <div class="container">

                        <!-- Row 1: Summary Statistics -->
                        <div class="row">
                            <!-- Total Athletes -->
                            <div class="col-xl-3 col-lg-6 col-sm-6">
                                <div class="card mb-3 shadow-lg rounded card-hover">
                                    <div class="card-body d-flex justify-content-between align-items-center">
                                        <!-- Bagian Kiri: Teks dan Count -->
                                        <div>
                                            <h2 class="count mb-1 text-primary" data-count="{{ $athleteCount }}">0</h2>
                                            <p class="text-secondary mb-0">Total Atlet</p>
                                        </div>

                                        <!-- Bagian Kanan: Icon -->
                                        <div
                                            class="icon-block bg-primary text-white rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="mdi mdi-account-multiple font-size-40"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <!-- Total Events -->
                            <div class="col-xl-3 col-lg-6 col-sm-6">
                                <div class="card mb-3 shadow-lg rounded card-hover">
                                    <div class="card-body d-flex justify-content-between align-items-center">
                                        <!-- Bagian Kiri: Teks dan Count -->
                                        <div>
                                            <h2 class="count mb-1 text-primary" data-count="{{ $eventCount }}">0</h2>
                                            <p class="text-secondary mb-0">Total Event</p>
                                        </div>

                                        <!-- Bagian Kanan: Icon -->
                                        <div
                                            class="icon-block bg-primary text-white rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bx bx-calendar font-size-50"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <!-- Total Achievements -->
                            <div class="col-xl-3 col-lg-6 col-sm-6">
                                <div class="card mb-3 shadow-lg rounded card-hover">
                                    <div class="card-body d-flex justify-content-between align-items-center">
                                        <!-- Bagian Kiri: Teks dan Count -->
                                        <div>
                                            <h2 class="count mb-1 text-primary" data-count="{{ $achievementCount }}">0
                                            </h2>
                                            <p class="text-secondary mb-0">Total Prestasi</p>
                                        </div>

                                        <!-- Bagian Kanan: Icon -->
                                        <div
                                            class="icon-block bg-primary text-white rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bx bx-trophy font-size-50"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <!-- Total Coaches -->
                            <div class="col-xl-3 col-lg-6 col-sm-6">
                                <div class="card mb-3 shadow-lg rounded card-hover">
                                    <div class="card-body d-flex justify-content-between align-items-center">
                                        <!-- Bagian Kiri: Teks dan Count -->
                                        <div>
                                            <h2 class="count mb-1 text-primary" data-count="{{ $coachCount }}">0</h2>
                                            <p class="text-secondary mb-0">Total Pelatih</p>
                                        </div>

                                        <!-- Bagian Kanan: Icon -->
                                        <div
                                            class="icon-block bg-primary text-white rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bx bx-user-circle font-size-50"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <!-- Toggle More Info -->
                            <div class="col-12 text-center mb-2">
                                <a href="#" id="toggle-more-info" class="pt-0 mt-0"
                                    style="width: 50px; height: 50px;">
                                    <i class="bx bx-chevron-down font-size-30"></i>
                                </a>
                            </div>



                            <!-- Additional Stats (Hidden by Default) -->
                            <div id="more-info" class="row col-12 mx-0 px-0" style="display: none;">
                                <!-- Total Referees -->
                                <div class="col-xl-3 col-lg-6 col-sm-6">
                                    <div class="card mb-3 shadow-lg rounded card-hover">
                                        <div class="card-body d-flex justify-content-between align-items-center">
                                            <!-- Bagian Kiri: Teks dan Count -->
                                            <div>
                                                <h2 class="count mb-1 text-primary"
                                                    data-count="{{ $refereeteCount }}">0</h2>
                                                <p class="text-secondary mb-0">Total Wasit</p>
                                            </div>

                                            <!-- Bagian Kanan: Icon -->
                                            <div
                                                class="icon-block bg-primary text-white rounded-circle d-flex align-items-center justify-content-center">
                                                <i class="bx bx-id-card font-size-50"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <!-- Total Venues -->
                                <div class="col-xl-3 col-lg-6 col-sm-6">
                                    <div class="card mb-3 shadow-lg rounded card-hover">
                                        <div class="card-body d-flex justify-content-between align-items-center">
                                            <!-- Bagian Kiri: Teks dan Count -->
                                            <div>
                                                <h2 class="count mb-1 text-primary" data-count="{{ $venueCount }}">
                                                    0</h2>
                                                <p class="text-secondary mb-0">Total Venue</p>
                                            </div>

                                            <!-- Bagian Kanan: Icon -->
                                            <div
                                                class="icon-block bg-primary text-white rounded-circle d-flex align-items-center justify-content-center">
                                                <i class="bx bx-map font-size-50"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <!-- Total Sports -->
                                <div class="col-xl-3 col-lg-6 col-sm-6">
                                    <div class="card mb-3 shadow-lg rounded card-hover">
                                        <div class="card-body d-flex justify-content-between align-items-center">
                                            <!-- Bagian Kiri: Teks dan Count -->
                                            <div>
                                                <h2 class="count mb-1 text-primary" data-count="{{ $caborCount }}">
                                                    0</h2>
                                                <p class="text-secondary mb-0">Total Cabor</p>
                                            </div>

                                            <!-- Bagian Kanan: Icon -->
                                            <div
                                                class="icon-block bg-primary text-white rounded-circle d-flex align-items-center justify-content-center">
                                                <i class="bx bx-basketball font-size-50"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <!-- Total Accounts -->
                                <div class="col-xl-3 col-lg-6 col-sm-6">
                                    <div class="card mb-3 shadow-lg rounded card-hover">
                                        <div class="card-body d-flex justify-content-between align-items-center">
                                            <!-- Bagian Kiri: Teks dan Count -->
                                            <div>
                                                <h2 class="count mb-1 text-primary" data-count="{{ $userCount }}">
                                                    0</h2>
                                                <p class="text-secondary mb-0">Total Akun</p>
                                            </div>

                                            <!-- Bagian Kanan: Icon -->
                                            <div
                                                class="icon-block bg-primary text-white rounded-circle d-flex align-items-center justify-content-center">
                                                <i class="bx bx-user font-size-50"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>


                        <!-- Row 3: Latest berita -->
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="card-title">Berita Terbaru</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            @if ($beritas->isEmpty())
                                                <div class="col-12">
                                                    <div class="alert alert-dark text-center">
                                                        <i class="mdi mdi-information-outline me-1"></i>
                                                        Belum ada berita yang tersedia saat ini.
                                                    </div>
                                                </div>
                                            @else
                                                @foreach ($beritas as $berita)
                                                    <div class="col-lg-4 col-md-6 mb-4">
                                                        <div
                                                            class="card border bg-white shadow-sm h-100 position-relative hover-card">
                                                            <img src="{{ asset($berita->photo) }}"
                                                                class="card-img-top img-fluid"
                                                                alt="{{ $berita->judul_berita }}"
                                                                style="object-fit: cover; height: 200px; border-radius: 8px 8px 0 0;">
                                                            <div class="card-body d-flex flex-column">
                                                                <h5 class="card-title">{{ $berita->judul_berita }}
                                                                </h5>
                                                                <p class="card-text text-muted mb-2"
                                                                    style="font-size: 12px;">
                                                                    <i class="mdi mdi-calendar me-1"></i>
                                                                    {{ \Carbon\Carbon::parse($berita->tanggal_waktu)->format('d-m-Y H:i') }}
                                                                </p>
                                                                <p class="card-text mb-2">
                                                                    {{ Str::limit(strip_tags($berita->isi_berita), 100) }}
                                                                </p>
                                                                <p class="card-text mb-2">
                                                                    <i class="mdi mdi-map-marker-outline me-1"></i>
                                                                    <strong>Lokasi:</strong>
                                                                    {{ $berita->lokasi_peristiwa }}
                                                                </p>
                                                                <p class="card-text mb-3">
                                                                    <i class="mdi mdi-bookmark-outline me-1"></i>
                                                                    <strong>Sumber:</strong>
                                                                    {{ $berita->kutipan_sumber }}
                                                                </p>
                                                                <button type="button"
                                                                    class="btn btn-warning btn-sm mt-auto text-white"
                                                                    data-toggle="modal"
                                                                    data-target="#newsDetailModal{{ $berita->id }}">
                                                                    Selengkapnya
                                                                </button>
                                                            </div>
                                                        </div>

                                                    </div>

                                                    <!-- Modal for News Details -->
                                                    <div class="modal fade" id="newsDetailModal{{ $berita->id }}"
                                                        tabindex="-1" role="dialog"
                                                        aria-labelledby="newsDetailModalLabel{{ $berita->id }}"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog modal-lg px-3" role="document">
                                                            <div class="modal-content">
                                                                <!-- Header -->
                                                                <div class="modal-header bg-primary text-white">
                                                                    <h5 class="modal-title"
                                                                        id="newsDetailModalLabel{{ $berita->id }}">
                                                                        <i class="mdi mdi-newspaper me-2"> </i>Berita
                                                                        Selengkapnya:
                                                                        {{ $berita->judul_berita }}
                                                                    </h5>
                                                                    <button type="button" class="close"
                                                                        data-dismiss="modal" aria-label="Close">
                                                                </div>

                                                                <!-- Body -->
                                                                <div class="modal-body">
                                                                    <div class="row">
                                                                        <!-- News Image -->
                                                                        <div class="col-md-5">
                                                                            @if ($berita->photo)
                                                                                <img src="{{ asset($berita->photo) }}"
                                                                                    alt="Foto Berita"
                                                                                    class="img-fluid rounded shadow-sm mb-3"
                                                                                    style="width: 100%; object-fit: cover;">
                                                                            @else
                                                                                <div class="d-flex align-items-center justify-content-center bg-light border rounded shadow-sm"
                                                                                    style="height: 250px;">
                                                                                    <i
                                                                                        class="mdi mdi-image-off-outline mdi-48px text-muted"></i>
                                                                                </div>
                                                                            @endif
                                                                            <div class="mb-3 p-3 rounded shadow-sm"
                                                                                style="background-color: #f8f9fa;">
                                                                                <p class="mb-3">
                                                                                    <strong class="text-primary"><i
                                                                                            class="mdi mdi-bookmark-outline me-2"></i>Judul
                                                                                        Berita:</strong><br>
                                                                                    <span
                                                                                        class="text-dark">{{ $berita->judul_berita }}</span>
                                                                                </p>
                                                                                <p class="mb-3">
                                                                                    <strong class="text-success"><i
                                                                                            class="mdi mdi-calendar me-2"></i>Tanggal
                                                                                        Waktu:</strong><br>
                                                                                    <span
                                                                                        class="text-muted">{{ \Carbon\Carbon::parse($berita->tanggal_waktu)->format('d-m-Y H:i') }}</span>
                                                                                </p>
                                                                                <p class="mb-3">
                                                                                    <strong class="text-info"><i
                                                                                            class="mdi mdi-map-marker-outline me-2"></i>Lokasi
                                                                                        Peristiwa:</strong><br>
                                                                                    <span
                                                                                        class="text-dark">{{ $berita->lokasi_peristiwa }}</span>
                                                                                </p>
                                                                                <p class="mb-0">
                                                                                    <strong class="text-warning"><i
                                                                                            class="mdi mdi-source-branch me-2"></i>Kutipan
                                                                                        Sumber:</strong><br>
                                                                                    <span
                                                                                        class="text-muted">{{ $berita->kutipan_sumber }}</span>
                                                                                </p>
                                                                            </div>

                                                                        </div>

                                                                        <!-- News Details -->
                                                                        <div class="col-md-7">


                                                                            <div class="mb-3">

                                                                                <div
                                                                                    class="bg-light p-3 rounded shadow-sm">
                                                                                    {!! $berita->isi_berita !!}
                                                                                </div>
                                                                            </div>


                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <!-- Footer -->
                                                                <div class="modal-footer bg-light">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-dismiss="modal">Tutup</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>



                        <!-- Row 2: Rekapan Prestasi Cabang Olahraga -->
                        <div class="row">
                            <!-- Rekapan Prestasi Cabor -->
                            <div class="col-xl-6">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="card-title">Prestasi Terbaru Cabang Olahraga</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-bordered bg-white" style="min-width: 900px;">
                                                <thead class="thead-dark">
                                                    <tr>
                                                        <th>Nama Atlet/Team</th>
                                                        <th>Cabang Olahraga</th>
                                                        <th>Tanggal</th>
                                                        <th>Jenis Event</th>
                                                        <th>Keterangan</th>
                                                    </tr>
                                                </thead>
                                                <tbody style="color: rgb(114, 114, 114)">
                                                    @if ($achievements->isEmpty())
                                                        <tr>
                                                            <td colspan="4" class="text-center text-muted">
                                                                <i class="mdi mdi-information-outline me-1"></i>
                                                                Belum ada data prestasi yang tersedia.
                                                            </td>
                                                        </tr>
                                                    @else
                                                        @foreach ($achievements as $achievement)
                                                            <tr>
                                                                <td>{{ $achievement->athlete_name }}</td>
                                                                <td>{{ $achievement->sport_category }}</td>
                                                                <td>{{ $achievement->certificate_date }}</td>
                                                                <td>{{ $achievement->event_type }}</td>
                                                                <td>{{ $achievement->description }}</td>
                                                            </tr>
                                                        @endforeach
                                                    @endif
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>                                
                            </div>


                            <!-- Tabel Event Mendatang -->
                            <div class="col-xl-6">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="card-title">Event Mendatang</h5>
                                    </div>
                                    <div class="card-body">
                                        <table class="table table-bordered bg-white">
                                            <thead class="thead-dark">
                                                <tr>
                                                    <th>Nama Event</th>
                                                    <th>Tanggal</th>
                                                    <th>Lokasi</th>
                                                </tr>
                                            </thead>
                                            <tbody style="color: rgb(114, 114, 114)">
                                                @if ($upcomingEvents->isEmpty())
                                                    <tr>
                                                        <td colspan="3" class="text-center text-muted">
                                                            <i class="mdi mdi-calendar-remove me-1"></i>
                                                            Tidak ada event yang akan datang.
                                                        </td>
                                                    </tr>
                                                @else
                                                    @foreach ($upcomingEvents as $event)
                                                        <tr>
                                                            <td>{{ $event->name }}</td>
                                                            <td>{{ \Carbon\Carbon::parse($event->event_date)->format('d-m-Y') }}
                                                            </td>
                                                            <td>{{ $event->location }}</td>
                                                        </tr>
                                                    @endforeach
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('layouts/footer')
    <!--**********************************
            Content body end
        ***********************************-->



    <!--**********************************
           Support ticket button start
        ***********************************-->

    <!--**********************************
           Support ticket button end
        ***********************************-->




    <!--**********************************
        Main wrapper end
    ***********************************-->

    <!--**********************************
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

    <!-- Counting Animation Script -->
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const counters = document.querySelectorAll('.count');
            const animationDuration = 2000; // Duration in milliseconds (2 seconds)

            counters.forEach(counter => {
                const target = +counter.getAttribute('data-count');
                const frameRate = 20; // Update the count every 20ms
                const totalFrames = animationDuration / frameRate;
                const increment = target / totalFrames;

                let currentCount = 0;

                const updateCount = () => {
                    currentCount += increment;

                    if (currentCount < target) {
                        counter.innerText = Math.ceil(currentCount);
                        setTimeout(updateCount, frameRate);
                    } else {
                        counter.innerText = target; // Set the final count
                    }
                };

                updateCount();
            });
        });
    </script>
    <script>
        document.getElementById("toggle-more-info").addEventListener("click", function(event) {
            event.preventDefault();
            const moreInfoSection = document.getElementById("more-info");
            if (moreInfoSection.style.display === "none") {
                moreInfoSection.style.display = "flex";
                this.innerHTML = '<i class="bx bx-chevron-up font-size-30"></i> Sembunyikan';
            } else {
                moreInfoSection.style.display = "none";
                this.innerHTML = '<i class="bx bx-chevron-down font-size-30"></i> Selengkapnya';
            }
        });
    </script>
    <script src="{{ asset('gambar_aset/js/sport-category.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
        integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    @if (Session::has('message'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                toastr.options = {
                    "closeButton": true, // Menambahkan tombol close
                    "progressBar": true, // Menampilkan progress bar
                    "positionClass": "toast-top-right", // Mengubah posisi alert
                    "showDuration": "1000", // Durasi animasi muncul (ms)
                    "hideDuration": "1000", // Durasi animasi hilang (ms)
                    "timeOut": "5000", // Waktu tampil (ms)
                    "extendedTimeOut": "1000", // Waktu ekstra saat hover (ms)
                    "showEasing": "swing", // Animasi muncul
                    "hideEasing": "linear", // Animasi hilang
                    "showMethod": "fadeIn", // Metode muncul
                    "hideMethod": "fadeOut" // Metode hilang
                };

                toastr.success("{{ Session::get('message') }}", "Berhasil!"); // Judul alert
            });
        </script>
    @endif




</body>

</html>
