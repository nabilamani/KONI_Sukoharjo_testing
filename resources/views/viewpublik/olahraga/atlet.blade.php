<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Atlet - KONI Sukoharjo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('gambar_aset/images/koni.png') }}">
    <link rel="stylesheet" href="{{ asset('gambar_aset/vendor/owl-carousel/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('gambar_aset/vendor/owl-carousel/css/owl.theme.default.min.css') }}">
    <link href="{{ asset('gambar_aset/vendor/jqvmap/css/jqvmap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('gambar_aset/css/style.css') }}" rel="stylesheet">
    {{-- <link href="{{ asset('gambar_aset/vendor/datatables/css/jquery.dataTables.min.css') }}" rel="stylesheet"> --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css">
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

        .athlete-card {
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s ease;
        }

        .athlete-card:hover {
            transform: translateY(-10px);
        }

        .athlete-photo {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }

        .athlete-details {
            padding: 20px;
        }

        .table-borderless td {
            vertical-align: top;
            padding: 0.2rem 0;
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
        }

        .table-borderless td:last-child {
            text-align: left;
            /* Konten dinamis rata kiri */
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

            #table-view table img {
                width: 50px;
                height: auto;
            }

            #athleteDetailModal img {
                width: 100%;
                height: auto;
            }

            #athleteName {
                font-size: 16px;
                text-align: center;
            }

            .modal-body {
                padding: 10px;
            }

            .list-view {
                margin-bottom: 8px;
            }

            .athlete-card {
                height: auto;
                /* Membiarkan kartu menyesuaikan ketinggiannya secara otomatis */
                display: flex;
                flex-direction: column;
            }

            .athlete-photo {
                height: 150px;
                /* Default tinggi untuk gambar */
                object-fit: cover;
                /* Memastikan gambar proporsional */
                border-top-left-radius: 0.5rem;
                border-top-right-radius: 0.5rem;
            }

            .card-body .card-title {
                font-size: 14px;
                margin-bottom: 2px;
            }

            .card-body .card-text {
                font-size: 10px;
                /* Ukuran font default untuk total atlet dan gender */
            }

            .card-body .card-text strong {
                font-size: 10px;
                /* Ukuran font default untuk angka */
            }
            .gender p{
                font-size: 6px;
            }
        }
    </style>
</head>

