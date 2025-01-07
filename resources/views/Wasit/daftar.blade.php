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
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Wasit</a></li>
                            <li class="breadcrumb-item active"><a href="javascript:void(0)">Daftar Wasit</a></li>
                        </ol>
                    </div>
                </div>
                <!-- row -->
                <div class="row">
                    <div class="col-12">
                        <div id="chart" class="mt-5"></div>
                        <hr class="mx-4">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Daftar Wasit</h4>
                                <form action="{{ route('referees.index') }}" method="GET" class="form-inline">
                                    <input type="text" name="search" class="form-control mr-2"
                                        placeholder="Cari wasit..." value="{{ request('search') }}">
                                    <button type="submit" class="btn btn-outline-primary">Cari</button>
                                </form>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="refereeTable" class="table table-striped table-hover"
                                        style="min-width: 845px;">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th>No</th>
                                                {{-- <th>Foto</th> --}}
                                                <th>Nama Wasit</th>
                                                <th>Cabang Olahraga</th>
                                                <th>Jenis Kelamin</th>
                                                <th>Tanggal Lahir</th>
                                                <th>Usia</th>
                                                <th>Lisensi</th>
                                                <th>Pengalaman</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody class="text-dark">
                                            @php
                                                $no = ($referees->currentPage() - 1) * $referees->perPage() + 1;
                                            @endphp
                                            @forelse ($referees as $referee)
                                                <tr>
                                                    <td>{{ $no++ }}</td>
                                                    <td>{{ $referee->name }}</td>
                                                    <td>{{ $referee->sportCategory->sport_category }}</td>
                                                    <td>{{ $referee->gender }}</td>
                                                    <td>{{ \Carbon\Carbon::parse($referee->birth_date)->format('d-m-Y') }}
                                                    </td>
                                                    <td>{{ $referee->age }}</td>
                                                    <td>{{ $referee->license }}</td>
                                                    <td>{{ $referee->experience }}</td>
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
                                                                    data-target="#refereeDetailModal{{ $referee->id }}">
                                                                    <i class="bx bx-info-circle"></i> Lihat Detail
                                                                </a>
                                                                <a class="dropdown-item" href=""
                                                                    data-toggle="modal"
                                                                    data-target="#refereeEditModal{{ $referee->id }}">
                                                                    <i class="bx bx-edit-alt"></i> Edit
                                                                </a>
                                                                <form action="/delete-referee/{{ $referee->id }}"
                                                                    method="POST" class="d-inline">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" class="dropdown-item"
                                                                        onclick="return confirm('Apakah Anda yakin ingin menghapus wasit ini?')">
                                                                        <i class="bx bx-trash"></i> Hapus
                                                                    </button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="9" class="text-center">
                                                        <div
                                                            class="d-flex justify-content-center align-items-center my-2">
                                                            <i class="mdi mdi-alert-circle-outline me-2"
                                                                style="font-size: 20px;"></i>
                                                            <span class="fs-8">Saat ini belum ada data daftar
                                                                wasit.</span>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>

                                    <!-- Modals for each Referee -->
                                    @foreach ($referees as $referee)
                                        <!-- Modal for Referee Details -->
                                        <div class="modal fade" id="refereeDetailModal{{ $referee->id }}"
                                            tabindex="-1" role="dialog"
                                            aria-labelledby="refereeDetailModalLabel{{ $referee->id }}"
                                            aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-primary text-white">
                                                        <h5 class="modal-title"
                                                            id="refereeDetailModalLabel{{ $referee->id }}">
                                                            Detail Wasit: {{ $referee->name }}
                                                        </h5>
                                                        <button type="button" class="close text-white"
                                                            data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <!-- Left column: Referee photo -->
                                                            <div class="col-md-4 text-center">
                                                                @if ($referee->photo)
                                                                    <img src="{{ $referee->photo }}"
                                                                        class="img-fluid rounded" alt="Foto Wasit"
                                                                        style="max-height: 300px; object-fit: cover;">
                                                                @else
                                                                    <img src="{{ asset('default-profile.png') }}"
                                                                        class="img-fluid rounded" alt="Foto Default"
                                                                        style="max-height: 300px; object-fit: cover;">
                                                                @endif
                                                            </div>
                                                            <!-- Right column: Referee details with table -->
                                                            <div class="col-md-8">
                                                                <table class="table table-borderless table-sm">
                                                                    <tbody>
                                                                        <tr>
                                                                            <td style="width: 30%;"><i
                                                                                    class="mdi mdi-account text-primary"></i>
                                                                                Nama:</td>
                                                                            <td>{{ $referee->name }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td><i
                                                                                    class="mdi mdi-cake text-primary"></i>
                                                                                Tanggal Lahir:</td>
                                                                            <td>{{ \Carbon\Carbon::parse($referee->birth_date)->format('d-m-Y') }}
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td><i
                                                                                    class="mdi mdi-calendar text-primary"></i>
                                                                                Usia:</td>
                                                                            <td>{{ $referee->age ?? '-' }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td><i
                                                                                    class="mdi mdi-gender-male-female text-primary"></i>
                                                                                Jenis Kelamin:</td>
                                                                            <td>{{ $referee->gender }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td><i
                                                                                    class="mdi mdi-soccer text-primary"></i>
                                                                                Kategori Olahraga:</td>
                                                                            <td>{{ $referee->sportCategory->sport_category }}
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td><i
                                                                                    class="mdi mdi-certificate text-primary"></i>
                                                                                Lisensi:</td>
                                                                            <td>{{ $referee->license ?? '-' }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td><i
                                                                                    class="mdi mdi-whatsapp text-primary"></i>
                                                                                Whatsapp:</td>
                                                                            <td>{{ $referee->whatsapp ?? '-' }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td><i
                                                                                    class="mdi mdi-instagram text-primary"></i>
                                                                                Instagram:</td>
                                                                            <td>{{ $referee->instagram ?? '-' }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td><i
                                                                                    class="mdi mdi-briefcase text-primary"></i>
                                                                                Pengalaman:</td>
                                                                            <td>{{ $referee->experience ?? '-' }}</td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
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


                                        <!-- Modal for Editing Referee -->
                                        <div class="modal fade" id="refereeEditModal{{ $referee->id }}"
                                            tabindex="-1" role="dialog"
                                            aria-labelledby="refereeEditModalLabel{{ $referee->id }}"
                                            aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-primary text-white">
                                                        <h5 class="modal-title"
                                                            id="refereeEditModalLabel{{ $referee->id }}">
                                                            Edit Wasit: {{ $referee->name }}
                                                        </h5>
                                                        <button type="button" class="close text-white"
                                                            data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <!-- Form Edit Wasit -->
                                                        <form action="/edit-referee/{{ $referee->id }}"
                                                            method="POST" enctype="multipart/form-data">
                                                            @csrf
                                                            @method('PUT')

                                                            <div class="row">
                                                                <!-- Left column -->
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label for="name">Nama Wasit</label>
                                                                        <input type="text" class="form-control"
                                                                            id="name" name="name"
                                                                            value="{{ $referee->name }}" required>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="birth_date">Tanggal Lahir</label>
                                                                        <input type="date" class="form-control"
                                                                            id="birth_date" name="birth_date"
                                                                            value="{{ $referee->birth_date }}"
                                                                            required>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="gender">Jenis Kelamin</label>
                                                                        <select class="form-control" id="gender"
                                                                            name="gender" required>
                                                                            <option value="Laki-laki"
                                                                                {{ $referee->gender == 'Laki-laki' ? 'selected' : '' }}>
                                                                                Laki-laki</option>
                                                                            <option value="Perempuan"
                                                                                {{ $referee->gender == 'Perempuan' ? 'selected' : '' }}>
                                                                                Perempuan</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="license">Lisensi</label>
                                                                        <input type="text" class="form-control"
                                                                            id="license" name="license"
                                                                            value="{{ $referee->license }}">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="whatsapp">Whatsapp</label>
                                                                        <input type="text" class="form-control"
                                                                            id="whatsapp" name="whatsapp"
                                                                            value="{{ $referee->whatsapp }}">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="instagram">Instagram</label>
                                                                        <input type="text" class="form-control"
                                                                            id="instagram" name="instagram"
                                                                            value="{{ $referee->instagram }}">
                                                                    </div>
                                                                </div>

                                                                <!-- Right column -->
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label for="sport_category">Cabang
                                                                            Olahraga</label>
                                                                        <select class="form-control"
                                                                            id="sport_category" name="sport_category"
                                                                            required>
                                                                            <option value="" disabled>Pilih
                                                                                Cabang Olahraga</option>
                                                                            @foreach ($sportCategories as $category)
                                                                                <option value="{{ $category->id }}"
                                                                                    {{ $referee->sport_category == $category->id ? 'selected' : '' }}>
                                                                                    {{ $category->sport_category }}
                                                                                </option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="experience">Pengalaman</label>
                                                                        <textarea class="form-control" id="experience" name="experience" rows="3">{{ $referee->experience }}</textarea>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="photo">Foto</label>
                                                                        <input type="file"
                                                                            class="form-control-file" id="photo"
                                                                            name="photo">
                                                                        <div class="mt-2">
                                                                            @if ($referee->photo)
                                                                                <img id="photo-preview"
                                                                                    src="{{ $referee->photo }}"
                                                                                    class="img-fluid rounded"
                                                                                    width="100" alt="Foto Wasit">
                                                                            @else
                                                                                <span class="text-muted">Tidak ada
                                                                                    Foto</span>
                                                                            @endif
                                                                        </div>
                                                                        <small>Biarkan kosong jika tidak ingin mengubah
                                                                            foto.</small>
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
                                    {{ $referees->appends(request()->except('page'))->links() }}
                                </div>
                            </div>
                            <div class="card-footer">
                                <a href="/referees/create" class="btn btn-rounded btn-primary">
                                    <i class="mdi mdi-account-plus"></i> Tambah Wasit</a>
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

        @if (Session::has('message'))
            <script>
                swal("Berhasil", "{{ Session::get('message') }}", 'success', {
                    button: true,
                    button: "Ok",
                    timer: 5000
                });
            </script>
        @endif
        <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var options = {
                    chart: {
                        type: 'bar',
                        height: 350
                    },
                    series: [{
                        name: 'Jumlah Wasit',
                        data: @json($categories->pluck('total')) // Data jumlah Wasit per kategori
                    }],
                    xaxis: {
                        categories: @json($categories->pluck('sportCategory.sport_category')), // Nama kategori olahraga
                        labels: {
                            style: {
                                fontSize: '10px' // Ukuran font untuk label kategori
                            }
                        }
                    },
                    colors: ['#FFA500'],
                    title: {
                        text: 'Statistik Wasit per Kategori Olahraga',
                        align: 'center'
                    }
                };

                var chart = new ApexCharts(document.querySelector("#chart"), options);
                chart.render();
            });
        </script>

</body>

</html>
