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
    <link href="https://cdn.jsdelivr.net/npm/@mdi/font@7.2.96/css/materialdesignicons.min.css" rel="stylesheet">
    <link href="{{ asset('gambar_aset/vendor/datatables/css/jquery.dataTables.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('gambar_aset/assets/vendor/fonts/boxicons.css') }}" />
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <style>
        body {
            overflow-x: hidden;
        }

        /* Hero Section with Parallax Effect */
        .hero-section {
            height: 100vh;
            background: url('https://image.kemenpora.go.id/images/content/2021/08/02/787/2261Air-Mata-Sejarah-Greysia-Apriyani-Terukir-di-Olimpiade-Tokyo-2020.jpg') no-repeat center center;
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

        /* For responsiveness */
        @media (max-width: 768px) {
            .hero-overlay {
                padding: 30px;
                /* Adjust padding for smaller screens */
            }
        }


        .hero-title {
            font-weight: bold;
            font-size: 4rem;
        }

        .hero-subtitle {
            font-size: 1.5rem;
            margin-bottom: 20px;
        }

        /* Cards Styling */
        .card {
            transition: transform 0.3s ease;
            cursor: pointer;
        }

        .card:hover {
            transform: translateY(-10px);
        }

        /* Cards Styling */
        .card-hover {
            transition: transform 0.3s ease, background-color 0.3s ease, color 0.3s ease;
            cursor: pointer;
        }

        .card-hover:hover {
            transform: translateY(-10px);
            background-color: #f39c12;
            /* Ganti warna sesuai kebutuhan */
        }

        .card-hover:hover h5,
        .card-hover:hover i {
            color: #ffffff;
            /* Ganti warna teks sesuai kebutuhan */
        }


        .mdi {
            color: #f39c12;
        }



        #contact {
            background-color: #f9f9f9;
        }

        #contact h2 {
            font-size: 2.5rem;
            color: #1f2d3d;
        }

        .contact-info p {
            font-size: 1rem;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
        }

        .contact-info p i {
            font-size: 1.5rem;
            color: #ff7f50;
            margin-right: 10px;
        }

        .contact-info a {
            background-color: #ff7f50;
            border: none;
            padding: 10px 20px;
            font-size: 1rem;
            cursor: pointer;
            transition: background-color 0.3s;
            border-radius: 5px;
        }

        .contact-info a:hover {
            background-color: #ff5722;
        }

        .map-frame {
            border: 8px solid #ff7f50;
            /* Warna kuning */
            border-radius: 12px;
            /* Sudut melengkung */
            overflow: hidden;
            /* Menjaga elemen iframe tetap dalam bingkai */
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            /* Efek bayangan */
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            /* Animasi */
        }

        .map-frame:hover {
            transform: scale(1.02);
            /* Efek zoom saat hover */
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.3);
            /* Bayangan lebih tebal saat hover */
        }
    </style>
</head>

