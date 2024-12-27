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
    /* Warna latar belakang dan tampilan untuk status */
    .status-select {
        appearance: none;
        border-radius: 25px;
        padding: 5px 10px;
        border: none;
        color: white;
        font-weight: bold;
        cursor: pointer;
    }

    .status-read {
        background-color: #28a745;
        /* Hijau untuk Dibaca */
    }

    .status-unread {
        background-color: #dc3545;
        /* Merah untuk Belum Dibaca */
    }

    /* Tambahan untuk hover efek */
    .status-select:hover {
        opacity: 0.9;
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
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Pesan Saran</a></li>
                            <li class="breadcrumb-item active"><a href="javascript:void(0)">Daftar Pesan Saran</a></li>
                        </ol>
                    </div>
                </div>
                <!-- row -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Daftar Pesan atau Saran</h4>
                                <!-- Search Form -->
                                <form action="{{ route('messages.index') }}" method="GET" class="form-inline">
                                    <input type="text" name="search" class="form-control mr-2"
                                        placeholder="Cari pesan..." value="{{ request('search') }}">
                                    <button type="submit" class="btn btn-outline-primary">Cari</button>
                                </form>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <!-- Table for displaying messages -->
                                    <table id="messageTable" class="table table-striped table-hover"
                                        style="min-width: 845px;">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Pengirim</th>
                                                <th>Email</th>
                                                <th>Pesan</th>
                                                <th>Status</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody class="text-dark">
                                            @php
                                                $no = ($messages->currentPage() - 1) * $messages->perPage() + 1;
                                            @endphp
                                            @foreach ($messages as $message)
                                                <tr>
                                                    <td>{{ $no++ }}</td>
                                                    <td>{{ $message->name }}</td>
                                                    <td>{{ $message->email }}</td>
                                                    <td>{{ Str::limit($message->message, 50, '...') }}</td>
                                                    <td>
                                                        <form
                                                            action="{{ route('messages.updateStatus', $message->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('PATCH')

                                                            <select name="is_read"
                                                                class="form-control form-control-sm status-select {{ $message->is_read ? 'status-read' : 'status-unread' }}">
                                                                <option value="1"
                                                                    {{ $message->is_read ? 'selected' : '' }}>Dibaca
                                                                </option>
                                                                <option value="0"
                                                                    {{ !$message->is_read ? 'selected' : '' }}>Belum
                                                                    Dibaca</option>
                                                            </select>
                                                        </form>


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
                                                                <!-- View Message Details -->
                                                                <a class="dropdown-item" href="#"
                                                                    data-toggle="modal"
                                                                    data-target="#messageDetailModal{{ $message->id }}">
                                                                    <i class="bx bx-info-circle"></i> Lihat Detail
                                                                </a>
                                                                <!-- Delete Message Form -->
                                                                <form
                                                                    action="{{ route('messages.destroy', $message->id) }}"
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
                                            @endforeach
                                        </tbody>
                                    </table>

                                    <!-- Modals for Message Details -->
                                    @foreach ($messages as $message)
                                        <div class="modal fade" id="messageDetailModal{{ $message->id }}"
                                            tabindex="-1" role="dialog"
                                            aria-labelledby="messageDetailModalLabel{{ $message->id }}"
                                            aria-hidden="true">
                                            <div class="modal-dialog modal-lg" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-primary text-white">
                                                        <h5 class="modal-title"
                                                            id="messageDetailModalLabel{{ $message->id }}">
                                                            Detail Pesan dari: {{ $message->name }}
                                                        </h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body p-3">
                                                        <p><strong>Nama:</strong> {{ $message->name }}</p>
                                                        <p><strong>Email:</strong> {{ $message->email }}</p>
                                                        <p><strong>Pesan:</strong> {{ $message->message }}</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Tutup</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach

                                    <!-- Pagination Links -->
                                    {{ $messages->appends(request()->except('page'))->links() }}
                                </div>
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
            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <script>
                $(document).on('click', '.delete-button', function(e) {
                    e.preventDefault();
                    let form = $(this).closest('form'); // Form yang menghapus pesan
                    swal({
                        title: "Apakah Anda yakin?",
                        text: "Pesan ini akan dihapus secara permanen!",
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
                                text: "Pesan berhasil dihapus.",
                                icon: "success",
                                button: {
                                    text: "OK",
                                    className: "btn btn-primary"
                                }
                            });
                        }
                    });
                });

                $(document).on('change', '.status-select', function(event) {
                    event.preventDefault(); // Mencegah pengiriman form default

                    let select = $(this); // Elemen select saat ini
                    let form = select.closest('form'); // Cari form terdekat
                    let formData = form.serialize(); // Serialize data form

                    // Kirimkan data melalui AJAX
                    $.ajax({
                        url: form.attr('action'), // URL dari form
                        method: form.attr('method'), // Metode dari form (PATCH)
                        data: formData, // Data form
                        success: function(response) {
                            if (response.success) {
                                // Perbarui kelas berdasarkan nilai terpilih
                                if (select.val() === "1") {
                                    select.removeClass('status-unread').addClass('status-read');
                                } else {
                                    select.removeClass('status-read').addClass('status-unread');
                                }

                                // Tampilkan notifikasi
                                swal({
                                    title: "Berhasil!",
                                    text: response.message,
                                    icon: "success",
                                    buttons: {
                                        confirm: {
                                            text: "OK",
                                            className: "btn btn-success"
                                        }
                                    }
                                });
                            }
                        },
                        error: function() {
                            swal({
                                title: "Gagal!",
                                text: "Terjadi kesalahan. Silakan coba lagi.",
                                icon: "error",
                                buttons: {
                                    confirm: {
                                        text: "OK",
                                        className: "btn btn-danger"
                                    }
                                }
                            });
                        }
                    });
                });
            </script>


</body>

</html>
