<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Event - KONI Sukoharjo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('gambar_aset/images/koni.png') }}">
    <link rel="stylesheet" href="{{ asset('gambar_aset/vendor/owl-carousel/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('gambar_aset/vendor/owl-carousel/css/owl.theme.default.min.css') }}">
    <link href="{{ asset('gambar_aset/vendor/jqvmap/css/jqvmap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('gambar_aset/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('gambar_aset/vendor/datatables/css/jquery.dataTables.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('gambar_aset/assets/vendor/fonts/boxicons.css') }}" />
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <style>
        body {
            overflow-x: hidden;
            background: url('/gambar_aset/background_2.png') no-repeat center center fixed;
            background-size: cover;
            height: 100vh;
        }

        .hero-section {
            height: 100vh;
            background: url('https://portal.sukoharjokab.go.id/wp-content/uploads/2024/01/20240111-peresmian-gor-dprri1.jpg') no-repeat center center;
            background-size: cover;
            background-attachment: fixed;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            color: white;
        }

        .hero-overlay {
            width: 100%;
            height: 100vh;
            background: rgba(0, 0, 0, 0.6);
            /* Semi-transparent background */
            backdrop-filter: blur(5px);
            /* Blurring the background for the glass effect */
            padding: 50px 20px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            /* Optional: Border to enhance glass effect */
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            /* Optional: Adds depth */
            transition: transform 0.3s ease;
            /* Smooth zoom effect */
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
        }

        .hero-title {
            font-size: 3rem;
            font-weight: bold;
        }

        .hero-subtitle {
            font-size: 16px;
        }

        .hero-overlay .btn {
            font-size: 1rem;
            border-radius: 25px;
            transition: transform 0.3s ease;
        }

        .modal-content {
            border-radius: 10px;
            overflow: hidden;
        }

        .modal-header {
            border-bottom: 2px solid #ffca2c;
        }

        .modal-body {
            padding: 1.5rem;
        }

        .table-borderless td {
            vertical-align: middle;
            padding: 0.5rem 0;
        }

        .table-borderless td:first-child {
            width: 40px;
            /* Ukuran kolom ikon */
            text-align: center;
        }

        .table-borderless td:nth-child(2) {
            width: 150px;
            /* Ukuran kolom label */
        }

        .table-borderless td:last-child {
            text-align: left;
            /* Konten dinamis rata kiri */
        }

        @media (max-width: 768px) {
            .hero-title {
                font-size: 16px;
            }

            .hero-subtitle {
                font-size: 12px;
            }
            #table-view table th,
            #table-view table td {
                font-size: 12px;
                padding: 5px;
            }
            .list-view {
                margin-bottom: 8px;
            }
        }
    </style>
</head>

