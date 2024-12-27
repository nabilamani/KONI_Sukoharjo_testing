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
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Pelatih</a></li>
                            <li class="breadcrumb-item active"><a href="javascript:void(0)">Daftar Pelatih</a></li>
                        </ol>
                    </div>
                </div>
                <!-- row -->
                <div class="row">
                    <!-- Basic Layout -->
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Daftar Pelatih</h4>
                                <form action="{{ route('coaches.index') }}" method="GET" class="form-inline">
                                    <input type="text" name="search" class="form-control mr-2"
                                        placeholder="Cari pelatih..." value="{{ request('search') }}">
                                    <button type="submit" class="btn btn-outline-primary">Cari</button>
                                </form>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="coachTable" class="table table-striped table-hover"
                                        style="min-width: 845px;">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th>No</th>
                                                <th>ID</th>
                                                <th>Nama</th>
                                                <th>Umur</th>
                                                <th>Alamat</th>
                                                <th>Cabang Olahraga</th>
                                                <th style="width: 20%">Deskripsi</th>
                                                {{-- <th>Domisili</th> --}}
                                                {{-- <th>Club</th> --}}
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody class="text-dark">
                                            @php
                                                $no = ($coaches->currentPage() - 1) * $coaches->perPage() + 1;
                                            @endphp
                                            @forelse ($coaches as $key => $coach)
                                                <tr>
                                                    <td>{{ $no++ }}</td>
                                                    <!-- Increment $no to continue numbering -->
                                                    <td>{{ $coach->id }}</td>
                                                    <td><img src="{{ $coach->photo }}" width="50" alt="">
                                                        {{ $coach->name }}</td>
                                                    <td>{{ $coach->age }}</td>
                                                    <td>{{ $coach->address }}</td>
                                                    <td>{{ $coach->sport_category }}</td>
                                                    <td>{{ $coach->description }}</td>
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
                                                                    data-target="#coachDetailModal{{ $coach->id }}"><i
                                                                        class="bx bx-info-circle"></i> Lihat
                                                                    Detail</a>
                                                                <a class="dropdown-item" href=""
                                                                    data-toggle="modal"
                                                                    data-target="#coachEditModal{{ $coach->id }}"><i
                                                                        class="bx bx-edit-alt"></i> Edit</a>
                                                                <!-- Delete Message Form -->
                                                                <form
                                                                    action="{{ route('coaches.destroy', $coach->id) }}"
                                                                    method="POST" class="d-inline">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="button"
                                                                        class="dropdown-item delete-button">
                                                                        <i class="bx bx-trash"></i> Hapus
                                                                    </button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                @empty
                                                <tr>
                                                    <td colspan="8" class="text-center">
                                                        <div class="d-flex justify-content-center align-items-center my-2">
                                                            <i class="mdi mdi-alert-circle-outline me-2" style="font-size: 20px;"></i>
                                                            <span class="fs-8">Saat ini belum ada data daftar pelatih.</span>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforelse
                                        </tbody>

                                    </table>
                                    @foreach ($coaches as $coach)
                                        <!-- Modal -->

                                        <div class="modal fade" id="coachDetailModal{{ $coach->id }}"
                                            tabindex="-1" role="dialog"
                                            aria-labelledby="coachDetailModalLabel{{ $coach->id }}"
                                            aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-primary text-white">
                                                        <h5 class="modal-title"
                                                            id="coachDetailModalLabel{{ $coach->id }}">
                                                            Detail Pelatih: {{ $coach->name }}
                                                        </h5>
                                                        <button type="button" class="close text-white"
                                                            data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <!-- Left column: Coach photo -->
                                                            <div class="col-md-4 text-center">
                                                                <img src="{{ $coach->photo }}"
                                                                    class="img-fluid rounded" alt="Foto Pelatih"
                                                                    style="max-height: 300px; object-fit: cover;">
                                                            </div>
                                                            <!-- Right column: Coach details with table -->
                                                            <div class="col-md-8">
                                                                <table class="table table-borderless table-sm">
                                                                    <tbody>
                                                                        <tr>
                                                                            <td scope="row" style="width: 30%;">
                                                                                <i
                                                                                    class="mdi mdi-account text-primary"></i>
                                                                                Nama:
                                                                            </td>
                                                                            <td>{{ $coach->name }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th scope="row">
                                                                                <i
                                                                                    class="mdi mdi-cake text-primary"></i>
                                                                                Umur:
                                                                            </th>
                                                                            <td>{{ $coach->age }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th scope="row">
                                                                                <i
                                                                                    class="mdi mdi-whatsapp text-primary"></i>
                                                                                WhatsApp:
                                                                            </th>
                                                                            <td>{{ $coach->whatsapp ?: 'Belum diketahui' }}
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th scope="row">
                                                                                <i
                                                                                    class="mdi mdi-instagram text-primary"></i>
                                                                                Instagram:
                                                                            </th>
                                                                            <td>{{ $coach->instagram ?: 'Belum diketahui' }}
                                                                            </td>
                                                                        </tr>

                                                                        <tr>
                                                                            <th scope="row">
                                                                                <i
                                                                                    class="mdi mdi-home text-primary"></i>
                                                                                Alamat:
                                                                            </th>
                                                                            <td>{{ $coach->address }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th scope="row">
                                                                                <i
                                                                                    class="mdi mdi-soccer text-primary"></i>
                                                                                Cabang Olahraga:
                                                                            </th>
                                                                            <td>{{ $coach->sport_category }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th scope="row">
                                                                                <i
                                                                                    class="mdi mdi-information text-primary"></i>
                                                                                Deskripsi:
                                                                            </th>
                                                                            <td>{{ $coach->description }}</td>
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


                                        <div class="modal fade" id="coachEditModal{{ $coach->id }}"
                                            tabindex="-1" role="dialog"
                                            aria-labelledby="coachEditModalLabel{{ $coach->id }}"
                                            aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-primary text-white">
                                                        <h5 class="modal-title"
                                                            id="coachEditModalLabel{{ $coach->id }}">Edit Pelatih:
                                                            {{ $coach->name }}</h5>
                                                        <button type="button" class="close text-white"
                                                            data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <!-- Form Edit Pelatih -->
                                                        <form action="/edit-pelatih/{{ $coach->id }}"
                                                            method="POST" enctype="multipart/form-data">
                                                            @csrf
                                                            @method('PUT')

                                                            <div class="row">
                                                                <!-- Left column -->
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label for="name">Nama</label>
                                                                        <input type="text" class="form-control"
                                                                            id="name" name="name"
                                                                            value="{{ $coach->name }}" required>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="age">Umur</label>
                                                                        <input type="number" class="form-control"
                                                                            id="age" name="age"
                                                                            value="{{ $coach->age }}" required>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="whatsapp">WhatsApp</label>
                                                                        <input type="text" class="form-control"
                                                                            id="whatsapp" name="whatsapp"
                                                                            value="{{ $coach->whatsapp }}"
                                                                            required>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="instagram">Instagram</label>
                                                                        <input type="text" class="form-control"
                                                                            id="instagram" name="instagram"
                                                                            value="{{ $coach->instagram }}"
                                                                            required>
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label for="sport_category">Cabang
                                                                            Olahraga</label>
                                                                        <select id="sportCategorySelect"
                                                                            name="sport_category"
                                                                            class="form-control sport-category-select">
                                                                            <option
                                                                                value="{{ $coach->sport_category }}"
                                                                                hidden selected disabled>Pilih
                                                                                kategori..</option>
                                                                        </select>
                                                                    </div>
                                                                </div>


                                                                <!-- Right column -->
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label for="address">Alamat</label>
                                                                        <input type="text" class="form-control"
                                                                            id="address" name="address"
                                                                            value="{{ $coach->address }}" required>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="description">Deskripsi</label>
                                                                        <textarea class="form-control" id="description" name="description" rows="3" required>{{ $coach->description }}</textarea>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="photo">Foto</label>
                                                                        <input type="file"
                                                                            class="form-control-file" id="photo"
                                                                            name="photo"
                                                                            onchange="previewNewPhoto()">
                                                                        <div class="mt-2">
                                                                            <img id="photo-preview"
                                                                                src="{{ $coach->photo ? asset($coach->photo) : '#' }}"
                                                                                class="img-fluid rounded {{ $coach->photo ? '' : 'd-none' }}"
                                                                                width="100" alt="Foto Pelatih">
                                                                            <span id="no-photo-text"
                                                                                class="text-muted {{ $coach->photo ? 'd-none' : '' }}">Tidak
                                                                                ada Foto</span>
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

                                    {{ $coaches->appends(request()->except('page'))->links() }}
                                </div>
                            </div>
                            <div class="card-footer">
                                <a href="/coaches/create" class="btn btn-rounded btn-primary">
                                    <i class="mdi mdi-account-plus"></i> Tambah Pelatih
                                </a>
                                <a href="{{ route('cetak-pelatih') }}" target="_blank"
                                    class="btn btn-rounded btn-primary mx-2">
                                    <i class="mdi mdi-printer"></i> Cetak Laporan
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
        <script>
            function previewNewPhoto() {
                const fileInput = document.getElementById('photo');
                const preview = document.getElementById('photo-preview');
                const noPhotoText = document.getElementById('no-photo-text');

                if (fileInput.files && fileInput.files[0]) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        preview.src = e.target.result;
                        preview.classList.remove('d-none');
                        noPhotoText.classList.add('d-none');
                    };
                    reader.readAsDataURL(fileInput.files[0]);
                } else {
                    preview.src = '#';
                    preview.classList.add('d-none');
                    noPhotoText.classList.remove('d-none');
                }
            }
        </script>
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
        <script>
            $(document).on('click', '.delete-button', function(e) {
                e.preventDefault();
                let form = $(this).closest('form'); // Form yang menghapus pesan
                swal({
                    title: "Apakah Anda yakin?",
                    text: "Data Pelatih ini akan dihapus secara permanen!",
                    icon: "warning",
                    buttons: {
                        cancel: {
                            text: "Batal",
                            visible: true,
                            className: "btn btn-secondary"
                        },
                        confirm: {
                            text: "Ya, Hapus",
                            className: "btn btn-danger"
                        }
                    },
                    dangerMode: true,
                }).then((willDelete) => {
                    if (willDelete) {
                        form.submit(); // Kirim formulir untuk menghapus data

                        // Tampilkan notifikasi sukses setelah penghapusan
                        swal({
                            title: "Berhasil!",
                            text: "Data Pelatih berhasil dihapus.",
                            icon: "success",
                            button: {
                                text: "OK",
                                className: "btn btn-primary"
                            }
                        });
                    }
                });
            });
        </script>

        <!-- Alert -->
        @if (Session::has('message'))
            <script>
                swal("Berhasil", "{{ Session::get('message') }}", 'success', {
                    button: true,
                    button: "Ok",
                    timer: 5000
                });
            </script>
        @endif
        <script>
            const searchInput = document.querySelector('#search-coach');
            const tableRows = document.querySelectorAll('tbody tr');

            searchInput.addEventListener('input', () => {
                const searchTerm = searchInput.value.toLowerCase();

                tableRows.forEach(row => {
                    const rowText = row.textContent.toLowerCase();
                    const matches = rowText.includes(searchTerm);
                    row.classList.toggle('hide', !matches); // Hide rows that don't match
                });

                // Alternate row colors for visible rows
                const visibleRows = document.querySelectorAll('tbody tr:not(.hide)');
                visibleRows.forEach((row, index) => {
                    row.style.backgroundColor = index % 2 === 0 ? 'transparent' : '#f9f9f9';
                });
            });
        </script>
</body>

</html>
