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
                <span class="fw-bolder " style="margin-left: 10px; font-size: 18px; font-weight: 300">Sistem Kelola
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
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Daftar Galeri</h4>
                                <form action="{{ route('galleries.index') }}" method="GET" class="form-inline">
                                    <input type="text" name="search" class="form-control mr-2"
                                        placeholder="Cari galeri..." value="{{ request('search') }}">
                                    <button type="submit" class="btn btn-outline-primary">Cari</button>
                                </form>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    @foreach ($galleries as $gallery)
                                        <div class="col-md-4 mb-4">
                                            <div class="card shadow-sm h-100">
                                                <div class="card-img-wrapper">
                                                    @if ($gallery->media_type == 'photo')
                                                        <img src="{{ asset($gallery->media_path) }}"
                                                            class="card-img-top" alt="{{ $gallery->title }}">
                                                    @elseif ($gallery->media_type == 'video')
                                                        <video controls class="card-img-top"
                                                            style="width: 100%; height: 200px; object-fit: cover;">
                                                            <source src="{{ asset($gallery->media_path) }}"
                                                                type="video/mp4">
                                                            Your browser does not support the video tag.
                                                        </video>
                                                    @endif
                                                </div>
                                                <div class="card-body">
                                                    <h5 class="card-title">{{ $gallery->title }}</h5>
                                                    <p class="card-text">
                                                        <strong>Kategori Olahraga :</strong>
                                                        {{ $gallery->sport_category }}<br>
                                                        <strong>Tanggal :</strong> {{ $gallery->date }}<br>
                                                        <strong>Lokasi :</strong> {{ $gallery->location }}
                                                    </p>
                                                    <div class="d-flex justify-content-between">
                                                        <a href="#" class="btn btn-outline-info btn-sm"
                                                            data-toggle="modal"
                                                            data-target="#galleryDetailModal{{ $gallery->id }}">Lihat
                                                            Detail</a>
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
                                                                    data-target="#galleryEditModal{{ $gallery->id }}">
                                                                    <i class="bx bx-edit-alt"></i> Edit
                                                                </a>
                                                                <form action="/delete-gallery/{{ $gallery->id }}"
                                                                    method="POST" class="d-inline">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" class="dropdown-item"
                                                                        onclick="return confirm('Apakah Anda yakin ingin menghapus galeri ini?')">
                                                                        <i class="bx bx-trash"></i> Hapus
                                                                    </button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Modal for Gallery Details -->
                                        <div class="modal fade" id="galleryDetailModal{{ $gallery->id }}"
                                            tabindex="-1" role="dialog"
                                            aria-labelledby="galleryDetailModalLabel{{ $gallery->id }}"
                                            aria-hidden="true">
                                            <div class="modal-dialog modal-lg" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-primary text-white">
                                                        <h5 class="modal-title"
                                                            id="galleryDetailModalLabel{{ $gallery->id }}">Detail
                                                            Galeri : {{ $gallery->title }}</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <!-- Body -->
                                                    <div class="modal-body">
                                                        <div class="container-fluid">
                                                            <div class="row mb-3">
                                                                <div class="col-4"><strong>Judul</strong></div>
                                                                <div class="col-8">: {{ $gallery->title }}</div>
                                                            </div>
                                                            <div class="row mb-3">
                                                                <div class="col-4"><strong>Kategori Olahraga</strong>
                                                                </div>
                                                                <div class="col-8">: {{ $gallery->sport_category }}
                                                                </div>
                                                            </div>
                                                            <div class="row mb-3">
                                                                <div class="col-4"><strong>Tanggal</strong></div>
                                                                <div class="col-8">: {{ $gallery->date }}</div>
                                                            </div>
                                                            <div class="row mb-3">
                                                                <div class="col-4"><strong>Lokasi</strong></div>
                                                                <div class="col-8">: {{ $gallery->location }}</div>
                                                            </div>
                                                            <div class="row mb-3">
                                                                <div class="col-4"><strong>Media</strong></div>
                                                                <div class="col-8">
                                                                    @if ($gallery->media_type == 'photo')
                                                                        <img src="{{ asset($gallery->media_path) }}"
                                                                            alt="{{ $gallery->title }}"
                                                                            class="img-fluid rounded shadow">
                                                                    @elseif ($gallery->media_type == 'video')
                                                                        <video controls class="w-100 rounded shadow">
                                                                            <source
                                                                                src="{{ asset($gallery->media_path) }}"
                                                                                type="video/mp4">
                                                                        </video>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Tutup</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Modal for Editing Gallery -->
                                        <div class="modal fade" id="galleryEditModal{{ $gallery->id }}"
                                            tabindex="-1" role="dialog"
                                            aria-labelledby="galleryEditModalLabel{{ $gallery->id }}"
                                            aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-warning text-dark">
                                                        <h5 class="modal-title"
                                                            id="galleryEditModalLabel{{ $gallery->id }}">Edit Galeri:
                                                            {{ $gallery->title }}</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body p-3">
                                                        <form action="/edit-gallery/{{ $gallery->id }}"
                                                            method="POST" enctype="multipart/form-data">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="form-group mb-3">
                                                                <label for="title">Judul</label>
                                                                <input type="text" class="form-control"
                                                                    id="title" name="title"
                                                                    value="{{ $gallery->title }}" required>
                                                            </div>
                                                            <div class="form-group mb-3">
                                                                <label for="sport_category">Kategori Olahraga</label>
                                                                <input type="text" class="form-control"
                                                                    id="sport_category" name="sport_category"
                                                                    value="{{ $gallery->sport_category }}" required>
                                                            </div>
                                                            <div class="form-group mb-3">
                                                                <label for="date">Tanggal</label>
                                                                <input type="date" class="form-control"
                                                                    id="date" name="date"
                                                                    value="{{ $gallery->date }}" required>
                                                            </div>
                                                            <div class="form-group mb-3">
                                                                <label for="location">Lokasi</label>
                                                                <input type="text" class="form-control"
                                                                    id="location" name="location"
                                                                    value="{{ $gallery->location }}" required>
                                                            </div>
                                                            <div class="form-group mb-3">
                                                                <label for="description">Deskripsi</label>
                                                                <textarea class="form-control" id="description" name="description" rows="4" required>{{ $gallery->description }}</textarea>
                                                            </div>

                                                            {{-- <div class="form-group mb-3">
                                                                <label for="media_path">Unggah Media Baru</label>
                                                                <input type="file" class="form-control"
                                                                    id="media_path" name="media_path"
                                                                    accept="image/*,video/*">
                                                            </div> --}}
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-dismiss="modal">Batal</button>
                                                                <button type="submit" class="btn btn-primary">Simpan
                                                                    Perubahan</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <!-- Pagination Links -->
                                {{ $galleries->appends(request()->except('page'))->links() }}
                            </div>
                            <div class="card-footer">
                                <a href="/galleries/create" class="btn btn-rounded btn-primary">
                                    <i class="mdi mdi-folder-image"></i> Tambah Galeri
                                </a>
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
