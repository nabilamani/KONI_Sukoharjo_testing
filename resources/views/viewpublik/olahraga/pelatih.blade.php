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
            <div>
                <button id="card-view-btn" class="btn btn-primary active">Card View</button>
                <button id="table-view-btn" class="btn btn-secondary">Table View</button>
            </div>

            <!-- Form Pencarian -->
            <form action="{{ route('showCoaches') }}" method="GET" class="d-flex">
                <input type="text" name="search" class="form-control me-2"
                    placeholder="Cari pelatih atau cabang olahraga..." value="{{ request('search') }}">
                <button type="submit" class="btn btn-primary">Cari</button>
            </form>
        </div>

        <!-- Tampilan Card -->
        <div id="card-view" class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
            @foreach ($coaches as $coach)
                <div class="col-md-3">
                    <div class="card coach-card">
                        <img src="{{ $coach->photo ? asset($coach->photo) : 'https://via.placeholder.com/300x200' }}"
                            alt="{{ $coach->name }}" class="coach-photo">
                        <div class="coach-details text-center p-3">
                            <h5 class="text-dark">{{ $coach->name }}</h5>
                            <p class="text-muted">Cabang: {{ $coach->sport_category }}</p>
                            <a href="#" class="btn btn-primary btn-sm"
                                onclick="showCoachDetails({{ json_encode($coach) }})" data-bs-toggle="modal"
                                data-bs-target="#coachDetailModal">Detail</a>

                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Tampilan Tabel -->
        <div id="table-view" class="table-responsive rounded" style="display: none;">
            <table class="table table-bordered table-striped">
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
                    @foreach ($coaches as $index => $coach)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $coach->name }}</td>
                            <td>{{ $coach->sport_category }}</td>
                            <td>
                                <img src="{{ $coach->photo ? asset($coach->photo) : 'https://via.placeholder.com/100x100' }}"
                                    alt="{{ $coach->name }}" class="img-thumbnail" width="100">
                            </td>
                            <td>
                                <a href="#" class="btn btn-primary btn-sm"
                                    onclick="showCoachDetails({{ json_encode($coach) }})" data-bs-toggle="modal"
                                    data-bs-target="#coachDetailModal">Detail</a>

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-4">
            {{ $coaches->links() }}
        </div>
        <!-- Modal untuk Detail Pelatih -->
        <div class="modal fade mt-5 pt-2" id="coachDetailModal" tabindex="-1" aria-labelledby="coachDetailModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header bg-primary">
                        <h5 class="modal-title text-white" id="coachDetailModalLabel">Detail Pelatih</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-4">
                                <img id="coachPhoto" src="" alt="Foto Pelatih" class="img-fluid rounded">
                            </div>
                            <div class="col-md-8">
                                <h5 id="coachName" class="text-dark mb-3"></h5>
                                <p class="mb-0">
                                    <strong><i class="mdi mdi-soccer mr-1 text-primary"></i> Cabang Olahraga :</strong>
                                    <span id="coachSportCategory"></span>
                                </p>
                                <p class="mb-0">
                                    <strong><i class="mdi mdi-map-marker mr-1 text-primary"></i> Alamat :</strong>
                                    <span id="coachAddress"></span>
                                </p>
                                <p class="mb-0">
                                    <strong><i class="mdi mdi-calendar mr-1 text-primary"></i> Usia :</strong>
                                    <span id="coachAge"></span> tahun
                                </p>
                                <p class="mb-0">
                                    <strong><i class="mdi mdi-information mr-1 text-primary"></i> Deskripsi :</strong>
                                    <span id="coachDescription"></span>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer py-2">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>

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
            setView('card');
        });

        document.getElementById('table-view-btn').addEventListener('click', function() {
            document.getElementById('card-view').style.display = 'none';
            document.getElementById('table-view').style.display = 'block';
            setView('table');
        });

        // Memuat tampilan saat halaman dimuat
        document.addEventListener('DOMContentLoaded', loadView);
    </script>
    <script>
        function showCoachDetails(coach) {
            document.getElementById('coachPhoto').src = coach.photo ? `{{ asset('') }}${coach.photo}` :
                'https://via.placeholder.com/300x200';
            document.getElementById('coachName').textContent = coach.name;
            document.getElementById('coachSportCategory').textContent = coach.sport_category;
            document.getElementById('coachAddress').textContent = coach.address || 'Tidak Diketahui';
            document.getElementById('coachAge').textContent = coach.age || 'Tidak Diketahui';
            document.getElementById('coachDescription').textContent = coach.description || 'Tidak Diketahui';
        }
    </script>


</body>

</html>
