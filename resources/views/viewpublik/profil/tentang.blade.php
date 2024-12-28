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

        .profile-section h2 {
            color: #2c3e50;
        }

        .profile-section img {
            max-width: 250px;
            height: auto;
            border-radius: 10px;
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
            <div class="lottie-container mb-4">
                <dotlottie-player src="https://lottie.host/f7e21688-11aa-41f4-bfc3-885a4483adf5/lK6R71kTw0.lottie" background="transparent" speed="1" style="width: 250px; height: 250px" loop autoplay></dotlottie-player>
            </div>

            <!-- Hero Title -->
            <h1 class="hero-title text-white fst-italic mb-3" data-aos="zoom-in" data-aos-delay="200">
                #TENTANG_KONI_SKH
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
            <nav class="breadcrumb bg-transparent px-3 py-3 shadow-sm">
                <a class="breadcrumb-item text-decoration-none" href="/">Home</a>
                <span class="breadcrumb-item active text-primary">Profil</span>
                <span class="breadcrumb-item active text-primary">Tentang</span>
            </nav>
            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-body">
                    <h2 class="fw-bold mb-4 text-center">PROFIL</h2>
                    <div class="row align-items-center">
                        <!-- Image Section -->
                        <div class="col-md-4 text-center mb-4 mb-md-0">
                            <img src="https://via.placeholder.com/250x300" alt="Ketua KONI Sukoharjo" class="img-fluid rounded shadow">
                        </div>
            
                        <!-- Content Section -->
                        <div class="col-md-8">
                            <p style="text-align: justify;">
                                <strong>KONI Sukoharjo</strong> adalah lembaga yang bertugas mengelola, mengembangkan, dan
                                meningkatkan prestasi olahraga di Kabupaten Sukoharjo. Sebagai wadah pembinaan olahraga, KONI
                                Sukoharjo memfasilitasi pelatihan atlet, pelatih, dan program-program yang mendukung olahraga
                                secara berkelanjutan. Melalui visi dan misinya, KONI Sukoharjo berkomitmen untuk mencetak atlet
                                yang berprestasi, baik di tingkat nasional maupun internasional, serta berkontribusi dalam
                                memperkuat persatuan bangsa melalui olahraga.
                            </p>
                            <h3 class="mt-4 text-primary">Visi</h3>
                            <p>
                                Mewujudkan prestasi olahraga yang membanggakan di tingkat dunia, membangun watak, mengangkat
                                harkat dan martabat bangsa, serta mempererat persatuan dan ketahanan nasional.
                            </p>
                            <h3 class="mt-4 text-primary">Misi</h3>
                            <ul class="custom-list">
                                <li><i class="mdi mdi-circle me-2" style="font-size: 8px;"></i>Mewujudkan Tata Kelola kelembagaan atau organisasi yang akuntabel dan profesional.</li>
                                <li><i class="mdi mdi-circle me-2" style="font-size: 8px;"></i>Mengembangkan dan meningkatkan organisasi cabang olahraga yang solid.</li>
                                <li><i class="mdi mdi-circle me-2" style="font-size: 8px;"></i>Mendukung atlet potensial dan berbakat dalam peningkatan prestasi olahraga yang lebih optimal.</li>
                                <li><i class="mdi mdi-circle me-2" style="font-size: 8px;"></i>Merancang dan melaksanakan program pembinaan olahraga yang berkesinambungan, efektif, dan efisien.</li>
                                <li><i class="mdi mdi-circle me-2" style="font-size: 8px;"></i>Membangun Kerjasama yang harmonis dengan berbagai pihak dalam keterlibatan untuk peningkatan prestasi olahraga.</li>
                            </ul>
                        </div>
                    </div>
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
