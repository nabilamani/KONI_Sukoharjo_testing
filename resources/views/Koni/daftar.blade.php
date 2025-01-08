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




</head>
<style>
    .card {
        border-bottom: 3px solid orange;
        /* You can adjust the width (3px) as needed */
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
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Struktural Koni</a></li>
                            <li class="breadcrumb-item active"><a href="javascript:void(0)">Daftar Struktural</a></li>
                        </ol>
                    </div>
                </div>
                <!-- row -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Daftar Struktur KONI</h4>
                                <form action="{{ route('konistructures.index') }}" method="GET" class="form-inline">
                                    <input type="text" name="search" class="form-control mr-2"
                                        placeholder="Cari anggota..." value="{{ request('search') }}">
                                    <button type="submit" class="btn btn-outline-primary">Cari</button>
                                </form>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="structureTable" class="table table-striped table-hover"
                                        style="min-width: 845px;">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th>No</th>
                                                <th>Nama</th>
                                                <th>Jabatan</th>
                                                <th>Umur</th>
                                                <th>Tanggal Lahir</th>
                                                <th>Jenis Kelamin</th>
                                                <th>Foto</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody class="text-dark">
                                            @php
                                                $no =
                                                    ($konistructures->currentPage() - 1) * $konistructures->perPage() +
                                                    1;
                                            @endphp
                                            @foreach ($konistructures as $konistructure)
                                                <tr>
                                                    <td>{{ $no++ }}</td>
                                                    <td>{{ $konistructure->name }}</td>
                                                    <td>{{ $konistructure->position }}</td>
                                                    <td>{{ $konistructure->age }}</td>
                                                    <td>{{ \Carbon\Carbon::parse($konistructure->birth_date)->format('d-m-Y') }}
                                                    </td>
                                                    <td>{{ $konistructure->gender }}</td>
                                                    <td><img src="{{ asset($konistructure->photo) }}" width="50"
                                                            alt="Foto"></td>
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
                                                                    data-target="#structureDetailModal{{ $konistructure->id }}">
                                                                    <i class="bx bx-info-circle"></i> Lihat Detail
                                                                </a>
                                                                <a class="dropdown-item" href="#"
                                                                    data-toggle="modal"
                                                                    data-target="#structureEditModal{{ $konistructure->id }}">
                                                                    <i class="bx bx-edit-alt"></i> Edit
                                                                </a>
                                                                <form
                                                                    action="{{ route('konistructures.destroy', $konistructure->id) }}"
                                                                    method="POST" class="d-inline">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" class="dropdown-item"
                                                                        onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                                                        <i class="bx bx-trash"></i> Hapus
                                                                    </button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>

                                                <!-- Detail Modal -->
                                                <div class="modal fade"
                                                    id="structureDetailModal{{ $konistructure->id }}" tabindex="-1"
                                                    role="dialog"
                                                    aria-labelledby="structureDetailModalLabel{{ $konistructure->id }}"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered modal-lg"
                                                        role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header bg-primary text-white">
                                                                <h5 class="modal-title"
                                                                    id="structureDetailModalLabel{{ $konistructure->id }}">
                                                                    Detail Struktur KONI: {{ $konistructure->name }}
                                                                </h5>
                                                                <button type="button" class="close text-white"
                                                                    data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="row">
                                                                    <div class="col-md-4 text-center">
                                                                        <img src="{{ asset($konistructure->photo) }}"
                                                                            class="img-fluid rounded" alt="Foto"
                                                                            style="max-height: 300px; object-fit: cover;">
                                                                    </div>
                                                                    <div class="col-md-8">
                                                                        <p><strong>Nama:</strong>
                                                                            {{ $konistructure->name }}</p>
                                                                        <p><strong>Jabatan:</strong>
                                                                            {{ $konistructure->position }}</p>
                                                                        <p><strong>Umur:</strong>
                                                                            {{ $konistructure->age }}</p>
                                                                        <p><strong>Tanggal Lahir:</strong>
                                                                            {{ $konistructure->birth_date }}</p>
                                                                        <p><strong>Jenis Kelamin:</strong>
                                                                            {{ $konistructure->gender }}</p>
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

                                                <!-- Edit Modal -->
                                                <div class="modal fade"
                                                    id="structureEditModal{{ $konistructure->id }}" tabindex="-1"
                                                    role="dialog"
                                                    aria-labelledby="structureEditModalLabel{{ $konistructure->id }}"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered modal-lg"
                                                        role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header bg-primary text-white">
                                                                <h5 class="modal-title"
                                                                    id="structureEditModalLabel{{ $konistructure->id }}">
                                                                    Edit Struktur KONI: {{ $konistructure->name }}</h5>
                                                                <button type="button" class="close text-white"
                                                                    data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form
                                                                    action="edit-konistructure/{{ $konistructure->id }}"
                                                                    method="POST" enctype="multipart/form-data">
                                                                    @csrf
                                                                    @method('PUT')
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label for="name">Nama</label>
                                                                                <input type="text"
                                                                                    class="form-control"
                                                                                    id="name" name="name"
                                                                                    value="{{ $konistructure->name }}"
                                                                                    required>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label for="position">Jabatan</label>
                                                                                <select name="position"
                                                                                    class="form-control" required>
                                                                                    <option value="">{{ $konistructure->position }}</option>
                                                                                    <option value="Ketua Umum">Ketua
                                                                                        Umum</option>
                                                                                    <option value="Wakil Ketua Umum I">
                                                                                        Wakil Ketua Umum I</option>
                                                                                    <option
                                                                                        value="Wakil Ketua Umum II">
                                                                                        Wakil Ketua Umum II</option>
                                                                                    <option value="Sekretaris Umum">
                                                                                        Sekretaris Umum</option>
                                                                                    <option
                                                                                        value="Wakil Sekretaris Umum">
                                                                                        Wakil Sekretaris Umum</option>
                                                                                    <option value="Bendahara Umum">
                                                                                        Bendahara Umum</option>
                                                                                    <option
                                                                                        value="Wakil Bendahara Umum">
                                                                                        Wakil Bendahara Umum</option>
                                                                                    <option value="Audit Internal">
                                                                                        Audit Internal</option>
                                                                                    <option
                                                                                        value="Bidang Organisasi & Kerjasama Antar Lembaga">
                                                                                        Bidang
                                                                                        Organisasi & Kerjasama Antar
                                                                                        Lembaga</option>
                                                                                    <option
                                                                                        value="Bidang Pembinaan Prestasi">
                                                                                        Bidang Pembinaan Prestasi
                                                                                    </option>
                                                                                    <option
                                                                                        value="Bidang Hukum Keolahragaan">
                                                                                        Bidang Hukum Keolahragaan
                                                                                    </option>
                                                                                    <option
                                                                                        value="Bidang Pendidikan, Penataran dan Litbang">
                                                                                        Bidang
                                                                                        Pendidikan, Penataran dan
                                                                                        Litbang</option>
                                                                                    <option
                                                                                        value="Bidang Media dan Humas">
                                                                                        Bidang Media dan Humas</option>
                                                                                    <option
                                                                                        value="Bidang Sport Science dan IPTEK">
                                                                                        Bidang Sport Science dan
                                                                                        IPTEK</option>
                                                                                    <option
                                                                                        value="Bidang Pengumpulan dan Pengolahan Data">
                                                                                        Bidang
                                                                                        Pengumpulan dan Pengolahan Data
                                                                                    </option>
                                                                                    <option
                                                                                        value="Bidang Perencanaan dan Anggaran">
                                                                                        Bidang Perencanaan dan
                                                                                        Anggaran</option>
                                                                                </select>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label for="birth_date">Tanggal
                                                                                    Lahir</label>
                                                                                <input type="date"
                                                                                    class="form-control"
                                                                                    id="birth_date" name="birth_date"
                                                                                    value="{{ $konistructure->birth_date }}"
                                                                                    required>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label for="gender">Jenis
                                                                                    Kelamin</label>
                                                                                <select name="gender"
                                                                                    class="form-control" required>
                                                                                    <option value="Laki-laki"
                                                                                        {{ $konistructure->gender == 'Laki-laki' ? 'selected' : '' }}>
                                                                                        Laki-laki</option>
                                                                                    <option value="Perempuan"
                                                                                        {{ $konistructure->gender == 'Perempuan' ? 'selected' : '' }}>
                                                                                        Perempuan</option>
                                                                                </select>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label for="photo">Foto</label>
                                                                                <input type="file"
                                                                                    class="form-control-file"
                                                                                    id="photo" name="photo"
                                                                                    onchange="previewNewPhoto()">
                                                                                <div class="mt-2">
                                                                                    <img id="photo-preview"
                                                                                        src="{{ $konistructure->photo ? asset($konistructure->photo) : '#' }}"
                                                                                        class="img-fluid rounded {{ $konistructure->photo ? '' : 'd-none' }}"
                                                                                        width="100"
                                                                                        alt="Foto Pelatih">
                                                                                    <span id="no-photo-text"
                                                                                        class="text-muted {{ $konistructure->photo ? 'd-none' : '' }}">Tidak
                                                                                        ada Foto</span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button"
                                                                            class="btn btn-secondary"
                                                                            data-dismiss="modal">Batal</button>
                                                                        <button type="submit"
                                                                            class="btn btn-primary">Simpan
                                                                            Perubahan</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    {{ $konistructures->appends(request()->except('page'))->links() }}
                                </div>
                            </div>
                            <div class="card-footer">
                                <a href="{{ route('konistructures.create') }}"
                                    class="btn btn-rounded btn-primary">Tambah Pengurus</a>
                                <a href="{{ route('cetak-konistructure') }}" target="_blank"
                                    class="btn btn-rounded btn-primary mx-2">Cetak Laporan</a>
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
            <script src="{{ asset('gambar_aset/js/imgpreview.js') }}"></script>


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

</body>

</html>
