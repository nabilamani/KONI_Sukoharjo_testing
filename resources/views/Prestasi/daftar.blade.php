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
<style>
    .card {
    border-bottom: 3px solid orange; /* You can adjust the width (3px) as needed */
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
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Prestasi</a></li>
                            <li class="breadcrumb-item active"><a href="javascript:void(0)">Daftar Prestasi</a></li>
                        </ol>
                    </div>
                </div>
                <!-- row -->
                <div class="row">
                    <!-- Basic Layout -->
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Daftar Prestasi</h4>
                                <form action="{{ route('achievements.index') }}" method="GET" class="form-inline">
                                    <input type="text" name="search" class="form-control mr-2"
                                        placeholder="Cari prestasi..." value="{{ request('search') }}">
                                    <button type="submit" class="btn btn-outline-primary">Cari</button>
                                </form>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="achievementTable" class="table table-striped table-hover"
                                        style="min-width: 845px;">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th>No</th>
                                                <th>ID</th>
                                                <th>Nama Atlet</th>
                                                <th>Cabang Olahraga</th>
                                                <th>Jenis Event</th>
                                                <th>Deskripsi</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody class="text-dark">
                                            @php
                                                $no = ($achievements->currentPage() - 1) * $achievements->perPage() + 1;
                                            @endphp
                                            @forelse ($achievements as $achievement)
                                                <tr>
                                                    <td>{{ $no++ }}</td>
                                                    <td>{{ $achievement->id }}</td>
                                                    <td>{{ $achievement->athlete_name }}</td>
                                                    <td>{{ $achievement->sport_category }}</td>
                                                    <td>{{ $achievement->event_type }}</td>
                                                    <td>{{ $achievement->description }}</td>
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
                                                                    data-target="#achievementDetailModal{{ $achievement->id }}"><i
                                                                        class="bx bx-info-circle"></i> Lihat
                                                                    Detail</a>
                                                                <a class="dropdown-item" href=""
                                                                    data-toggle="modal"
                                                                    data-target="#achievementEditModal{{ $achievement->id }}"><i
                                                                        class="bx bx-edit-alt"></i> Edit</a>
                                                                <form action="/delete-achievment/{{ $achievement->id }}"
                                                                    method="POST" class="d-inline">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" class="dropdown-item"
                                                                        onclick="return confirm('Apakah Anda yakin ingin menghapus data prestasi ini?')">
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
                                                        <div class="d-flex justify-content-center align-items-center my-2">
                                                            <i class="mdi mdi-alert-circle-outline me-2" style="font-size: 20px;"></i>
                                                            <span class="fs-8">Saat ini belum ada data daftar prestasi.</span>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                
                                    <!-- Pagination -->
                                    {{ $achievements->appends(request()->except('page'))->links() }}
                                    
                                    <!-- Modals for Each Achievement -->
                                    @foreach ($achievements as $achievement)
                                        <!-- Detail Modal -->
                                        <div class="modal fade" id="achievementDetailModal{{ $achievement->id }}" tabindex="-1" role="dialog"
                                            aria-labelledby="achievementDetailModalLabel{{ $achievement->id }}" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-primary text-white">
                                                        <h5 class="modal-title" id="achievementDetailModalLabel{{ $achievement->id }}">
                                                            Detail Prestasi: {{ $achievement->athlete_name }}
                                                        </h5>
                                                        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p><strong>Nama Atlet:</strong> {{ $achievement->athlete_name }}</p>
                                                        <p><strong>Cabang Olahraga:</strong> {{ $achievement->sport_category }}</p>
                                                        <p><strong>Jenis Event:</strong> {{ $achievement->event_type }}</p>
                                                        <p><strong>Deskripsi:</strong> {{ $achievement->description }}</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                
                                        <!-- Edit Modal -->
                                        <div class="modal fade" id="achievementEditModal{{ $achievement->id }}" tabindex="-1" role="dialog"
                                            aria-labelledby="achievementEditModalLabel{{ $achievement->id }}" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-primary text-white">
                                                        <h5 class="modal-title" id="achievementEditModalLabel{{ $achievement->id }}">
                                                            Edit Prestasi: {{ $achievement->athlete_name }}
                                                        </h5>
                                                        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="/edit-achievment/{{ $achievement->id }}" method="POST">
                                                            @csrf
                                                            @method('PUT')
                
                                                            <div class="form-group">
                                                                <label for="athlete_name">Nama Atlet</label>
                                                                <input type="text" class="form-control" id="athlete_name" name="athlete_name" 
                                                                       value="{{ $achievement->athlete_name }}" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="sport_category">Cabang Olahraga</label>
                                                                <input type="text" class="form-control" id="sport_category" name="sport_category" 
                                                                       value="{{ $achievement->sport_category }}" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="event_type">Jenis Event</label>
                                                                <input type="text" class="form-control" id="event_type" name="event_type" 
                                                                       value="{{ $achievement->event_type }}" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="description">Deskripsi</label>
                                                                <textarea class="form-control" id="description" name="description" rows="3" required>{{ $achievement->description }}</textarea>
                                                            </div>
                
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="card-footer">
                                <a href="/achievements/create" class="btn btn-rounded btn-primary">
                                    <i class="mdi mdi-account-plus"></i> Tambah Prestasi</a>
                                <a href="{{ route('cetak-prestasi') }}" target="_blank" class="btn btn-rounded btn-primary mx-2">
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
