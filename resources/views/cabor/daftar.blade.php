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
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Cabor</a></li>
                            <li class="breadcrumb-item active"><a href="javascript:void(0)">Daftar Cabor</a></li>
                        </ol>
                    </div>
                </div>
                <!-- row -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Daftar Kategori Olahraga</h4>
                                <form action="{{ route('sportcategories.index') }}" method="GET" class="form-inline">
                                    <input type="text" name="search" class="form-control mr-2"
                                        placeholder="Cari kategori..." value="{{ request('search') }}">
                                    <button type="submit" class="btn btn-outline-primary">Cari</button>
                                </form>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="sportCategoryTable" class="table table-striped table-hover"
                                        style="min-width: 845px;">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th>No</th>
                                                <th>Logo</th>
                                                <th>Nama Federasi</th>
                                                <th>Nama Kategori</th>
                                                <th>Deskripsi</th>
                                                <th>Pusat Latihan Cabor</th>
                                                <th>Kontak</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody class="text-dark">
                                            @php
                                                $no =
                                                    ($SportCategories->currentPage() - 1) *
                                                        $SportCategories->perPage() +
                                                    1;
                                            @endphp
                                            @foreach ($SportCategories as $SportCategory)
                                                <tr>
                                                    <td>{{ $no++ }}</td>
                                                    <td>
                                                        @if ($SportCategory->logo)
                                                            <img src="{{ asset($SportCategory->logo) }}"
                                                                alt="Logo {{ $SportCategory->nama_cabor }}"
                                                                style="width: 50px; height: 50px; object-fit: contain;">
                                                        @else
                                                            <span class="text-muted">Tidak ada logo</span>
                                                        @endif
                                                    </td>

                                                    <td>{{ $SportCategory->nama_cabor }}</td>
                                                    <td>{{ $SportCategory->sport_category }}</td>
                                                    <td>{{ $SportCategory->deskripsi }}</td>
                                                    <td>{{ $SportCategory->puslatcab }}</td>
                                                    <td>{{ $SportCategory->kontak }}</td>
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
                                                                    data-target="#categoryDetailModal{{ $SportCategory->id }}">
                                                                    <i class="bx bx-info-circle"></i> Lihat Detail
                                                                </a>
                                                                <a class="dropdown-item" href="#"
                                                                    data-toggle="modal"
                                                                    data-target="#categoryEditModal{{ $SportCategory->id }}">
                                                                    <i class="bx bx-edit-alt"></i> Edit
                                                                </a>
                                                                <form
                                                                    action="/delete-sportcategory/{{ $SportCategory->id }}"
                                                                    method="POST" class="d-inline">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" class="dropdown-item"
                                                                        onclick="return confirm('Apakah Anda yakin ingin menghapus kategori ini?')">
                                                                        <i class="bx bx-trash"></i> Hapus
                                                                    </button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>

                                    <!-- Modals for each SportCategory -->
                                    @foreach ($SportCategories as $SportCategory)
                                        <!-- Modal for Category Details -->
                                        <div class="modal fade" id="categoryDetailModal{{ $SportCategory->id }}"
                                            tabindex="-1" role="dialog"
                                            aria-labelledby="categoryDetailModalLabel{{ $SportCategory->id }}"
                                            aria-hidden="true">
                                            <div class="modal-dialog modal-lg px-3" role="document">
                                                <div class="modal-content">
                                                    <!-- Header -->
                                                    <div class="modal-header bg-primary text-white">
                                                        <h5 class="modal-title"
                                                            id="categoryDetailModalLabel{{ $SportCategory->id }}">
                                                            <i class="mdi mdi-view-list me-2"></i>Detail Kategori:
                                                            {{ $SportCategory->nama_cabor }}
                                                        </h5>
                                                        <button type="button" class="close text-white"
                                                            data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>

                                                    <!-- Body -->
                                                    <div class="modal-body">
                                                        <div class="row g-3">
                                                            <!-- Logo -->
                                                            <div class="col-md-5 mt-3">
                                                                @if ($SportCategory->logo)
                                                                    <div class="text-center">
                                                                        <img src="{{ asset($SportCategory->logo) }}"
                                                                            alt="Logo {{ $SportCategory->nama_cabor }}"
                                                                            class="img-fluid rounded mb-3"
                                                                            style="max-height: 250px; object-fit: contain;">
                                                                    </div>
                                                                @else
                                                                    <div class="d-flex align-items-center justify-content-center bg-light border rounded shadow-sm"
                                                                        style="height: 200px;">
                                                                        <i
                                                                            class="mdi mdi-image-off-outline mdi-48px text-muted"></i>
                                                                    </div>
                                                                @endif


                                                            </div>

                                                            <!-- Details -->
                                                            <div class="col-md-7">
                                                                <div class="mt-3 p-3 rounded shadow-sm bg-light">
                                                                    <p class="mb-3">
                                                                        <strong class="text-primary"><i
                                                                                class="mdi mdi-tag-outline me-2"></i>
                                                                            Nama Federasi:</strong><br>
                                                                        <span
                                                                            class="text-dark">{{ $SportCategory->nama_cabor }}</span>
                                                                    </p>
                                                                    <p class="mb-3">
                                                                        <strong class="text-info"><i
                                                                                class="mdi mdi-home-map-marker me-2"></i>
                                                                            Pusat Latihan:</strong><br>
                                                                        <span
                                                                            class="text-dark">{{ $SportCategory->puslatcab }}</span>
                                                                    </p>
                                                                    <p class="mb-3">
                                                                        <strong class="text-success"><i
                                                                                class="mdi mdi-phone me-2"></i>
                                                                            Kontak:</strong><br>
                                                                        <span
                                                                            class="text-dark">{{ $SportCategory->kontak }}</span>
                                                                    </p>
                                                                    <p class="mb-3">
                                                                        <strong class="text-success"><i
                                                                                class="mdi mdi-account me-1"></i>
                                                                            Level Pengrus:</strong><br>
                                                                        <span
                                                                            class="text-dark">{{ $SportCategory->level }}</span>
                                                                    </p>
                                                                </div>
                                                                <div class="bg-light p-3 rounded shadow-sm">
                                                                    <p><strong class="text-primary"><i
                                                                                class="mdi mdi-information-outline me-2"></i>
                                                                            Deskripsi:</strong></p>
                                                                    <p>{{ $SportCategory->deskripsi }}</p>
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



                                        <!-- Modal for Editing SportCategory -->
                                        <div class="modal fade" id="categoryEditModal{{ $SportCategory->id }}"
                                            tabindex="-1" role="dialog"
                                            aria-labelledby="categoryEditModalLabel{{ $SportCategory->id }}"
                                            aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-warning text-dark">
                                                        <h5 class="modal-title"
                                                            id="categoryEditModalLabel{{ $SportCategory->id }}">
                                                            Edit Kategori: {{ $SportCategory->nama_cabor }}
                                                        </h5>
                                                        <button type="button" class="close text-dark"
                                                            data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <!-- Form Edit Kategori -->
                                                        <form action="/edit-sportcategory/{{ $SportCategory->id }}"
                                                            method="POST" enctype="multipart/form-data">
                                                            @csrf
                                                            @method('PUT')

                                                            <div class="row">
                                                                <!-- Left column -->
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label for="nama_cabor">Nama Federasi</label>
                                                                        <input type="text" class="form-control"
                                                                            id="nama_cabor" name="nama_cabor"
                                                                            value="{{ $SportCategory->nama_cabor }}"
                                                                            required>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="sport_category">Cabang Olahraga</label>
                                                                        <input type="text" class="form-control"
                                                                            id="sport_category" name="sport_category"
                                                                            value="{{ $SportCategory->sport_category }}"
                                                                            required>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="puslatcab">Pusat Latihan
                                                                            Cabang</label>
                                                                        <input type="text" class="form-control"
                                                                            id="puslatcab" name="puslatcab"
                                                                            value="{{ $SportCategory->puslatcab }}"
                                                                            required>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="kontak">Kontak</label>
                                                                        <input type="text" class="form-control"
                                                                            id="kontak" name="kontak"
                                                                            value="{{ $SportCategory->kontak }}"
                                                                            required>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="level">Level</label>
                                                                        <input type="text" class="form-control"
                                                                            id="level" name="level"
                                                                            value="{{ $SportCategory->level }}"
                                                                            required>
                                                                    </div>
                                                                </div>

                                                                <!-- Right column -->
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label for="deskripsi">Deskripsi</label>
                                                                        <textarea class="form-control" id="deskripsi" name="deskripsi" rows="4" required>{{ $SportCategory->deskripsi }}</textarea>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="logo">Logo</label>
                                                                        <input type="file"
                                                                            class="form-control-file" id="logo"
                                                                            name="logo" onchange="previewLogo()">
                                                                        <div class="mt-2">
                                                                            <img id="logo-preview"
                                                                                src="{{ $SportCategory->logo ? asset($SportCategory->logo) : '#' }}"
                                                                                class="img-fluid rounded {{ $SportCategory->logo ? '' : 'd-none' }}"
                                                                                width="100" alt="Logo Kategori">
                                                                            <span id="no-logo-text"
                                                                                class="text-muted {{ $SportCategory->logo ? 'd-none' : '' }}">Tidak
                                                                                ada Logo</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

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

                                    <!-- Pagination Links -->
                                    {{ $SportCategories->appends(request()->except('page'))->links() }}
                                </div>
                            </div>
                            <div class="card-footer">
                                <a href="/sportcategories/create" class="btn btn-rounded btn-primary">
                                    <i class="mdi mdi-plus"></i> Tambah Kategori Olahraga</a>
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
