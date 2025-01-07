<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Pelatih - KONI Sukoharjo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('gambar_aset/images/koni.png') }}">
    <link rel="stylesheet" href="{{ asset('gambar_aset/vendor/owl-carousel/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('gambar_aset/vendor/owl-carousel/css/owl.theme.default.min.css') }}">
    <link href="{{ asset('gambar_aset/vendor/jqvmap/css/jqvmap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('gambar_aset/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('gambar_aset/vendor/datatables/css/jquery.dataTables.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('gambar_aset/assets/vendor/fonts/boxicons.css') }}" />
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <script src="https://unpkg.com/htmx.org@2.0.3"
        integrity="sha384-0895/pl2MU10Hqc6jd4RvrthNlDiE9U1tWmX7WRESftEDRosgxNsQG/Ze9YMRzHq" crossorigin="anonymous">
    </script>
    <style>
        body {
            overflow-x: hidden;
            /* background-attachment: fixed; */
            background: url('/gambar_aset/background_2.png') no-repeat center center fixed;
            background-size: cover;
            height: 100vh;
        }


        .hero-section {
            height: 100vh;
            background: url('/gambar_aset/bg-olahraga.jpg') no-repeat center center;
            background-size: cover;
            background-attachment: fixed;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            color: white;

        }

        .hero-overlay {
            text-align: center;
            background: rgba(0, 0, 0, 0.6);
            /* Semi-transparent background */
            backdrop-filter: blur(5px);
            /* Blurring the background for the glass effect */
            padding: 50px;
            border-radius: 10px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            /* Optional: Border to enhance glass effect */
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            /* Optional: Adds depth */
            transition: transform 0.3s ease;
            /* Smooth zoom effect */
        }

        /* Optional: Zoom-in effect on hover */
        .hero-overlay:hover {
            transform: scale(1.05);
            /* Slight zoom-in */
        }

        .coach-card {
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s ease;
        }

        .coach-card:hover {
            transform: translateY(-10px);
        }

        .coach-photo {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }

        .coach-details {
            padding: 20px;
        }

        .table-borderless td {
            vertical-align: top;
            padding: 0.3rem 0;
            /* Mengurangi jarak atas dan bawah */
        }

        .table-borderless td:first-child {
            width: 40px;
            /* Kolom untuk ikon */
            text-align: center;
        }

        .table-borderless td:nth-child(2) {
            width: 150px;
            /* Kolom untuk label */
            text-align: left;
        }

        .table-borderless td:last-child {
            text-align: left;
            /* Konten dinamis rata kiri */
        }

        #sport-category-filter {
            color: #6c757d;
            /* Ganti dengan warna yang diinginkan */
        }

        @media (max-width: 768px) {

            .hero-title {
                font-size: 20px;
            }

            .hero-subtitle {
                font-size: 12px;
            }

            #table-view table th,
            #table-view table td {
                font-size: 12px;
                padding: 5px;
            }

            #coachDetailModal img {
                width: 100%;
                height: auto;
            }

            #coachName {
                font-size: 16px;
                text-align: center;
            }

            .list-view {
                margin-bottom: 8px;
            }

            #coachDetailModal img {
                width: 100%;
                height: auto;
            }

            #coachName {
                font-size: 16px;
                text-align: center;
            }

            .coach-card {
                height: auto;
                /* Membiarkan kartu menyesuaikan ketinggiannya secara otomatis */
                display: flex;
                flex-direction: column;
            }

            .coach-photo {
                height: 150px;
                /* Default tinggi untuk gambar */
                object-fit: cover;
                /* Memastikan gambar proporsional */
                border-top-left-radius: 0.5rem;
                border-top-right-radius: 0.5rem;
            }
        }
    </style>
</head>