<body>
    @include('viewpublik/layouts/navbar')

    <section class="hero-section">
        <div class="hero-overlay mt-5">
            <h1 class="hero-title text-white fst-italic">#ATLET_KONI_SKH</h1>
            <p class="hero-subtitle">KONI Sukoharjo, wujudkan olahraga yang berprestasi dan menjunjung tinggi
                sportivitas.</p>
            <a href="#" class="btn btn-warning">Selengkapnya</a>
        </div>
    </section>

    <div class="container my-5">
        <h3 class="text-white mb-3">Akumulasi Atlet Per Cabang Olahraga</h3>
        <div id="athleteCategoryCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                @forelse ($categories->chunk(4) as $chunkIndex => $chunk)
                    <div class="carousel-item {{ $chunkIndex == 0 ? 'active' : '' }}">
                        <div class="row">
                            @foreach ($chunk as $category)
                                <div class="col-6 col-md-3 mb-3">
                                    <div class="card mx-2">
                                        <div class="card-body text-center">
                                            <h5 class="card-title text-dark">{{ $category->SportCategory->sport_category }}</h5>
                                            <p class="card-text text-primary mb-1">
                                                <strong>{{ $category->total }}</strong> Atlet
                                            </p>
                                            <div class="d-flex justify-content-between text-muted small gender">
                                                <p class="mb-0 bg-light text-success rounded px-2 py-1">
                                                    <strong>{{ $category->male_total }}</strong> Laki-laki
                                                </p>
                                                <p class="mb-0 bg-light text-danger rounded px-2 py-1">
                                                    <strong>{{ $category->female_total }}</strong> Perempuan
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        
                    </div>
                @empty
                    <div class="carousel-item active">
                        <div class="alert alert-warning text-center p-4">
                            <i class="mdi mdi-alert-circle-outline fs-3"></i>
                            <p class="mt-2 mb-0">
                                <strong>Tidak ada data akumulasi cabor yang tersedia saat ini.</strong>
                            </p>
                            <p class="mt-1">Data akan diperbarui secara berkala. Mohon tunggu atau coba lagi nanti.
                            </p>
                        </div>
                    </div>
                @endforelse
            </div>

            <!-- Carousel indicators (dots) -->
            <div class="carousel-indicators">
                @foreach ($categories->chunk(4) as $chunkIndex => $chunk)
                    <button type="button" data-bs-target="#athleteCategoryCarousel"
                        data-bs-slide-to="{{ $chunkIndex }}" class="{{ $chunkIndex == 0 ? 'active' : '' }}"
                        aria-current="true" aria-label="Slide {{ $chunkIndex + 1 }}"></button>
                @endforeach
            </div>
        </div>

        <div id="chart" class="my-2 p-3 bg-white rounded-sm"></div>
        <hr class="mx-4">

        <h2 class="text-center mb-4 text-white">Daftar Atlet KONI Sukoharjo</h2>
        <!-- Tombol untuk mengganti tampilan -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <!-- Tombol untuk mengganti tampilan -->
            <div class="list-view">
                <button id="card-view-btn" class="btn btn-primary active">Card View</button>
                <button id="table-view-btn" class="btn btn-secondary">Table View</button>
            </div>

            <!-- Form Pencarian -->
            <form hx-get="/api/cari-atlet" hx-target="#data-wrapper" hx-swap="innerHTML"
                hx-trigger="change from:select, click from:button[type='submit']" class="d-flex"
                id="form-sport-category">
                <!-- Dropdown Filter Kategori Olahraga -->
                <select class="form-select form-select-sm me-2" name="sport_category">
                    <option value="">Semua Cabang Olahraga</option>
                    @foreach ($sportCategories as $category)
                        <option value="{{ $category }}"
                            {{ request('sport_category->') == $category ? 'selected' : '' }}>
                            {{ $category }}
                        </option>
                    @endforeach
                </select>
                <!-- Form Pencarian -->
                <input type="text" name="search" class="form-control me-2" placeholder="Cari atlet atau cabor..."
                    value="{{ request('search') }}" id="sport-category-search">
                <!-- View card/table -->
                <input type="hidden" name="_view" id="active-view" value="card">
                <button type="submit" class="btn btn-primary">Cari</button>
            </form>


        </div>

        <!-- Tampilan Card -->
        <div id="data-wrapper">
            <div id="card-view" class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
                @forelse ($athletes as $athlete)
                    <div class="col-6 col-sm-4 col-md-3">
                        <div class="card athlete-card h-100">
                            <!-- Foto Atlet (Gunakan placeholder jika tidak ada gambar) -->
                            <img src="{{ $athlete->photo ? asset($athlete->photo) : 'https://via.placeholder.com/300x200' }}"
                                alt="{{ $athlete->name }}" class="athlete-photo img-fluid">
                            <div class="athlete-details text-center p-2">
                                <h6 class="text-dark mb-1">{{ $athlete->name }}</h6>
                                <p class="text-muted small mb-2">Cabang: {{ $athlete->SportCategory->sport_category }}</p>
                                <a href="#" class="btn btn-primary btn-sm"
                                    onclick="showAthleteDetails({{ json_encode($athlete) }})" data-bs-toggle="modal"
                                    data-bs-target="#athleteDetailModal">
                                    Detail
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="alert alert-dark text-center p-4">
                            <div class="d-flex align-items-center justify-content-center mb-2">
                                <i class="mdi mdi-account-alert me-2 fs-4"></i>
                                <strong>Belum ada data daftar atlet yang tersedia saat ini.</strong>
                            </div>
                            <p class="mt-2">Informasi akan diperbarui secara berkala, mohon tunggu beberapa waktu.
                            </p>
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
                            <th>Foto</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $no = ($athletes->currentPage() - 1) * $athletes->perPage() + 1;
                        @endphp
                        @forelse ($athletes as $index => $athlete)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $athlete->name }}</td>
                                <td>{{ $athlete->SportCategory->sport_category }}</td>
                                <td>
                                    <img src="{{ $athlete->photo ? asset($athlete->photo) : 'https://via.placeholder.com/100x100' }}"
                                        alt="{{ $athlete->name }}" class="img-thumbnail" width="100">
                                </td>
                                <td>
                                    <a href="#" class="btn btn-primary btn-sm"
                                        onclick="showAthleteDetails({{ json_encode($athlete) }})"
                                        data-bs-toggle="modal" data-bs-target="#athleteDetailModal">Detail</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">
                                    <div class="d-flex justify-content-center align-items-center my-2">
                                        <i class="mdi mdi-alert-circle-outline me-2" style="font-size: 20px;"></i>
                                        <span class="fs-8">Saat ini belum ada data daftar atlet.</span>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <!-- Pagination -->
            <div class="mt-4">
                {{ $athletes->links('layouts.pagination') }}
            </div>
        </div>
    </div>
    <!-- Modal untuk Detail Atlet -->
    <div class="modal fade mt-5 pt-2" id="athleteDetailModal" tabindex="-1"
        aria-labelledby="athleteDetailModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-primary d-flex align-items-center">
                    <h5 class="modal-title text-white" id="athleteDetailModalLabel">Detail Atlet</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body position-relative">
                    <!-- Logo di kanan atas -->
                    <img id="athleteLogo" src="{{ asset('gambar_aset/images/koni.png') }}" alt="Logo"
                        class="position-absolute d-none d-md-block"
                        style="top: 0; right: 0; width: 80px; height: 80px; margin: 10px; z-index: 10;">

                    <div class="row">
                        <div class="col-12 col-md-4 mb-3 mb-md-0 text-center">
                            <!-- Foto Atlet -->
                            <img id="athletePhoto" src="" alt="Foto Atlet" class="img-fluid rounded">
                        </div>
                        <div class="col-12 col-md-8">
                            <!-- Detail Atlet -->
                            <h5 id="athleteName" class="text-dark mb-3"></h5>
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <td class="text-center text-md-start"><i
                                                class="mdi mdi-trophy text-primary"></i></td>
                                        <td><strong>Cabang Olahraga</strong></td>
                                        <td id="athleteSportCategory">-</td>
                                    </tr>
                                    <tr>
                                        <td class="text-center text-md-start"><i
                                                class="mdi mdi-calendar text-primary"></i></td>
                                        <td><strong>Tanggal Lahir</strong></td>
                                        <td>
                                            <span id="athleteBirthDate">-</span> (<span id="athleteAge">-</span>
                                            tahun)
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-center text-md-start"><i
                                                class="mdi mdi-gender-male-female text-primary"></i></td>
                                        <td><strong>Jenis Kelamin</strong></td>
                                        <td id="athleteGender">-</td>
                                    </tr>
                                    <tr>
                                        <td class="text-center text-md-start"><i
                                                class="mdi mdi-human text-primary"></i></td>
                                        <td><strong>Tinggi Badan</strong></td>
                                        <td id="athleteHeight">-</td>
                                    </tr>
                                    <tr>
                                        <td class="text-center text-md-start"><i
                                                class="mdi mdi-weight-kilogram text-primary"></i></td>
                                        <td><strong>Berat Badan</strong></td>
                                        <td id="athleteWeight">-</td>
                                    </tr>
                                    <tr>
                                        <td class="text-center text-md-start"><i
                                                class="mdi mdi-medal text-primary"></i></td>
                                        <td><strong>Prestasi</strong></td>
                                        <td>
                                            <ul id="athleteAchievements" class="list-unstyled mb-0"></ul>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="modal-footer py-2">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>






    @include('viewpublik/layouts/footer')


    <script>
        // Fungsi untuk menyimpan preferensi tampilan ke localStorage
        function setView(view) {
            localStorage.setItem('athleteView', view);
        }

        // Fungsi untuk memuat preferensi tampilan dari localStorage
        function loadView() {
            const savedView = localStorage.getItem('athleteView');
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
        function showAthleteDetails(athlete) {
            // Isi data ke modal
            document.getElementById('athletePhoto').src = athlete.photo ? `{{ asset('') }}${athlete.photo}` :
                'https://via.placeholder.com/300x200';
            document.getElementById('athleteName').textContent = athlete.name;
            document.getElementById('athleteSportCategory').textContent = athlete.sport_category;
            document.getElementById('athleteBirthDate').textContent = athlete.birth_date;
            document.getElementById('athleteAge').textContent = athlete.age;
            document.getElementById('athleteGender').textContent = athlete.gender || 'Tidak Diketahui';
            document.getElementById('athleteHeight').textContent = athlete.height;
            document.getElementById('athleteWeight').textContent = athlete.weight;

            // Prestasi
            const achievementsList = document.getElementById('athleteAchievements');
            achievementsList.innerHTML = ''; // Hapus list sebelumnya
            const achievements = athlete.achievements.split(';'); // Pisahkan prestasi berdasarkan ";"
            achievements.forEach(item => {
                const li = document.createElement('li');
                li.textContent = item.trim();
                achievementsList.appendChild(li);
            });
        }
    </script>
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
    <script>
        document.getElementById('table-wrapper').addEventListener('htmx:afterSwap', function(event) {
            const responseUrl = event.detail.pathInfo.responsePath;
            const nextUrl = responseUrl.replace('/api/cari-atlet', '/olahraga/atlet');
            history.pushState(null, '', nextUrl);
        });
    </script>
    <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
    {{-- <script>
        function filterAthletes() {
            const input = document.getElementById('searchInput').value.toLowerCase();

            // Filter Card View
            const cards = document.querySelectorAll('#card-view .athlete-card');
            cards.forEach(card => {
                const name = card.querySelector('h5').textContent.toLowerCase();
                const category = card.querySelector('p').textContent.toLowerCase();
                if (name.includes(input) || category.includes(input)) {
                    card.parentElement.style.display = '';
                } else {
                    card.parentElement.style.display = 'none';
                }
            });

            // Filter Table View
            const rows = document.querySelectorAll('#table-view tbody tr');
            rows.forEach(row => {
                const name = row.children[1].textContent.toLowerCase();
                const category = row.children[2].textContent.toLowerCase();
                if (name.includes(input) || category.includes(input)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        }
    </script> --}}
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var options = {
                chart: {
                    type: 'bar',
                    height: 350
                },
                series: [{
                    name: 'Jumlah Atlet',
                    data: @json($categories->pluck('total')) // Data jumlah atlet per kategori
                }],
                xaxis: {
                    categories: @json($categories->pluck('SportCategory.sport_category')), // Nama kategori olahraga
                    labels: {
                        style: {
                            fontSize: '10px' // Ukuran font untuk label kategori
                        }
                    }
                },
                colors: ['#FFA500'], // Warna oranye
                title: {
                    text: 'Statistik Atlet per Kategori Olahraga',
                    align: 'center'
                }
            };

            var chart = new ApexCharts(document.querySelector("#chart"), options);
            chart.render();
        });
    </script>
</body>

</html>
