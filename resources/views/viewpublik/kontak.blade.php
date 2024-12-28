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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"
        integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
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

        .contact-section {
            background: white;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .contact-title {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .contact-info {
            margin-bottom: 30px;
        }

        .form-section {
            background-color: #f7f7f7;
            border-radius: 10px;
            padding: 20px;
        }

        .form-label {
            font-weight: bold;
        }

        .form-control {
            border-radius: 5px;
        }

        .btn-custom {
            background-color: #4CAF50;
            /* Warna hijau custom */
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 14px;
            border-radius: 5px;
            cursor: pointer;
        }

        .btn-custom:hover {
            background-color: #45a049;
            color: #fff;
            /* Warna hijau lebih gelap untuk hover */
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
                <dotlottie-player src="https://lottie.host/775e8687-9638-4575-bbb8-98c94cc476b7/stGPivomeJ.lottie"
                    background="transparent" speed="1" style="width: 250px; height: 250px" loop
                    autoplay></dotlottie-player>
            </div>

            <!-- Hero Title -->
            <h1 class="hero-title text-white fst-italic mb-3" data-aos="zoom-in" data-aos-delay="200">
                #CONTACT_KONI_SKH
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

    <!-- Event List Section -->
    <div class="container my-5">
        <div class="row justify-content-center align-items-start">
            <!-- Contact Section -->
            <div class="col-lg-6 mb-4">
                <div class="contact-section">
                    <h2 class="contact-title text-primary">
                        <i class="mdi mdi-map-marker"></i> Hubungi KONI Kabupaten Sukoharjo
                    </h2>
                    <p class="text-dark">
                        Terima kasih telah mengunjungi website resmi KONI Kabupaten Sukoharjo. Kami siap membantu dan
                        menjawab segala pertanyaan Anda terkait program olahraga, pendaftaran atlet, dan peluang
                        kerjasama.
                    </p>

                    <div class="contact-info mb-0">
                        <p class="text-dark">
                            <strong><i class="mdi mdi-office-building text-primary"></i> Alamat Kantor :</strong><br>
                            Gedung KONI Kabupaten Sukoharjo<br>
                            Jl. Veteran, Kutorejo, Jetis, Kec. Sukoharjo, Kabupaten Sukoharjo, Jawa Tengah 57511
                        </p>

                        <p class="text-dark">
                            <strong><i class="mdi mdi-clock-outline text-primary"></i> Jam Operasional :</strong><br>
                            Senin – Jumat: 08.00 – 16.00 WIB<br>
                            Sabtu – Minggu: Libur
                        </p>

                        <p class="text-dark">
                            <strong><i class="mdi mdi-phone text-primary"></i> Nomor Telepon :</strong><br>
                            <a class="text-primary" href="tel:081227960337">081227960337</a>
                        </p>

                        <p class="text-dark">
                            <strong><i class="mdi mdi-email text-primary"></i> Email Resmi :</strong><br>
                            <a class="text-primary"
                                href="mailto:konisukoharjo@yahoo.com">konisukoharjo@yahoo.com</a><br>
                            <a class="text-primary" href="mailto:konisukoharjo@gmail.com">konisukoharjo@gmail.com</a>
                        </p>
                    </div>
                </div>
            </div>

            <!-- Map Section -->
            <div class="col-lg-6">
                <div class="card shadow-lg rounded-3">
                    <div class="bg-primary py-2 text-white d-flex justify-content-center align-items-center rounded-top-3">
                        <h4 class="m-2">
                            <i class="mdi mdi-map-marker"></i> Lokasi KONI Sukoharjo
                        </h4>
                    </div>                    
                    <div class="card-body">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d7908.018331383531!2d110.84037000000001!3d-7.682162!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7a3c415b43c431%3A0xa7e9cde5bba00946!2sKONI%20Kabupaten%20Sukoharjo!5e0!3m2!1sid!2sid!4v1731592172597!5m2!1sid!2sid"
                            width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                    </div>
                </div>
            </div>



            <!-- Form Section -->
            {{-- <div class="col-lg-6">
                <div class="form-section">
                    <h4 class="text-primary">
                        <i class="mdi mdi-message-text"></i> Kirim Pesan atau Saran
                    </h4>
                    <form id="messageForm" action="{{ route('messages.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">
                                <i class="mdi mdi-account-circle text-primary"></i> Nama Lengkap
                            </label>
                            <input type="text" id="name" name="name" class="form-control"
                                placeholder="Masukkan nama Anda" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">
                                <i class="mdi mdi-email text-primary"></i> Email
                            </label>
                            <input type="email" id="email" name="email" class="form-control"
                                placeholder="Masukkan email Anda" required>
                        </div>
                        <div class="mb-3">
                            <label for="message" class="form-label">
                                <i class="mdi mdi-message-text-outline text-primary"></i> Pesan atau Saran
                            </label>
                            <textarea id="message" name="message" class="form-control" rows="5"
                                placeholder="Tulis pesan atau saran Anda" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">
                            <i class="mdi mdi-send"></i> Kirim Pesan
                        </button>
                    </form>
                </div>
            </div> --}}

        </div>
    </div>



    @include('viewpublik/layouts/footer')
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#messageForm').on('submit', function(e) {
                e.preventDefault(); // Mencegah reload halaman

                let formData = $(this).serialize(); // Ambil data form

                $.ajax({
                    url: $(this).attr('action'),
                    type: $(this).attr('method'),
                    data: formData,
                    success: function(response) {
                        if (response.success) {
                            swal({
                                title: "Berhasil!",
                                text: response.message,
                                icon: "success",
                                buttons: {
                                    confirm: {
                                        text: "OK",
                                        className: "btn btn-custom"
                                    }
                                }
                            });
                            $('#messageForm')[0].reset(); // Reset form
                        }
                    },
                    error: function(xhr) {
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
        });
    </script>




</body>

</html>
