<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KONI Sukoharjo</title>
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


        .sport-card {
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s ease;
            border-top: solid 3px #E00818;
        }

        .sport-card:hover {
            transform: translateY(-10px);
        }

        .sport-logo {
            width: 80px;
            height: 80px;
            object-fit: contain;
        }

        .breadcrumb {
            border-right: 5px solid #E00818;
            border-radius: 15px;
        }

        @media (max-width: 768px) {
            .hero-title {
                font-size: 16px;
            }

            .hero-subtitle {
                font-size: 12px;
            }

            .sport-logo {
                max-width: 60px;
                max-height: 60px;
            }

            .sport-name {
                font-size: 12px;
            }

            .sport-category {
                font-size: 11px;
            }
            .deskripsi {
                font-size: 11px;
                margin: 0px 20px;
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
                <dotlottie-player src="https://lottie.host/55b08a51-c7ba-4378-b360-11de20d377bd/GAHH8rAzYz.lottie"
                    background="transparent" speed="1" style="width: 250px; height: 250px" loop
                    autoplay></dotlottie-player>
            </div>

            <!-- Hero Title -->
            <h1 class="hero-title text-white fst-italic mb-3" data-aos="zoom-in" data-aos-delay="200">
                #CABOR_KONI_SKH
            </h1>

            <!-- Subtitle -->
            <p class="hero-subtitle text-white mb-4" data-aos="zoom-in" data-aos-delay="400">
                KONI Sukoharjo, wujudkan Peluang Emas untuk Para Atlet Muda Sukoharjo.
            </p>

            <!-- Button -->
            <a href="#cabor-section" class="btn btn btn-warning px-4 py-2" data-aos="zoom-in" data-aos-delay="600">
                Selengkapnya
            </a>
        </div>
    </section>




    <section id="cabor-section">
        <div class="container my-4">
            <nav class="breadcrumb bg-transparent px-3 py-3 shadow-sm">
                <a class="breadcrumb-item text-decoration-none" href="/">Home</a>
                <span class="breadcrumb-item active text-primary">Olahraga</span>
                <span class="breadcrumb-item active text-primary">Cabor</span>
            </nav>
            <h2 class="text-center">Ragam Cabang Olahraga</h2>
            <p class="text-center mb-4 text-dark deskripsi">Temukan berbagai cabang olahraga yang tersedia untuk mendukung
                aktivitas dan prestasi Anda.</p>
            <div class="row g-4 justify-content-center">
                @forelse($SportCategories as $SportCategory)
                    <div class="col-6 col-sm-4 col-md-3 col-lg-3 d-flex justify-content-center">
                        <a href="{{ route('cabor.show', $SportCategory->id) }}" class="text-decoration-none w-100">
                            <div class="card text-center p-3 sport-card h-100">
                                <img src="{{ asset($SportCategory->logo ?? 'img/default.png') }}"
                                    alt="{{ $SportCategory->nama_cabor }}" class="sport-logo mx-auto mb-3"
                                    style="width: 80px; height: 80px; object-fit: contain; background-color: #ffff;">
                                <h5 class="text-dark sport-name">{{ $SportCategory->nama_cabor }}</h5>
                                <p class="text-muted sport-category">{{ $SportCategory->sport_category }}</p>
                            </div>
                        </a>
                    </div>
                @empty
                    <div class="col-12 d-flex flex-column align-items-center py-5">
                        <i class="mdi mdi-alert-circle-outline text-warning display-3 mb-3"></i>
                        <h5 class="text-muted text-center">Belum ada data cabang olahraga yang tersedia saat ini.</h5>
                        <a href="/" class="btn btn-primary mt-4 px-4">
                            Kembali ke Beranda
                        </a>
                    </div>
                @endforelse
            </div>
        </div>
    </section>



    @include('viewpublik/layouts/footer')
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
</body>

</html>
