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
    <link rel="stylesheet" href="https://cdn.ckeditor.com/ckeditor5/43.3.1/ckeditor5.css" />
</head>
<style>
    .container {
        width: 100%;
        border: 1px solid #ddd;
        padding: 10px;
        border-radius: 5px;
    }

    .options {
        display: flex;
        flex-wrap: wrap;
        gap: 5px;
        margin-bottom: 10px;
    }

    .option-button,
    .adv-option-button {
        background: #007bff;
        border: none;
        padding: 8px;
        color: white;
        cursor: pointer;
        border-radius: 3px;
    }

    #text-input {
        min-height: 200px;
        border: 1px solid #ddd;
        padding: 10px;
        border-radius: 5px;
        outline: none;
    }

    input[type="color"] {
        margin-left: 10px;
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
                <span class="fw-bolder d-none d-md-inline" style="margin-left: 10px; font-size: 18px; font-weight: 300">Sistem Kelola
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
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Berita</a></li>
                            <li class="breadcrumb-item active"><a href="javascript:void(0)">Tambah +</a></li>
                        </ol>
                    </div>
                </div>
                <!-- row -->
                <div class="row">
                    <div class="col-xxl">
                        <div class="card mb-4">
                            <div class="card-header d-flex align-items-center justify-content-between">
                                <h5 class="mb-0">Tambah Berita</h5>
                            </div>
                            <div class="card-body">
                                <form action="/beritas" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row mb-3">
                                        <label class="col-sm-2 col-form-label" for="judul_berita">Judul Berita</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="judul_berita" class="form-control"
                                                placeholder="Masukkan judul berita..." required />
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label class="col-sm-2 col-form-label" for="tanggal_waktu">Tanggal dan
                                            Waktu</label>
                                        <div class="col-sm-4">
                                            <input type="date" name="tanggal_waktu" class="form-control" required />
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label class="col-sm-2 col-form-label" for="lokasi_peristiwa">Lokasi
                                            Peristiwa</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="lokasi_peristiwa" class="form-control"
                                                placeholder="Masukkan lokasi peristiwa..." required />
                                        </div>
                                    </div>
                                    <div class="row mb-3"> 
                                        <label class="col-sm-2 col-form-label" for="isi_berita">Isi
                                            Berita</label>
                                        <div class="col -sm-10">
                                            <textarea   id="editor" name="isi_berita" class="" placeholder="Masukkan isi berita..." rows="5" ></textarea>
                                        </div>
                                    </div>
                                
                                    <div class="row mb-3">
                                        <label class="col-sm-2 col-form-label" for="kutipan_sumber">Kutipan
                                            Sumber</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="kutipan_sumber" class="form-control"
                                                placeholder="Masukkan kutipan sumber..." />
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
                                            <button type="submit" class="btn btn-primary">Tambah Berita</button>
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
        @include('layouts/footer')
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
        <script>
            document.querySelector('form').addEventListener('submit', function() {
                // Transfer content from the rich text editor to the hidden textarea
                const beritas = document.getElementById('text-input').innerHTML;
                document.getElementById('isi_berita').value = beritas;
            });
        </script>
        <script type="importmap">
            {
                "imports": {
                    "ckeditor5": "https://cdn.ckeditor.com/ckeditor5/43.3.1/ckeditor5.js",
                    "ckeditor5/": "https://cdn.ckeditor.com/ckeditor5/43.3.1/"
                }
            }
        </script>
        <script type="module">
            import {
                ClassicEditor,
                Essentials,
                Bold,
                Italic,
                Font,
                Paragraph, 
                Alignment
            } from 'ckeditor5';
        
            ClassicEditor
                .create( document.querySelector( '#editor' ), {
                    plugins: [ Essentials, Bold, Italic, Font, Paragraph, Alignment ],
                    toolbar: [
                        'undo', 'redo', '|', 'bold', 'italic', '|',
                        'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor', '|', 'alignment'
                    ],
                    alignment: {
                        options: ['left', 'center', 'right', 'justify']
                    },
                } )
                .then( /* ... */ )
                .catch( /* ... */ );
        </script>
        


    </div>
</body>

</html>