<body>
    @include('viewpublik/layouts/navbar')

    <section class="hero-section">
        <div class="hero-overlay mt-5">
            <h1 class="hero-title text-white fst-italic">#PELATIH_KONI_SKH</h1>
            <p class="hero-subtitle">KONI Sukoharjo, wujudkan olahraga yang berprestasi dan menjunjung tinggi
                sportivitas.</p>
            <a href="#" class="btn btn-warning">Selengkapnya</a>
        </div>
    </section>

    <div class="container my-5">
        <h2 class="text-center mb-4 text-white">Daftar Pelatih KONI Sukoharjo</h2>

        <!-- Tombol untuk mengganti tampilan -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <!-- Tombol untuk mengganti tampilan -->
            <div class="list-view">
                <button id="card-view-btn" class="btn btn-primary active">Card View</button>
                <button id="table-view-btn" class="btn btn-secondary">Table View</button>
            </div>

            <form hx-get="/api/cari-pelatih" hx-target="#data-wrapper" hx-swap="innerHTML"
                hx-trigger="change from:select, click from:button[type='submit']" class="d-flex"
                id="form-sport-category">
                <!-- Dropdown Filter Kategori Olahraga -->
                <select class="form-select form-select-sm me-2" name="sport_category">
                    <option value="">Semua Cabang Olahraga</option>
                    @foreach ($sportCategories as $category)
                        <option value="{{ $category->id }}"
                            {{ request('sport_category') == $category->id ? 'selected' : '' }}>
                            {{ $category->sport_category }}
                        </option>
                    @endforeach
                </select>
                <!-- Form Pencarian -->
                <input type="text" name="search" class="form-control me-2" placeholder="Cari pelatih atau cabor..."
                    value="{{ request('search') }}" id="sport-category-search">
                <!-- View card/table -->
                <input type="hidden" name="_view" id="active-view" value="card">
                <button type="submit" class="btn btn-primary">Cari</button>
            </form>
        </div>


        <div id="data-wrapper">
            <!-- Tampilan Card -->
            <div id="card-view" class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
                @forelse ($coaches as $coach)
                    <div class="col-6 col-sm-4 col-md-3">
                        <div class="card coach-card">
                            <img src="{{ $coach->photo ? asset($coach->photo) : 'https://via.placeholder.com/300x200' }}"
                                alt="{{ $coach->name }}" class="coach-photo">
                            <div class="coach-details text-center p-3">
                                <h6 class="text-dark mb-1">{{ $coach->name }}</h6>
                                <p class="text-muted small mb-2">Cabang: {{ $coach->SportCategory->sport_category }}
                                </p>
                                <a href="#" class="btn btn-primary btn-sm" data-toggle="modal"
                                    data-target="#coachDetailModal{{ $coach->id }}">Detail</a>

                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <!-- Alert untuk Pelatih -->
                        <div class="alert alert-dark text-center p-4 mb-3">
                            <div class="d-flex align-items-center justify-content-center mb-2">
                                <i class="mdi mdi mdi-clock-alert me-2 fs-4"></i>
                                <strong>Belum ada data daftar pelatih yang tersedia saat ini.</strong>
                            </div>
                            <p class="mt-2">Informasi akan diperbarui secara berkala, mohon tunggu beberapa waktu.</p>
                        </div>
                    </div>
                @endforelse
            </div>

            <!-- Tampilan Tabel -->
            <div id="table-view" class="table-responsive rounded" style="display: none;">
                <table class="table table-bordered table-striped" style="min-width: 500px;">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Pelatih</th>
                            <th>Cabang Olahraga</th>
                            <th>Foto</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $no = ($coaches->currentPage() - 1) * $coaches->perPage() + 1;
                        @endphp
                        @forelse ($coaches as $index => $coach)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $coach->name }}</td>
                                <td>{{ $coach->SportCategory->sport_category }}</td>
                                <td>
                                    <img src="{{ $coach->photo ? asset($coach->photo) : 'https://via.placeholder.com/100x100' }}"
                                        alt="{{ $coach->name }}" class="img-thumbnail" width="100">
                                </td>
                                <td>
                                    <a href="#" class="btn btn-primary btn-sm" data-toggle="modal"
                                        data-target="#coachDetailModal{{ $coach->id }}">Detail</a>

                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">
                                    <div class="d-flex justify-content-center align-items-center my-2">
                                        <i class="mdi mdi-alert-circle-outline me-2" style="font-size: 20px;"></i>
                                        <span class="fs-8">Saat ini belum ada data daftar pelatih.</span>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="mt-4">
                {{ $coaches->links('layouts.pagination') }}
            </div>
        </div>

        @foreach ($coaches as $coach)
            <!-- Modal untuk Detail Pelatih -->
            <div class="modal fade mt-5 pt-2" id="coachDetailModal{{ $coach->id }}" tabindex="-1"
                aria-labelledby="coachDetailModalLabel{{ $coach->id }}" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header bg-primary text-white">
                            <h5 class="modal-title text-white" id="coachDetailModalLabel{{ $coach->id }}">
                                Detail Pelatih : {{ $coach->name }}
                            </h5>
                            <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <!-- Kolom kiri: Foto Pelatih -->
                                <div class="col-12 col-md-4 mb-3 mb-md-0 text-center">
                                    <img src="{{ $coach->photo ? asset($coach->photo) : 'https://via.placeholder.com/300x200' }}"
                                        alt="Foto Pelatih" class="img-fluid rounded"
                                        style="max-height: 300px; object-fit: cover;">
                                </div>
                                <!-- Kolom kanan: Detail Pelatih -->
                                <div class="col-md-8">
                                    <table class="table table-borderless table-sm">
                                        <tbody>
                                            <tr>
                                                <td><i class="mdi mdi-account text-primary"></i></td>
                                                <td><strong>Nama</strong></td>
                                                <td>{{ $coach->name }}</td>
                                            </tr>
                                            <tr>
                                                <td><i class="mdi mdi-calendar text-primary"></i></td>
                                                <td><strong>Umur</strong></td>
                                                <td>{{ $coach->age }} tahun</td>
                                            </tr>
                                            <tr>
                                                <td><i class="mdi mdi-whatsapp text-primary"></i></td>
                                                <td><strong>WhatsApp</strong></td>
                                                <td>{{ $coach->whatsapp ?: 'Belum diketahui' }}</td>
                                            </tr>
                                            <tr>
                                                <td><i class="mdi mdi-instagram text-primary"></i></td>
                                                <td><strong>Instagram</strong></td>
                                                <td>{{ $coach->instagram ?: 'Belum diketahui' }}</td>
                                            </tr>
                                            <tr>
                                                <td><i class="mdi mdi-map-marker text-primary"></i></td>
                                                <td><strong>Alamat</strong></td>
                                                <td>{{ $coach->address }}</td>
                                            </tr>
                                            <tr>
                                                <td><i class="mdi mdi-soccer text-primary"></i></td>
                                                <td><strong>Cabang Olahraga</strong></td>
                                                <td>{{ $coach->sportCategory->sport_category }}</td>
                                            </tr>
                                            <tr>
                                                <td><i class="mdi mdi-information text-primary"></i></td>
                                                <td><strong>Deskripsi</strong></td>
                                                <td>{{ $coach->description }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer py-2">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach


    </div>

    @include('viewpublik/layouts/footer')


    <script>
        // Fungsi untuk menyimpan preferensi tampilan ke localStorage
        function setView(view) {
            localStorage.setItem('coachView', view);
        }

        // Fungsi untuk memuat preferensi tampilan dari localStorage
        function loadView() {
            const savedView = localStorage.getItem('coachView');
            if (savedView === 'table') {
                document.getElementById('card-view').style.display = 'none';
                document.getElementById('table-view').style.display = 'block';
                document.getElementById('active-view').value = 'table';
                document.getElementById('table-view-btn').classList.add('active');
                document.getElementById('card-view-btn').classList.remove('active');
            } else {
                document.getElementById('card-view').style.display = 'flex';
                document.getElementById('table-view').style.display = 'none';
                document.getElementById('active-view').value = 'card';
                document.getElementById('card-view-btn').classList.add('active');
                document.getElementById('table-view-btn').classList.remove('active');
            }
        }

        // Event listeners untuk tombol tampilan
        document.getElementById('card-view-btn').addEventListener('click', function() {
            document.getElementById('card-view').style.display = 'flex';
            document.getElementById('table-view').style.display = 'none';
            document.getElementById('active-view').value = 'card';
            setView('card');
        });

        document.getElementById('table-view-btn').addEventListener('click', function() {
            document.getElementById('card-view').style.display = 'none';
            document.getElementById('table-view').style.display = 'block';
            document.getElementById('active-view').value = 'table';
            setView('table');
        });

        // Memuat tampilan saat halaman dimuat
        document.addEventListener('DOMContentLoaded', loadView);
    </script>
    <script>
        document.getElementById('table-wrapper').addEventListener('htmx:afterSwap', function(event) {
            const responseUrl = event.detail.pathInfo.responsePath;
            const nextUrl = responseUrl.replace('/api/cari-pelatih', '/olahraga/pelatih');
            history.pushState(null, '', nextUrl);
        });
    </script>
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
    <!-- Required vendors -->
    <script src="{{ asset('gambar_aset/vendor/global/global.min.js') }}"></script>
    <script src="{{ asset('gambar_aset/js/quixnav-init.js') }}"></script>
    <script src="{{ asset('gambar_aset/js/custom.min.js') }}"></script>

</body>

</html>
