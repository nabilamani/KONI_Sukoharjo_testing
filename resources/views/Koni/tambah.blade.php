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
                <img class="logo-abbr" src="{{ asset('gambar_aset/images/koni.png') }}" alt=""
                    style="margin-left: 10px; border-radius: 50%;">
                <span class="fw-bolder" style="margin-left: 10px; font-size: 18px; font-weight: 300">Sistem Kelola
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
                            <p class="mb-1"><span class="text-success">{{ Auth::user()->name }},</span> Anda login
                                sebagai <span class="text-success">{{ Auth::user()->level }}</span></p>
                        </div>
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Struktural Koni</a></li>
                            <li class="breadcrumb-item active"><a href="javascript:void(0)">Tambah +</a></li>
                        </ol>
                    </div>
                </div>
                <!-- row -->
                <div class="row">
                    <div class="col-xxl">
                        <div class="card mb-4">
                            <div class="card-header d-flex align-items-center justify-content-between">
                                <h5 class="mb-0">Tambah Data Struktural KONI</h5>
                            </div>
                            <div class="card-body">
                                <form action="/konistructures" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row mb-3">
                                        <label class="col-sm-2 col-form-label" for="name">Nama</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="name" class="form-control"
                                                placeholder="Masukkan nama..." required />
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label class="col-sm-2 col-form-label" for="position">Jabatan</label>
                                        <div class="col-sm-10">
                                            <select name="position" class="form-control" required>
                                                <option value="">Pilih jabatan...</option>
                                                <option value="Ketua Umum">Ketua Umum</option>
                                                <option value="Wakil Ketua Umum I">Wakil Ketua Umum I</option>
                                                <option value="Wakil Ketua Umum II">Wakil Ketua Umum II</option>
                                                <option value="Sekretaris Umum">Sekretaris Umum</option>
                                                <option value="Wakil Sekretaris Umum">Wakil Sekretaris Umum</option>
                                                <option value="Bendahara Umum">Bendahara Umum</option>
                                                <option value="Wakil Bendahara Umum">Wakil Bendahara Umum</option>
                                                <option value="Audit Internal">Audit Internal</option>
                                                <option value="Bidang Organisasi & Kerjasama Antar Lembaga">Bidang
                                                    Organisasi & Kerjasama Antar Lembaga</option>
                                                <option value="Bidang Pembinaan Prestasi">Bidang Pembinaan Prestasi
                                                </option>
                                                <option value="Bidang Hukum Keolahragaan">Bidang Hukum Keolahragaan
                                                </option>
                                                <option value="Bidang Pendidikan, Penataran dan Litbang">Bidang
                                                    Pendidikan, Penataran dan Litbang</option>
                                                <option value="Bidang Media dan Humas">Bidang Media dan Humas</option>
                                                <option value="Bidang Sport Science dan IPTEK">Bidang Sport Science dan
                                                    IPTEK</option>
                                                <option value="Bidang Pengumpulan dan Pengolahan Data">Bidang
                                                    Pengumpulan dan Pengolahan Data</option>
                                                <option value="Bidang Perencanaan dan Anggaran">Bidang Perencanaan dan
                                                    Anggaran</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label class="col-sm-2 col-form-label" for="age">Umur</label>
                                        <div class="col-sm-10">
                                            <input type="number" name="age" class="form-control"
                                                placeholder="Masukkan umur..." required />
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label class="col-sm-2 col-form-label" for="birth_date">Tanggal Lahir</label>
                                        <div class="col-sm-4">
                                            <input type="date" name="birth_date" class="form-control" required />
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label class="col-sm-2 col-form-label" for="gender">Jenis Kelamin</label>
                                        <div class="col-sm-10">
                                            <select name="gender" class="form-control" required>
                                                <option value="" hidden selected>Pilih jenis kelamin...</option>
                                                <option value="Laki-laki">Laki-laki</option>
                                                <option value="Perempuan">Perempuan</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label class="col-sm-2 col-form-label" for="gambar">Foto</label>
                                        <div class="col-sm-4">
                                            <input class="form-control" type="file" name="photo" id="gambar"
                                                onchange="previewImage()" />
                                            <img id="preview" src="#" alt="Preview Foto"
                                                class="img-fluid mt-3 d-none"
                                                style="max-height: 200px; border: 1px solid #ddd; padding: 5px;" />
                                        </div>
                                    </div>
                                    <div class="row justify-content-end">
                                        <div class="col-sm-10">
                                            <button type="submit" class="btn btn-primary">Tambah Struktural</button>
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
        <script src="{{ asset('gambar_aset/js/imgpreview.js') }}"></script>
    </div>
</body>

</html>
