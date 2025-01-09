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
    <link rel="stylesheet" href="https://cdn.ckeditor.com/ckeditor5/43.3.1/ckeditor5.css" />
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
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Berita</a></li>
                            <li class="breadcrumb-item active"><a href="javascript:void(0)">Daftar Berita</a></li>
                        </ol>
                    </div>
                </div>
                <!-- row -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Daftar Berita</h4>
                                <form action="{{ route('beritas.index') }}" method="GET" class="form-inline">
                                    <input type="text" name="search" class="form-control mr-2"
                                        placeholder="Cari berita..." value="{{ request('search') }}">
                                    <button type="submit" class="btn btn-outline-primary">Cari</button>
                                </form>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    @forelse ($beritas as $berita)
                                        <div class="col-md-6 mb-1">
                                            <div class="card border shadow-sm mb-3">
                                                <div class="row no-gutters align-items-stretch">
                                                    <!-- Image on the left side -->
                                                    <div class="col-md-4 d-flex">
                                                        <img src="{{ asset($berita->photo) }}"
                                                            class="card-img img-fluid my-3 mx-2" alt="Foto Berita"
                                                            style="width: 100%; object-fit: cover; border-radius: 8px;">
                                                    </div>
                                                    <!-- Details on the right side -->
                                                    <div class="col-md-8">
                                                        <div class="card-body">
                                                            <h5 class="card-title mb-0">{{ $berita->judul_berita }}
                                                            </h5>
                                                            <p class="card-text mb-0">
                                                                <small
                                                                    class="text-muted mb-0">{{ \Carbon\Carbon::parse($berita->tanggal_waktu)->format('d-m-Y H:i') }}</small>
                                                            </p>
                                                            <p class="card-text mb-0">
                                                                {!! Str::limit($berita->isi_berita, 200) !!}</p>
                                                            <p class="card-text mb-0"><strong>Lokasi:</strong>
                                                                {{ $berita->lokasi_peristiwa }}</p>
                                                            <p class="card-text"><strong>Kutipan:</strong>
                                                                {{ $berita->kutipan_sumber }}</p>
                                                            <!-- Action buttons -->
                                                            <div class="btn-group" role="group" aria-label="Aksi">
                                                                <a href="#" class="btn btn-info btn-sm"
                                                                    data-toggle="modal"
                                                                    data-target="#newsDetailModal{{ $berita->id }}">
                                                                    Lihat Detail
                                                                </a>
                                                                <a href="#" class="btn btn-warning btn-sm"
                                                                    data-toggle="modal" data-target="#newsEditModal"
                                                                    data-id="{{ $berita->id }}"
                                                                    data-title="{{ $berita->judul_berita }}"
                                                                    data-date="{{ $berita->tanggal_waktu }}"
                                                                    data-location="{{ $berita->lokasi_peristiwa }}"
                                                                    data-content="{{ $berita->isi_berita }}"
                                                                    data-source="{{ $berita->kutipan_sumber }}"
                                                                    data-photo="{{ $berita->photo }}">
                                                                    Edit
                                                                </a>
                                                                <form action="/delete-berita/{{ $berita->id }}"
                                                                    method="POST" class="d-inline">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit"
                                                                        class="btn btn-danger btn-sm"
                                                                        onclick="return confirm('Apakah Anda yakin ingin menghapus berita ini?')">
                                                                        Hapus
                                                                    </button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                        <div class="card col-12 shadow-sm border-0 bg-light text-center py-5 px-3">
                                            <div class="card-body">
                                                <i
                                                    class="mdi mdi-alert-circle-outline text-warning display-1 mb-3"></i>
                                                <h4 class="text-dark fw-bold">Tidak Ada Daftar Berita</h4>
                                                <p class="text-muted mb-4">
                                                    Silahkan tambahkan berita baru untuk menampilkan daftar berita.
                                                </p>
                                                <a href="/beritas/create"
                                                    class="btn btn-primary text-white px-4 py-2">
                                                    Tambah Berita
                                                </a>
                                            </div>
                                        </div>
                                    @endforelse
                                </div>

                                <!-- Pagination -->

                                {{ $beritas->appends(request()->except('page'))->links() }}

                            </div>
                            <div class="card-footer">
                                <a href="/beritas/create" class="btn btn-rounded btn-primary">Tambah Berita</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modals for Viewing and Editing News -->
                @foreach ($beritas as $berita)
                    <!-- Modal for News Details -->
                    <div class="modal fade" id="newsDetailModal{{ $berita->id }}" tabindex="-1" role="dialog"
                        aria-labelledby="newsDetailModalLabel{{ $berita->id }}" aria-hidden="true">
                        <div class="modal-dialog modal-lg px-3" role="document">
                            <div class="modal-content">
                                <!-- Header -->
                                <div class="modal-header bg-primary text-white">
                                    <h5 class="modal-title" id="newsDetailModalLabel{{ $berita->id }}">
                                        <i class="mdi mdi-newspaper me-2"></i> Berita Selengkapnya:
                                        {{ $berita->judul_berita }}
                                    </h5>
                                    <button type="button" class="close text-white" data-dismiss="modal"
                                        aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>

                                <!-- Body -->
                                <div class="modal-body">
                                    <div class="row">
                                        <!-- News Image -->
                                        <div class="col-md-5">
                                            @if ($berita->photo)
                                                <img src="{{ asset($berita->photo) }}" alt="Foto Berita"
                                                    class="img-fluid rounded shadow-sm mb-3"
                                                    style="width: 100%; object-fit: cover;">
                                            @else
                                                <div class="d-flex align-items-center justify-content-center bg-light border rounded shadow-sm"
                                                    style="height: 250px;">
                                                    <i class="mdi mdi-image-off-outline mdi-48px text-muted"></i>
                                                </div>
                                            @endif

                                            <div class="mt-3 p-3 rounded shadow-sm"
                                                style="background-color: #f8f9fa;">
                                                <p class="mb-3">
                                                    <strong class="text-primary"><i
                                                            class="mdi mdi-bookmark-outline me-2"></i>Judul
                                                        Berita:</strong><br>
                                                    <span class="text-dark">{{ $berita->judul_berita }}</span>
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
                                                    <span class="text-dark">{{ $berita->lokasi_peristiwa }}</span>
                                                </p>
                                                <p class="mb-3">
                                                    <strong class="text-warning"><i
                                                            class="mdi mdi-volleyball me-2"></i>
                                                        Kategori Berita:</strong><br>
                                                    <span class="text-dark">{{ $berita->SportCategory->sport_category }}</span>
                                                </p>
                                                <p class="mb-0">
                                                    <strong class="text-success"><i
                                                            class="mdi mdi-source-branch me-2"></i>Kutipan
                                                        Sumber:</strong><br>
                                                    <span class="text-muted">{{ $berita->kutipan_sumber }}</span>
                                                </p>
                                            </div>
                                        </div>

                                        <!-- News Details -->
                                        <div class="col-md-7">
                                            <div class="mb-3 bg-light p-3 rounded shadow-sm">
                                                {!! $berita->isi_berita !!}
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



                    <div class="modal fade" id="newsEditModal" tabindex="-1" role="dialog"
                        aria-labelledby="newsEditModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="newsEditModalLabel">Edit Berita</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="/edit-berita/{{ $berita->id }}" id="newsEditForm" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="row">
                                            <div class="col-md-5">
                                                <label for="photo">Foto</label>
                                                <input type="file" class="form-control-file" id="photo"
                                                    name="photo" accept="image/*" onchange="previewPhoto(event)">
                                                <img id="photoPreview"
                                                    src="{{ old('photo', isset($berita->photo) ? asset($berita->photo) : '') }}"
                                                    alt="Foto" class="img-fluid rounded mt-2"
                                                    style="width: 100%; object-fit: cover;">
                                            </div>

                                            <div class="col-md-7">
                                                <div class="form-group">
                                                    <label for="judul_berita">Judul Berita</label>
                                                    <input type="text" class="form-control" id="judul_berita"
                                                        name="judul_berita" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="tanggal_waktu">Tanggal Waktu</label>
                                                    <input type="datetime" class="form-control" id="tanggal_waktu"
                                                        name="tanggal_waktu" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="lokasi_peristiwa">Lokasi Peristiwa</label>
                                                    <input type="text" class="form-control" id="lokasi_peristiwa"
                                                        name="lokasi_peristiwa" required>
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
                                                                {{ $berita->sport_category == $category->id ? 'selected' : '' }}>
                                                                {{ $category->sport_category }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="isi_berita">Isi Berita</label>
                                                    <textarea class="form-control" id="isi_berita" name="isi_berita" rows="4"></textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label for="kutipan_sumber">Kutipan Sumber</label>
                                                    <input type="text" class="form-control" id="kutipan_sumber"
                                                        name="kutipan_sumber">
                                                </div>
                                            </div>
                                        </div>
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


        <script type="importmap">
                {
                    "imports": {
                        "ckeditor5": "https://cdn.ckeditor.com/ckeditor5/43.3.1/ckeditor5.js",
                        "ckeditor5/": "https://cdn.ckeditor.com/ckeditor5/43.3.1/"
                    }
                }
            </script>
        {{-- <script type="module">
                import {
                    ClassicEditor,
                    Essentials,
                    Bold,
                    Italic,
                    Font,
                    Paragraph
                } from 'ckeditor5';
            
                ClassicEditor
                    .create( document.querySelector( '#isi_berita' ), {
                        plugins: [ Essentials, Bold, Italic, Font, Paragraph ],
                        toolbar: [
                            'undo', 'redo', '|', 'bold', 'italic', '|',
                            'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor'
                        ]
                    } )
                    .then( /* ... */ )
                    .catch( /* ... */ );
            </script> --}}
        <script type="module">
            document.addEventListener('DOMContentLoaded', function() {
                let editorInstance;

                let form = document.getElementById('newsEditForm');
                let photoPreview = document.getElementById('photoPreview');
                let titleInput = document.getElementById('judul_berita');
                let dateInput = document.getElementById('tanggal_waktu');
                let locationInput = document.getElementById('lokasi_peristiwa');
                let sourceInput = document.getElementById('kutipan_sumber');

                document.querySelectorAll('[data-toggle="modal"]').forEach(function(button) {
                    button.addEventListener('click', async function() {
                        let id = button.getAttribute('data-id');
                        let title = button.getAttribute('data-title');
                        let date = button.getAttribute('data-date');
                        let location = button.getAttribute('data-location');
                        let content = button.getAttribute('data-content');
                        let source = button.getAttribute('data-source');
                        let photo = button.getAttribute('data-photo');

                        form.setAttribute('action', '/edit-berita/' + id);
                        titleInput.value = title;
                        dateInput.value = date;
                        locationInput.value = location;
                        sourceInput.value = source;
                        photoPreview.src = photo || '';

                        if (!editorInstance) {
                            const {
                                ClassicEditor,
                                Essentials,
                                Bold,
                                Italic,
                                Font,
                                Paragraph,
                                Alignment
                            } = await import('ckeditor5');
                            editorInstance = await ClassicEditor.create(document.querySelector(
                                '#isi_berita'), {
                                plugins: [Essentials, Bold, Italic, Font, Paragraph,
                                    Alignment
                                ],
                                toolbar: [
                                    'undo', 'redo', '|', 'bold', 'italic', '|',
                                    'fontSize', 'fontFamily', 'fontColor',
                                    'fontBackgroundColor', '|', 'alignment'
                                ],
                                alignment: {
                                    options: ['left', 'center', 'right', 'justify']
                                },
                            });
                        }

                        editorInstance.setData(content);
                    });
                });
            });
        </script>
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
