{{-- @dd($coaches) --}}

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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"
        integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>


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
                <img class="logo-abbr" src="{{ asset('gambar_aset/images/koni.png') }}" alt=""
                    style="margin-left: 10px; border-radius: 50%; ">
                <span class="fw-bolder d-none d-md-inline"
                    style="margin-left: 10px; font-size: 18px; font-weight: 300">Sistem Kelola
                    KONI</span>
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
                <div class="row page-titles mx-0">
                    <div class="col-sm-6 p-md-0">
                        <div class="welcome-text">
                            <h4>Hi, Selamat Datang!</h4>
                            <p class="mb-1"><span class="text-success">{{ Auth::user()->name }},</span> Anda login
                                sebagai <span class="text-success">{{ Auth::user()->level }}</span></p>
                        </div>
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Jadwal Pertandingan</a></li>
                            <li class="breadcrumb-item active"><a href="javascript:void(0)">Daftar Jadwal</a></li>
                        </ol>
                    </div>
                </div>
                <!-- row -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Daftar Schedule</h4>
                                <form action="{{ route('schedules.index') }}" method="GET" class="form-inline">
                                    <input type="text" name="search" class="form-control mr-2"
                                        placeholder="Cari schedule..." value="{{ request('search') }}">
                                    <button type="submit" class="btn btn-outline-primary">Cari</button>
                                </form>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="scheduleTable" class="table table-striped table-hover"
                                        style="min-width: 845px;">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th>No</th>
                                                <th>Keperluan Latihan</th>
                                                <th>Tanggal</th>
                                                <th>Waktu</th>
                                                <th>Kategori Olahraga</th>
                                                <th>Tempat</th>
                                                <th>Peta</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody class="text-dark">
                                            @php
                                                $no = ($schedules->currentPage() - 1) * $schedules->perPage() + 1;
                                            @endphp
                                            @forelse ($schedules as $schedule)
                                                <tr>
                                                    <td>{{ $no++ }}</td>
                                                    <td>{{ $schedule->name }}</td>
                                                    <td>{{ \Carbon\Carbon::parse($schedule->date)->format('d M Y') }}
                                                    </td>
                                                    <td>{{ \Carbon\Carbon::parse($schedule->time)->format('H:i') }}
                                                    </td>
                                                    <td>{{ $schedule->sportCategory->sport_category ?? 'Semua' }}</td>
                                                    <td>{{ $schedule->venue_name }}</td>
                                                    <td>
                                                        <a href="#scheduleMapModal{{ $schedule->id }}"
                                                            data-toggle="modal"
                                                            class="btn btn-outline-info btn-sm">Lihat Peta</a>
                                                    </td>
                                                    <td>
                                                        <div class="dropdown">
                                                            <button
                                                                class="btn btn-outline-primary btn-sm dropdown-toggle"
                                                                type="button" data-toggle="dropdown"
                                                                aria-expanded="false">
                                                                Aksi
                                                            </button>
                                                            <div class="dropdown-menu">
                                                                <a class="dropdown-item" href="#"
                                                                    data-toggle="modal"
                                                                    data-target="#scheduleDetailModal{{ $schedule->id }}">
                                                                    <i class="bx bx-info-circle"></i> Lihat Detail
                                                                </a>
                                                                <a class="dropdown-item" href="#"
                                                                    data-toggle="modal"
                                                                    data-target="#scheduleEditModal{{ $schedule->id }}">
                                                                    <i class="bx bx-edit-alt"></i> Edit
                                                                </a>
                                                                <form action="/delete-schedule/{{ $schedule->id }}"
                                                                    method="POST" class="d-inline">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" class="dropdown-item"
                                                                        onclick="return confirm('Apakah Anda yakin ingin menghapus schedule ini?')">
                                                                        <i class="bx bx-trash"></i> Hapus
                                                                    </button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="7" class="text-center">
                                                        <div
                                                            class="d-flex justify-content-center align-items-center my-2">
                                                            <i class="mdi mdi-alert-circle-outline me-2"
                                                                style="font-size: 20px;"></i>
                                                            <span class="fs-8">Saat ini belum ada data daftar jadwal
                                                                pertandingan.</span>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>

                                    <!-- Modals for each Schedule -->
                                    @foreach ($schedules as $schedule)
                                        <!-- Modal for Schedule Map -->
                                        <div class="modal fade" id="scheduleMapModal{{ $schedule->id }}"
                                            tabindex="-1" role="dialog"
                                            aria-labelledby="scheduleMapModalLabel{{ $schedule->id }}"
                                            aria-hidden="true">
                                            <div class="modal-dialog modal-lg" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-info text-white">
                                                        <h5 class="modal-title"
                                                            id="scheduleMapModalLabel{{ $schedule->id }}">Peta Tempat:
                                                            {{ $schedule->venue_name }}</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body p-3">
                                                        <iframe src="{{ $schedule->venue_map }}" width="100%"
                                                            height="400" style="border:0;" allowfullscreen=""
                                                            loading="lazy"></iframe>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Tutup</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Modal for Schedule Details -->
                                        <div class="modal fade" id="scheduleDetailModal{{ $schedule->id }}"
                                            tabindex="-1" role="dialog"
                                            aria-labelledby="scheduleDetailModalLabel{{ $schedule->id }}"
                                            aria-hidden="true">
                                            <div class="modal-dialog modal-lg" role="document">
                                                <div class="modal-content shadow-lg">
                                                    <!-- Modal Header -->
                                                    <div class="modal-header bg-primary text-white">
                                                        <h5 class="modal-title d-flex align-items-center"
                                                            id="scheduleDetailModalLabel{{ $schedule->id }}">
                                                            <i class="mdi mdi-calendar-check-outline mr-2"></i>
                                                            Detail Jadwal: {{ $schedule->name }}
                                                        </h5>
                                                        <button type="button" class="close text-white"
                                                            data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>

                                                    <!-- Modal Body -->
                                                    <div class="modal-body p-4">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <p>
                                                                    <strong class="text-primary">
                                                                        <i class="mdi mdi-trophy-outline"></i> Nama
                                                                        Pertandingan:
                                                                    </strong>
                                                                </p>
                                                                <p class="text-muted">{{ $schedule->name }}</p>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <p>
                                                                    <strong class="text-primary">
                                                                        <i class="mdi mdi-calendar"></i> Tanggal:
                                                                    </strong>
                                                                </p>
                                                                <p class="text-muted">
                                                                    {{ \Carbon\Carbon::parse($schedule->date)->format('d M Y') }}
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <p>
                                                                    <strong class="text-primary">
                                                                        <i class="mdi mdi-football"></i> Kategori
                                                                        Olahraga:
                                                                    </strong>
                                                                </p>
                                                                <p class="text-muted">
                                                                    {{ $schedule->sportCategory->sport_category }}
                                                                </p>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <p>
                                                                    <strong class="text-primary">
                                                                        <i class="mdi mdi-map-marker"></i> Tempat:
                                                                    </strong>
                                                                </p>
                                                                <p class="text-muted">{{ $schedule->venue_name }}</p>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <p>
                                                                    <strong class="text-primary">
                                                                        <i class="mdi mdi-map"></i> Peta Lokasi:
                                                                    </strong>
                                                                </p>
                                                                <div
                                                                    class="embed-responsive embed-responsive-16by9 border rounded">
                                                                    <iframe src="{{ $schedule->venue_map }}"
                                                                        class="embed-responsive-item" frameborder="0"
                                                                        allowfullscreen loading="lazy"></iframe>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Modal Footer -->
                                                    <div class="modal-footer justify-content-between bg-light">
                                                        <small class="text-muted">
                                                            <i class="mdi mdi-information-outline text-primary"></i>
                                                            Detail pertandingan diperbarui pada
                                                            {{ \Carbon\Carbon::parse($schedule->updated_at)->format('d M Y, H:i') }}
                                                        </small>
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">
                                                            <i class="mdi mdi-close-circle-outline"></i> Tutup
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                        <!-- Modal for Editing Schedule -->
                                        <div class="modal fade" id="scheduleEditModal{{ $schedule->id }}"
                                            tabindex="-1" role="dialog"
                                            aria-labelledby="scheduleEditModalLabel{{ $schedule->id }}"
                                            aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-warning text-dark">
                                                        <h5 class="modal-title"
                                                            id="scheduleEditModalLabel{{ $schedule->id }}">Edit
                                                            Schedule: {{ $schedule->name }}</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body p-4">
                                                        <form action="/edit-schedule/{{ $schedule->id }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('PUT')

                                                            <!-- Nama Pertandingan -->
                                                            <div class="form-group">
                                                                <label for="name"
                                                                    class="text-primary font-weight-bold">
                                                                    <i class="mdi mdi-trophy-outline"></i> Nama
                                                                    Pertandingan
                                                                </label>
                                                                <input type="text"
                                                                    class="form-control border-primary" id="name"
                                                                    name="name" value="{{ $schedule->name }}"
                                                                    placeholder="Masukkan nama pertandingan" required>
                                                            </div>

                                                            <!-- Tanggal -->
                                                            <!-- Tanggal dan Waktu -->
                                                            <div class="form-group">
                                                                <label for="date"
                                                                    class="text-primary font-weight-bold">
                                                                    <i class="mdi mdi-calendar-clock"></i> Tanggal dan
                                                                    Waktu
                                                                </label>
                                                                <div class="d-flex align-items-center">
                                                                    <input type="date"
                                                                        class="form-control border-primary mr-2"
                                                                        id="date" name="date"
                                                                        value="{{ $schedule->date }}" required>
                                                                    <input type="time"
                                                                        class="form-control border-primary"
                                                                        id="time" name="time"
                                                                        value="{{ $schedule->time ?? '00:00' }}"
                                                                        required>
                                                                </div>
                                                            </div>

                                                            <!-- Kategori Olahraga -->
                                                            <div class="form-group">
                                                                <label for="sport_category"
                                                                    class="text-primary font-weight-bold">
                                                                    <i class="mdi mdi-football"></i> Kategori Olahraga
                                                                </label>
                                                                <select class="form-control border-primary"
                                                                    id="sport_category" name="sport_category"
                                                                    required>
                                                                    <option value="" disabled>
                                                                        Pilih Cabang Olahraga</option>
                                                                    <option value="all">Semua</option>
                                                                    @foreach ($sportCategories as $category)
                                                                        <option value="{{ $category->id }}"
                                                                            {{ $schedule->sport_category == $category->id ? 'selected' : '' }}>
                                                                            {{ $category->sport_category }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>

                                                            <!-- Nama Tempat -->
                                                            <div class="form-group">
                                                                <label for="venue_name"
                                                                    class="text-primary font-weight-bold">
                                                                    <i class="mdi mdi-map-marker"></i> Nama Tempat
                                                                </label>
                                                                <input type="text"
                                                                    class="form-control border-primary"
                                                                    id="venue_name" name="venue_name"
                                                                    value="{{ $schedule->venue_name }}"
                                                                    placeholder="Masukkan nama tempat" required>
                                                            </div>

                                                            <!-- Peta -->
                                                            <div class="form-group">
                                                                <label for="venue_map"
                                                                    class="text-primary font-weight-bold">
                                                                    <i class="mdi mdi-map"></i> Peta Lokasi (iframe)
                                                                </label>
                                                                <textarea class="form-control border-primary" id="venue_map" name="venue_map" rows="3"
                                                                    placeholder="Masukkan iframe Google Maps untuk lokasi" required>{{ $schedule->venue_map }}</textarea>
                                                            </div>

                                                            <!-- Modal Footer -->
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-dismiss="modal">
                                                                    <i class="mdi mdi-close-circle-outline"></i> Batal
                                                                </button>
                                                                <button type="submit" class="btn btn-primary">
                                                                    <i class="mdi mdi-content-save-outline"></i> Simpan
                                                                    Perubahan
                                                                </button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach

                                    <!-- Pagination Links -->
                                    {{ $schedules->appends(request()->except('page'))->links() }}
                                </div>
                            </div>
                            <div class="card-footer">
                                <a href="/schedules/create" class="btn btn-rounded btn-primary">
                                    <i class="mdi mdi-calendar-edit"></i> Tambah Schedule</a>
                                <a href="" target="_blank" class="btn btn-rounded btn-primary mx-2">
                                    <i class="mdi mdi-printer"></i> Cetak Laporan</a>
                            </div>
                        </div>
                    </div>
                </div>



                <!--**********************************
            Content body end
        ***********************************-->



                <!--**********************************
           Support ticket button start
        ***********************************-->

                <!--**********************************
           Support ticket button end
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
        <!-- Required vendors -->
        <script src="{{ asset('gambar_aset/vendor/global/global.min.js') }}"></script>
        <script src="{{ asset('gambar_aset/js/quixnav-init.js') }}"></script>
        <script src="{{ asset('gambar_aset/js/custom.min.js') }}"></script>
        <script src="{{ asset('gambar_aset/js/sport-category.js') }}"></script>

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
        {{-- Debugging line --}}

        @if (Session::has('message'))
            <script>
                swal("Berhasil", "{{ Session::get('message') }}", 'success', {
                    button: true,
                    button: "Ok",
                    timer: 5000
                });
            </script>
        @endif
</body>

</html>
