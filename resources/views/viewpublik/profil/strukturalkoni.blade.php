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

        .profile-section {
            background-color: #f8f9fa;
        }

        .chart-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-top: 20px;
        }

        .chart-level {
            display: flex;
            justify-content: center;
            margin: 20px 0;
            flex-wrap: wrap;
            gap: 20px;
        }

        .chart-box {
            background-color: #e0e0e0;
            border: 2px solid #333;
            padding: 15px;
            width: 250px;
            text-align: center;
            font-size: 14px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            color: #fff;
        }

        .chart-box.red {
            background-color: #f44336;
        }

        .chart-box.blue {
            background-color: #2196F3;
        }

        .chart-box.green {
            background-color: #4CAF50;
        }

        .chart-box.yellow {
            background-color: #FFEB3B;
            color: #333;
        }

        .chart-box.brown {
            background-color: #795548;
        }

        .chart-box.purple {
            background-color: #9C27B0;
        }

        .connector {
            display: flex;
            justify-content: center;
            margin: -10px 0 10px 0;
        }

        .line {
            width: 2px;
            background-color: #333;
            height: 30px;
        }

        .horizontal-line {
            height: 2px;
            background-color: #333;
            width: 50px;
        }

        .breadcrumb {
            border-right: 5px solid #FF9800;
            border-radius: 15px;
        }

        @media (max-width: 768px) {
            .hero-title {
                font-size: 16px;
            }

            .hero-subtitle {
                font-size: 12px;
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
            <dotlottie-player src="https://lottie.host/88704d46-e4ea-4c33-937f-76265ef2b635/GLJkwbTevF.lottie"
                background="transparent" speed="1" style="width: 250px; height: 250px" loop
                autoplay></dotlottie-player>

            <!-- Hero Title -->
            <h1 class="hero-title text-white fst-italic mb-3" data-aos="zoom-in" data-aos-delay="200">
                #STRUKTURAL_KONI_SKH
            </h1>

            <!-- Subtitle -->
            <p class="hero-subtitle text-white mb-4" data-aos="zoom-in" data-aos-delay="400">
                KONI Sukoharjo, wujudkan olahraga yang berprestasi dan menjunjung tinggi
                sportivitas.
            </p>

            <!-- Button -->
            <a href="#tentang-section" class="btn btn btn-warning px-4 py-2" data-aos="zoom-in" data-aos-delay="600">
                Selengkapnya
            </a>
        </div>
    </section>

    <section class="profile-section py-4" id="tentang-section">
        <div class="container">
            <nav class="breadcrumb bg-transparent px-3 py-3 shadow-sm" data-aos="fade-down">
                <a class="breadcrumb-item text-decoration-none" href="/">Home</a>
                <span class="breadcrumb-item active text-primary">Profil</span>
                <span class="breadcrumb-item active text-primary">Struktural Koni</span>
            </nav>
            <div class="card shadow-sm border-0 rounded-4" data-aos="zoom-in">
                <div class="card-body text-center">
                    <h2 class="fw-bold mb-4">Struktural Terakhir Ditambahkan</h2>
            
                    @if ($lastStructure)
                        <img 
                            src="{{ asset($lastStructure->photo) }}" 
                            alt="{{ $lastStructure->name }}" 
                            class="img-fluid rounded-4 shadow-sm mb-4"
                            style="max-width: 100%; height: auto;"
                        >
                        <h5 class="fw-bold">{{ $lastStructure->name }}</h5>
                        <p>{{ $lastStructure->position }}</p>
                        <p>Umur: {{ $lastStructure->age }} tahun</p>
                        <p>Tanggal Lahir: {{ \Carbon\Carbon::parse($lastStructure->birth_date)->format('d M Y') }}</p>
                        <p>Jenis Kelamin: {{ $lastStructure->gender }}</p>
                    @else
                        <p>Belum ada data struktural yang ditambahkan.</p>
                    @endif
                </div>
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