<body>

    @include('viewpublik/layouts/navbar')

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="hero-overlay mt-5" data-aos="zoom-in" data-aos-delay="0">
            <h1 class="hero-title text-white fst-italic" data-aos="zoom-in" data-aos-delay="200">#SUKOHARJOMAKMUR</h1>
            <p class="hero-subtitle" data-aos="zoom-in" data-aos-delay="400">KONI Sukoharjo, wujudkan olahraga yang
                berprestasi dan menjunjung tinggi
                sportivitas.</p>
            <a href="#about-section" class="btn btn-warning rounded-5" data-aos="zoom-in"
                data-aos-delay="600">Selengkapnya</a>
        </div>
    </section>

    <!-- New Section for Accumulated Data (outside hero-overlay) -->
    <div class="hero-stats py-4 bg-dark">
        <div class="container text-center">
            <h2 class="text-white mb-2" data-aos="fade-up">Statistik Olahraga Sukoharjo</h2>
            <p data-aos="fade-up" data-aos-delay="100">Data terkini mengenai atlet, wasit, pelatih, event, dan prestasi
                olahraga di Sukoharjo.</p>
            <div class="row justify-content-center mt-4">
                <div class="col-md-2 text-center border-end akumulasi" data-aos="zoom-in" data-aos-delay="200">
                    <h3 class="count mt-1 text-primary" data-count="{{ $athleteCount }}">0</h3>
                    <p>Atlet</p>
                </div>
                <div class="col-md-2 text-center border-end" data-aos="zoom-in" data-aos-delay="300">
                    <h3 class="count mt-1 text-primary" data-count="{{ $refereeteCount }}">0</h3>
                    <p>Wasit</p>
                </div>
                <div class="col-md-2 text-center border-end" data-aos="zoom-in" data-aos-delay="400">
                    <h3 class="count mt-1 text-primary" data-count="{{ $coachCount }}">0</h3>
                    <p>Pelatih</p>
                </div>
                <div class="col-md-2 text-center border-end" data-aos="zoom-in" data-aos-delay="500">
                    <h3 class="count mt-1 text-primary" data-count="{{ $eventCount }}">0</h3>
                    <p>Event</p>
                </div>
                <div class="col-md-2 text-center" data-aos="zoom-in" data-aos-delay="600">
                    <h3 class="count mt-1 text-primary" data-count="{{ $achievementCount }}">0</h3>
                    <p>Prestasi</p>
                </div>
            </div>
        </div>
    </div>




    <section class="py-5 bg-light" id="about-section"
        style="position: relative; background-image: url('https://images.vexels.com/media/users/3/297088/raw/3ff1701de8a5291ad893656da9bfaf18-running-sports-pattern-design.jpg'); background-size: cover; background-position: center; background-attachment: fixed;">
        <!-- Dark overlay effect -->
        <div
            style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.5); z-index: 1;">
        </div>

        <div class="container text-center" style="position: relative; z-index: 2;">
            <h2 class="fw-bold mb-4 text-white" data-aos="fade-up">KONI Sukoharjo</h2>
            <p class="text-white mb-5 px-5 mx-5" data-aos="fade-up" data-aos-delay="100">KONI (Komite Olahraga Nasional
                Indonesia) Sukoharjo adalah organisasi
                yang
                bertanggung jawab untuk mengkoordinasikan kegiatan olahraga dan pembinaan atlet di Kabupaten Sukoharjo.
            </p>

            <div class="row gy-4">
                <!-- Card 1: Cabor -->
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="card border-0 shadow-sm text-center p-4 h-100 card-hover"
                        onclick="window.location.href='/olahraga/cabor'">
                        <i class="mdi mdi-basketball display-4 mb-3"></i>
                        <h5 class="fw-bold">Cabor</h5>
                    </div>
                </div>

                <!-- Card 2: Atlet -->
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="card border-0 shadow-sm text-center p-4 h-100 card-hover"
                        onclick="window.location.href='/olahraga/atlet';">
                        <i class="mdi mdi-account-outline display-4 mb-3"></i>
                        <h5 class="fw-bold">Atlet</h5>
                    </div>
                </div>

                <!-- Card 3: Pelatih -->
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
                    <div class="card border-0 shadow-sm text-center p-4 h-100 card-hover"
                        onclick="window.location.href='/olahraga/pelatih';">
                        <i class="mdi mdi-account-multiple-outline display-4 mb-3"></i>
                        <h5 class="fw-bold">Pelatih</h5>
                    </div>
                </div>

                <!-- Card 4: Berita Terkini -->
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="400">
                    <div class="card border-0 shadow-sm text-center p-4 h-100 card-hover"
                        onclick="window.location.href='/berita';">
                        <i class="mdi mdi-newspaper display-4 mb-3"></i>
                        <h5 class="fw-bold">Berita Terkini</h5>
                    </div>
                </div>

                <!-- Card 5: Prestasi Atlet -->
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="500">
                    <div class="card border-0 shadow-sm text-center p-4 h-100 card-hover"
                        onclick="window.location.href='/galeri/prestasi';">
                        <i class="mdi mdi-trophy-outline display-4 mb-3"></i>
                        <h5 class="fw-bold">Prestasi Atlet</h5>
                    </div>
                </div>

                <!-- Card 6: Wasit -->
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="600">
                    <div class="card border-0 shadow-sm text-center p-4 h-100 card-hover"
                        onclick="window.location.href='/olahraga/wasit';">
                        <i class="mdi mdi-whistle display-4 mb-3"></i>
                        <h5 class="fw-bold">Wasit</h5>
                    </div>
                </div>
            </div>

        </div>
    </section>


    <section class="py-5 bg-dark">
        <div class="container text-center">
            <!-- Judul Section -->
            <h2 class="fw-bold mb-4 text-white" data-aos="fade-up">Berita Terbaru</h2>
            <!-- Subjudul -->
            <p class="text-white mb-5 mx-5" data-aos="fade-up" data-aos-delay="100">
                Temukan berita terkini dan informasi menarik seputar program, kegiatan, dan pencapaian olahraga di
                Sukoharjo.
                Kami menghadirkan informasi yang akurat, terpercaya, dan relevan untuk mendukung kemajuan dunia olahraga
                di
                wilayah ini.
            </p>
            <!-- Berita Cards -->
            <div class="row gy-4">
                @foreach ($beritas as $berita)
                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                        <div class="card border-0 shadow-sm position-relative hover-card h-100">
                            <img src="{{ asset($berita->photo) }}" class="card-img-top img-fluid"
                                alt="{{ $berita->judul_berita }}"
                                style="object-fit: cover; height: 200px; border-radius: 8px;">

                            <div class="card-body d-flex flex-column">
                                <!-- Judul Berita -->
                                <h5 class="card-title fw-bold mb-3">{{ $berita->judul_berita }}</h5>

                                <!-- Waktu dan Lokasi -->
                                <div class="d-flex align-items-center mb-n2">
                                    <small class="text-muted">
                                        {{ \Carbon\Carbon::parse($berita->tanggal_waktu)->format('d F Y') }}
                                    </small>
                                    <span class="mx-2 text-muted">|</span>
                                    <small class="text-muted">{{ $berita->lokasi_peristiwa }}</small>
                                </div>

                                <!-- Isi Berita Singkat -->
                                <p class="card-text mb-3">{!! Str::limit($berita->isi_berita, 500) !!}</p>

                                <!-- Tombol Baca Selengkapnya -->
                                <button type="button" class="btn btn-primary text-white btn-sm mt-auto"
                                    data-bs-toggle="modal" data-bs-target="#newsDetailModal{{ $berita->id }}">
                                    Baca Selengkapnya
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <!-- Tombol Baca Berita Lain -->
            <div class="text-center mt-5" data-aos="zoom-in">
                <a href="/berita" class="btn btn-outline-light btn-lg px-5 py-2 fw-bold bg-light">
                    Baca Berita Lain...
                </a>
            </div>
        </div>

        <!-- Modal Detail Berita -->
        @foreach ($beritas as $berita)
            <div class="modal fade" id="newsDetailModal{{ $berita->id }}" tabindex="-1"
                aria-labelledby="newsDetailModalLabel{{ $berita->id }}" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content border-0 shadow-lg">
                        <!-- Modal Header -->
                        <div class="modal-header bg-dark">
                            <h5 class="modal-title fw-bold text-white" id="newsDetailModalLabel{{ $berita->id }}">
                                {{ $berita->judul_berita }}
                            </h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>

                        <!-- Modal Body -->
                        <div class="modal-body">
                            <!-- Gambar Berita -->
                            <img src="{{ asset($berita->photo) }}" class="img-fluid rounded mb-4"
                                alt="{{ $berita->judul_berita }}"
                                style="max-height: 400px; object-fit: cover; width: 100%;">

                            <!-- Lokasi dan Sumber -->
                            <div class="d-flex justify-content-between mb-3">
                                <small class="text-muted" style="font-size: 0.8rem;">
                                    <strong>Lokasi :</strong> {{ $berita->lokasi_peristiwa }}
                                </small>
                                <small class="text-muted" style="font-size: 0.8rem;">
                                    <strong>Sumber :</strong> {{ $berita->kutipan_sumber }}
                                </small>
                            </div>


                            <!-- Konten Berita -->
                            <p class="mb-4" style="line-height: 1.6;">
                                {!! $berita->isi_berita !!}
                            </p>


                            <!-- Tanggal dan Waktu -->
                            <hr>
                            <p class="text-end text-muted">
                                <small>{{ \Carbon\Carbon::parse($berita->tanggal_waktu)->format('d F Y, H:i') }}</small>
                            </p>
                        </div>

                        <!-- Modal Footer -->
                        <div class="modal-footer justify-content-end">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach


    </section>

    <!-- FAQ Section -->
    <section id="faq" class="py-5 bg-white">
        <div class="container">
            <!-- Judul -->
            <h2 class="text-center mb-3 fw-bold text-primary" data-aos="fade-up">PERTANYAAN UMUM</h2>
            <p class="text-center mb-5 mx-5 text-secondary" data-aos="fade-up" data-aos-delay="100">
                Temukan jawaban atas berbagai pertanyaan yang sering diajukan terkait program, kegiatan, dan layanan
                KONI Sukoharjo. Kami telah menyusun informasi ini untuk membantu Anda memahami peran dan kontribusi kami
                dalam mendukung dunia olahraga di Sukoharjo.
            </p>

            <!-- Accordion -->
            <div class="accordion" id="faqAccordion">
                <!-- FAQ 1 -->
                <div class="accordion-item border-0 mb-3 shadow-sm" data-aos="fade-up" data-aos-delay="200">
                    <h2 class="accordion-header" id="headingOne">
                        <button class="accordion-button d-flex align-items-center" type="button"
                            data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true"
                            aria-controls="collapseOne">
                            <i class="mdi mdi-help-circle-outline text-primary me-2"></i>
                            Apa itu KONI?
                        </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                        data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            Komite Olahraga Nasional Indonesia (KONI) adalah organisasi yang memiliki wewenang dan
                            tanggung
                            jawab dalam mengelola, membina, mengembangkan, dan mengkoordinasikan seluruh kegiatan
                            olahraga
                            prestasi di Indonesia. KONI bertujuan untuk meningkatkan prestasi atlet nasional di berbagai
                            cabang olahraga.
                        </div>
                    </div>
                </div>

                <!-- FAQ 2 -->
                <div class="accordion-item border-0 mb-3 shadow-sm" data-aos="fade-up" data-aos-delay="300">
                    <h2 class="accordion-header" id="headingTwo">
                        <button class="accordion-button collapsed d-flex align-items-center" type="button"
                            data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false"
                            aria-controls="collapseTwo">
                            <i class="mdi mdi-account-multiple-plus text-primary me-2"></i>
                            Bagaimana cara bergabung dengan program pembinaan atlet KONI?
                        </button>
                    </h2>
                    <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                        data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            Untuk bergabung dengan program pembinaan atlet KONI, calon atlet atau orang tua/wali dapat
                            mengunjungi halaman "Program" di situs kami dan mengisi formulir pendaftaran yang tersedia.
                            Tim KONI akan meninjau aplikasi dan menghubungi calon atlet untuk langkah selanjutnya.
                        </div>
                    </div>
                </div>

                <!-- FAQ 3 -->
                <div class="accordion-item border-0 mb-3 shadow-sm" data-aos="fade-up" data-aos-delay="400">
                    <h2 class="accordion-header" id="headingThree">
                        <button class="accordion-button collapsed d-flex align-items-center" type="button"
                            data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false"
                            aria-controls="collapseThree">
                            <i class="mdi mdi-trophy-outline text-primary me-2"></i>
                            Apa saja cabang olahraga yang berada di bawah naungan KONI?
                        </button>
                    </h2>
                    <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree"
                        data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            KONI menaungi berbagai cabang olahraga seperti atletik, renang, bulu tangkis, dan banyak
                            lagi.
                            Untuk informasi lengkap mengenai cabang olahraga, kunjungi situs resmi KONI.
                        </div>
                    </div>
                </div>

                <!-- FAQ 4 -->
                <div class="accordion-item border-0 shadow-sm" data-aos="fade-up" data-aos-delay="500">
                    <h2 class="accordion-header" id="headingFour">
                        <button class="accordion-button collapsed d-flex align-items-center" type="button"
                            data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false"
                            aria-controls="collapseFour">
                            <i class="mdi mdi-calendar-clock text-primary me-2"></i>
                            Bagaimana cara mendapatkan informasi mengenai kompetisi yang diselenggarakan oleh KONI?
                        </button>
                    </h2>
                    <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour"
                        data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            Informasi mengenai kompetisi dapat ditemukan di situs resmi KONI pada bagian “Kompetisi”
                            atau melalui pengumuman yang diberikan oleh KONI secara berkala.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="contact" class="py-5">
        <div class="container">
            <!-- Judul -->
            <h2 class="text-center fw-bold mb-2" data-aos="fade-up">Contact</h2>
            <p class="text-center mb-5 text-black" data-aos="fade-up" data-aos-delay="100">
                KONI Sukoharjo siap menjalin komunikasi yang baik dengan masyarakat, atlet, pelatih, dan semua pihak
                yang mendukung pengembangan olahraga di Sukoharjo. Jika Anda memiliki pertanyaan, masukan, atau
                informasi
                yang ingin disampaikan, silakan hubungi kami melalui saluran yang tersedia di bawah ini. Kami akan
                berusaha
                memberikan respon terbaik untuk kebutuhan Anda.
            </p>

            <div class="row align-items-center">
                <!-- Embed Google Map -->
                <div class="col-lg-6 mb-4 mb-lg-0" data-aos="fade-right" data-aos-duration="1200">
                    <div class="map-frame">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d7908.018331383531!2d110.84037000000001!3d-7.682162!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7a3c415b43c431%3A0xa7e9cde5bba00946!2sKONI%20Kabupaten%20Sukoharjo!5e0!3m2!1sid!2sid!4v1731592172597!5m2!1sid!2sid"
                            width="100%" height="300" style="border:0;" allowfullscreen=""
                            loading="lazy"></iframe>
                    </div>
                </div>


                <!-- Contact Information -->
                <div class="col-lg-6" data-aos="fade-left" data-aos-duration="1200">
                    <div class="contact-info">
                        <p data-aos="zoom-in" data-aos-delay="200">
                            <i class="mdi mdi-map-marker me-2"></i>
                            Jl. Veteran, Kutorejo, Jetis, Kec. Sukoharjo, Kabupaten Sukoharjo, Jawa Tengah 57511
                        </p>
                        <p data-aos="zoom-in" data-aos-delay="300">
                            <i class="mdi mdi-phone me-2"></i>
                            (021)593023
                        </p>
                        <p data-aos="zoom-in" data-aos-delay="400">
                            <i class="mdi mdi-email me-2"></i>
                            konisukoharjo@yahoo.com
                        </p>
                        <a href="/messages/create" class="btn text-white mt-3" data-aos="flip-up"
                            data-aos-delay="500">Kirim Pesan</a>

                    </div>
                </div>
            </div>
        </div>
    </section>


    @include('viewpublik/layouts/footer')

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const counters = document.querySelectorAll('.count');
            const animationDuration = 5000; // Duration in milliseconds (2 seconds)

            counters.forEach(counter => {
                const target = +counter.getAttribute('data-count');
                const frameRate = 20; // Update the count every 20ms
                const totalFrames = animationDuration / frameRate;
                const increment = target / totalFrames;

                let currentCount = 0;

                const updateCount = () => {
                    currentCount += increment;

                    if (currentCount < target) {
                        counter.innerText = Math.ceil(currentCount);
                        setTimeout(updateCount, frameRate);
                    } else {
                        counter.innerText = target; // Set the final count
                    }
                };

                updateCount();
            });
        });
    </script>
    <script>
        document.querySelector('.scroll-to-section').addEventListener('click', function(e) {
            e.preventDefault(); // Mencegah aksi default anchor
            const target = document.querySelector('#about-section');
            target.scrollIntoView({
                behavior: 'smooth', // Efek smooth scroll
                block: 'start' // Mulai scroll ke bagian atas target
            });
        });
    </script>
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>



</body>

</html>