<body>
    @include('viewpublik/layouts/navbar')

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="hero-overlay d-flex flex-column justify-content-center align-items-center text-center px-5 py-5"
            data-aos="zoom-in" data-aos-delay="0">
            <!-- Lottie Player -->
            <script src="https://unpkg.com/@dotlottie/player-component@2.7.12/dist/dotlottie-player.mjs" type="module"></script>
            <div class="lottie-container mb-4">
                <dotlottie-player src="https://lottie.host/0c528def-1a6e-4b23-a603-012f2e44ec81/sckT9avbgL.lottie"
                    background="transparent" speed="1" style="width: 250px; height: 250px" loop
                    autoplay></dotlottie-player>
            </div>

            <!-- Hero Title -->
            <h1 class="hero-title text-white fst-italic mb-3" data-aos="zoom-in" data-aos-delay="200">
                #PRESTASI_KONI_SKH
            </h1>

            <!-- Subtitle -->
            <p class="hero-subtitle text-white mb-4" data-aos="zoom-in" data-aos-delay="400">
                KONI Sukoharjo, wujudkan Peluang Emas untuk Para Atlet Muda Sukoharjo.
            </p>

            <!-- Button -->
            <a href="#prestasi-section" class="btn btn btn-warning px-4 py-2" data-aos="zoom-in" data-aos-delay="600">
                Selengkapnya
            </a>
        </div>
    </section>

    <div id="prestasi-section" class="container my-5">
        <h2 class="text-center mb-4 text-white">Daftar Prestasi Atlet KONI Sukoharjo</h2>

        <!-- Tombol untuk mengganti tampilan -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <!-- Tombol untuk mengganti tampilan -->
            <div class="list-view">
                <button id="card-view-btn" class="btn btn-primary active">Card View</button>
                <button id="table-view-btn" class="btn btn-secondary">Table View</button>
            </div>

            <!-- Form Pencarian -->
            <form action="{{ route('showPrestasi') }}" method="GET" class="d-flex">
                <input type="text" name="search" class="form-control me-2" placeholder="Cari prestasi atau cabor..."
                    value="{{ request('search') }}">
                <button type="submit" class="btn btn-primary">Cari</button>
            </form>
        </div>

        <!-- Tampilan Card -->
        <div id="card-view" class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
            @forelse ($achievements as $achievement)
                <div class="col-md-3">
                    <div class="card achievement-card">
                        <div class="achievement-details text-center p-3">
                            <h5 class="text-dark">{{ $achievement->athlete_name }}</h5>
                            <p class="text-muted">Cabang: {{ $achievement->sport_category }}</p>
                            <p class="text-muted">Event: {{ $achievement->event_type }}</p>
                            <a href="#" class="btn btn-primary btn-sm"
                                onclick="showAchievementDetails({{ json_encode($achievement) }})"
                                data-bs-toggle="modal" data-bs-target="#achievementDetailModal">Detail</a>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12">
                    <div class="alert alert-dark text-center p-4">
                        <div class="d-flex align-items-center justify-content-center mb-2">
                            <i class="mdi mdi-clock-alert me-2 fs-4"></i>
                            <strong>Belum ada data daftar prestasi yang tersedia saat ini.</strong>
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
                        <th>Nama Atlet</th>
                        <th>Cabang Olahraga</th>
                        <th>Format</th>
                        <th>Deskripsi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $no = ($achievements->currentPage() - 1) * $achievements->perPage() + 1;
                    @endphp
                    @forelse ($achievements as $achievement)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $achievement->athlete_name }}</td>
                            <td>{{ $achievement->sport_category }}</td>
                            <td>{{ $achievement->event_type }}</td>
                            <td>{{ Str::limit($achievement->description, 50) }}</td>
                            <td>
                                <a href="#" class="btn btn-primary btn-sm"
                                    onclick="showAchievementDetails({{ json_encode($achievement) }})"
                                    data-bs-toggle="modal" data-bs-target="#achievementDetailModal">Detail</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">
                                <div class="d-flex justify-content-center align-items-center my-2">
                                    <i class="mdi mdi-alert-circle-outline me-2" style="font-size: 20px;"></i>
                                    <span class="fs-8">Saat ini belum ada data prestasi yang tersedia.</span>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-4">
            {{ $achievements->links('layouts.pagination') }}
        </div>
    </div>

    <!-- Modal Detail -->
    <div class="modal fade" id="achievementDetailModal" tabindex="-1" aria-labelledby="achievementDetailModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content shadow-lg">
                <!-- Modal Header -->
                <div class="modal-header bg-warning d-flex justify-content-between align-items-center">
                    <h5 class="modal-title text-white" id="achievementDetailModalLabel">
                        <i class="mdi mdi-trophy-outline me-2 text-white"></i>Detail Prestasi
                    </h5>
                    <button type="button" class="btn-close btn-close-white text-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>

                <!-- Modal Body -->
                <div class="modal-body">
                    <table class="table table-borderless">
                        <tbody>
                            <tr>
                                <td class="text-primary"><i class="mdi mdi-account-outline"></i></td>
                                <td><strong>Nama Atlet</strong></td>
                                <td id="modal-athlete-name">-</td>
                            </tr>
                            <tr>
                                <td class="text-primary"><i class="mdi mdi-run-fast"></i></td>
                                <td><strong>Cabang Olahraga</strong></td>
                                <td id="modal-sport-category">-</td>
                            </tr>
                            <tr>
                                <td class="text-primary"><i class="mdi mdi-account-group"></i></td>
                                <td><strong>Format Team</strong></td>
                                <td id="modal-event-type">-</td>
                            </tr>
                            <tr>
                                <td class="text-primary"><i class="mdi mdi-information-outline"></i></td>
                                <td><strong>Deskripsi</strong></td>
                                <td id="modal-description">-</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>





    @include('viewpublik/layouts/footer')

</body>
<script>
    function showAchievementDetails(achievement) {
        document.getElementById('modal-athlete-name').textContent = achievement.athlete_name;
        document.getElementById('modal-sport-category').textContent = achievement.sport_category;
        document.getElementById('modal-event-type').textContent = achievement.event_type;
        document.getElementById('modal-description').textContent = achievement.description;
    }
</script>
<script>
    // Fungsi untuk menyimpan preferensi tampilan ke localStorage
    function setAchievementView(view) {
        localStorage.setItem('achievementView', view);
    }

    // Fungsi untuk memuat preferensi tampilan dari localStorage
    function loadAchievementView() {
        const savedView = localStorage.getItem('achievementView');
        if (savedView === 'table') {
            document.getElementById('card-view').style.display = 'none';
            document.getElementById('table-view').style.display = 'block';
            document.getElementById('table-view-btn').classList.add('active');
            document.getElementById('card-view-btn').classList.remove('active');
        } else {
            document.getElementById('card-view').style.display = 'flex';
            document.getElementById('table-view').style.display = 'none';
            document.getElementById('card-view-btn').classList.add('active');
            document.getElementById('table-view-btn').classList.remove('active');
        }
    }

    // Event listeners untuk tombol tampilan
    document.getElementById('card-view-btn').addEventListener('click', function() {
        document.getElementById('card-view').style.display = 'flex';
        document.getElementById('table-view').style.display = 'none';
        setAchievementView('card');
    });

    document.getElementById('table-view-btn').addEventListener('click', function() {
        document.getElementById('card-view').style.display = 'none';
        document.getElementById('table-view').style.display = 'block';
        setAchievementView('table');
    });

    // Memuat tampilan saat halaman dimuat
    document.addEventListener('DOMContentLoaded', loadAchievementView);
</script>
<script src="https://unpkg.com/aos@next/dist/aos.js"></script>
<script>
    AOS.init();
</script>

</html>
