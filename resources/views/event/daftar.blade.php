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
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Event</a></li>
                            <li class="breadcrumb-item active"><a href="javascript:void(0)">Daftar Event</a></li>
                        </ol>
                    </div>
                </div>
                <!-- row -->
                <div class="row">
                    <!-- Basic Layout -->
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Daftar Event</h4>
                                <form action="{{ route('events.index') }}" method="GET" class="form-inline">
                                    <input type="text" name="search" class="form-control mr-2"
                                        placeholder="Cari event..." value="{{ request('search') }}">
                                    <button type="submit" class="btn btn-outline-primary">Cari</button>
                                </form>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="eventTable" class="table table-striped table-hover"
                                        style="min-width: 845px;">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Acara</th>
                                                <th>Tanggal Acara</th>
                                                <th>Cabang Olahraga</th>
                                                <th>Lokasi</th>
                                                <th>Peta Lokasi</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody class="text-dark">
                                            @php
                                                $no = ($events->currentPage() - 1) * $events->perPage() + 1;
                                            @endphp
                                            @forelse ($events as $event)
                                                <tr>
                                                    <td>{{ $no++ }}</td>
                                                    <td>{{ $event->name }}</td>
                                                    <td>{{ \Carbon\Carbon::parse($event->start_date)->format('d-m-Y') }}
                                                    </td>
                                                    <td>{{ $event->sportCategory->sport_category ?? 'Semua' }}</td>
                                                    <td>{{ $event->location }}</td>
                                                    <!-- Add View Map Button -->
                                                    <td>
                                                        @if ($event->location_map)
                                                            <button class="btn btn-sm btn-outline-info"
                                                                data-toggle="modal"
                                                                data-target="#viewMapModal{{ $event->id }}">
                                                                <i class="mdi mdi-map-marker"></i> Lihat Peta
                                                            </button>
                                                        @else
                                                            <span>No Map</span>
                                                        @endif
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
                                                                <a class="dropdown-item" href=""
                                                                    data-toggle="modal"
                                                                    data-target="#eventDetailModal{{ $event->id }}">
                                                                    <i class="bx bx-info-circle"></i> Lihat Detail
                                                                </a>
                                                                <a class="dropdown-item" href=""
                                                                    data-toggle="modal"
                                                                    data-target="#eventEditModal{{ $event->id }}">
                                                                    <i class="bx bx-edit-alt"></i> Edit
                                                                </a>
                                                                <form action="/delete-event/{{ $event->id }}"
                                                                    method="POST" class="d-inline">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" class="dropdown-item"
                                                                        onclick="return confirm('Apakah Anda yakin ingin menghapus acara ini?')">
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
                                                            <span class="fs-8">Saat ini belum ada data daftar
                                                                event.</span>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                    {{ $events->appends(request()->except('page'))->links() }}
                                </div>
                            </div>
                            <div class="card-footer">
                                <a href="/events/create" class="btn btn-rounded btn-primary">
                                    <i class="mdi mdi-calendar-plus"></i> Tambah Event</a>
                                <a href="{{ route('cetak-event') }}" target="_blank"
                                    class="btn btn-rounded btn-primary mx-2">
                                    <i class="mdi mdi-printer"></i> Cetak Laporan</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal for Viewing Map -->
                @foreach ($events as $event)
                    <div class="modal fade" id="viewMapModal{{ $event->id }}" tabindex="-1" role="dialog"
                        aria-labelledby="viewMapModalLabel{{ $event->id }}" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header bg-info text-white">
                                    <h5 class="modal-title" id="viewMapModalLabel{{ $event->id }}">Peta Lokasi:
                                        {{ $event->name }}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    @if ($event->location_map)
                                        <iframe src="{{ $event->location_map }}" width="100%" height="400"
                                            style="border: 0;" allowfullscreen="" loading="lazy"></iframe>
                                    @else
                                        <p>Tidak ada peta lokasi yang tersedia.</p>
                                    @endif
                                </div>
                                <div class="modal-footer py-3">
                                    <button type="button" class="btn btn-secondary"
                                        data-dismiss="modal">Tutup</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                @foreach ($events as $event)
                    <!-- Modal for Event Details -->
                    <div class="modal fade" id="eventDetailModal{{ $event->id }}" tabindex="-1" role="dialog"
                        aria-labelledby="eventDetailModalLabel{{ $event->id }}" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <!-- Modal Header -->
                                <div class="modal-header bg-primary">
                                    <h5 class="modal-title text-light" id="eventDetailModalLabel{{ $event->id }}">
                                        Detail Acara: {{ $event->name }}
                                    </h5>
                                    <button type="button" class="close text-white" data-dismiss="modal"
                                        aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>

                                <!-- Modal Body -->
                                <div class="modal-body">
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <p><strong>Nama Acara:</strong> {{ $event->name }}</p>
                                            <p><strong>Tanggal Acara:</strong>
                                                {{ \Carbon\Carbon::parse($event->start_date)->format('d-m-Y') }}</p>
                                            <p><strong>Cabang Olahraga:</strong>
                                                {{ $event->sportCategory->sport_category ?? 'Semua' }}</p>
                                            <p><strong>Lokasi:</strong> {{ $event->location }}</p>
                                        </div>
                                        <div class="col-md-6 text-center">
                                            <p><strong>Banner:</strong></p>
                                            @if ($event->banner)
                                                <img src="{{ asset($event->banner) }}" alt="Banner"
                                                    class="img-fluid rounded shadow-sm"
                                                    style="max-width: 100%; height: auto;">
                                            @else
                                                <p class="text-muted">No Banner</p>
                                            @endif
                                        </div>

                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-12">
                                            <p><strong>Peta Lokasi:</strong></p>
                                            @if ($event->location_map)
                                                <iframe src="{{ $event->location_map }}" width="100%"
                                                    height="300" style="border: 0; border-radius: 8px;"
                                                    allowfullscreen="" loading="lazy">
                                                </iframe>
                                            @else
                                                <p class="text-muted">No Map Available</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <!-- Modal Footer -->
                                <div class="modal-footer bg-light">
                                    <button type="button" class="btn btn-secondary"
                                        data-dismiss="modal">Tutup</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal for Editing Event -->
                    <div class="modal fade" id="eventEditModal{{ $event->id }}" tabindex="-1" role="dialog"
                        aria-labelledby="eventEditModalLabel{{ $event->id }}" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header bg-primary">
                                    <h5 class="modal-title text-light" id="eventEditModalLabel{{ $event->id }}">
                                        Edit Acara:
                                        {{ $event->name }}</h5>
                                    <button type="button" class="close text-light" data-dismiss="modal"
                                        aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <!-- Form Edit Acara -->
                                    <form action="/edit-event/{{ $event->id }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="row">
                                            <!-- Kolom Kiri -->
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="name">Nama Acara</label>
                                                    <input type="text" class="form-control" id="name"
                                                        name="name" value="{{ $event->name }}" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="start_date">Tanggal Mulai</label>
                                                    <input type="date" class="form-control" id="start_date" name="start_date"
                                                        value="{{ \Carbon\Carbon::parse($event->start_date)->format('Y-m-d') }}" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="end_date">Tanggal Selesai</label>
                                                    <input type="date" class="form-control" id="end_date" name="end_date"
                                                        value="{{ \Carbon\Carbon::parse($event->end_date)->format('Y-m-d') }}" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="sport_category">Cabang Olahraga</label>
                                                    <select class="form-control" id="sport_category"
                                                        name="sport_category" required>
                                                        <option value="" disabled>
                                                            Pilih Cabang Olahraga</option>
                                                        <option value="all">Semua</option>
                                                        @foreach ($sportCategories as $category)
                                                            <option value="{{ $category->id }}"
                                                                {{ $event->sport_category == $category->id ? 'selected' : '' }}>
                                                                {{ $category->sport_category }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="location">Lokasi</label>
                                                    <input type="text" class="form-control" id="location"
                                                        name="location" value="{{ $event->location }}" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="location_map">Peta Lokasi (iframe)</label>
                                                    <textarea class="form-control" id="location_map" name="location_map" rows="3" required>{{ $event->location_map }}</textarea>
                                                    <small class="form-text text-muted">Masukkan kode iframe dari
                                                        Google Maps.</small>
                                                </div>
                                            </div>
                                            <!-- Kolom Kanan -->
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="banner" class="form-label">Banner</label>
                                                    <div class="mb-3">
                                                        @if ($event->banner)
                                                            <img src="{{ asset($event->banner) }}"
                                                                alt="Current Banner"
                                                                class="img-fluid rounded shadow-sm mb-2"
                                                                style="max-width: 100%; height: auto;">
                                                        @else
                                                            <p class="text-muted">Tidak ada banner yang tersedia.</p>
                                                        @endif
                                                    </div>
                                                    <input type="file" class="form-control-file" id="banner"
                                                        name="banner" accept="image/*">
                                                    <small class="form-text text-muted">
                                                        Upload file gambar baru (format: JPG, PNG, JPEG. Ukuran
                                                        maksimum: 2MB).
                                                        Jika diunggah, banner lama akan diganti.
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Tombol di Bagian Footer -->
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Batal</button>
                                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

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
