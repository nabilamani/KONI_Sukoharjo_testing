<style>
    /* Navbar Styling */
    .navbar {
        position: fixed;
        top: 0;
        width: 100%;
        z-index: 1030;
        transition: transform 0.4s ease, background-color 0.4s ease;
        background: rgba(255, 255, 255, 0.1);
        /* Transparent background */
        backdrop-filter: blur(20px);
        /* Apply blur effect */
        border-bottom: 1px solid rgba(255, 255, 255, 0.2);
        /* Optional: Add a subtle border */
    }

    /* When scrolling */
    /* When scrolling */
    .navbar.scrolled {
        background-color: rgba(0, 0, 0, 0.7);
        /* Darker and more opaque background */
        backdrop-filter: blur(10px);
        /* Keep the blur effect */
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        /* Soft shadow */
    }


    /* Hide navbar */
    .navbar.hidden {
        transform: translateY(-100%);
    }

    /* Additional styling for navbar items */
    .navbar .navbar-brand {
        font-weight: bold;
        color: white;
        /* White color for brand */
    }

    .navbar .nav-link {
        color: white !important;
        /* Make nav links white */
    }

    .navbar .nav-link.active {
        color: #FF9800 !important;
        /* Warna teks link yang aktif */
        font-weight: bold;
        border-bottom: 3px solid #FF9800;
    }


    .navbar .nav-link:hover {
        color: #FF9800 !important;
        /* Change color on hover */
    }

    /* Style untuk dropdown menu */
    .navbar .dropdown-menu {
        background-color: rgba(0, 0, 0, 0.8);
        /* Latar belakang dropdown menjadi gelap */
        border: none;
        /* Hilangkan border pada dropdown */
        backdrop-filter: blur(5px);
    }

    /* Warna teks dropdown menjadi putih */
    .navbar .dropdown-menu .dropdown-item {
        color: white !important;
        transition: color 0.3s ease, background-color 0.3s ease;
    }

    /* Warna teks saat di-hover */
    .navbar .dropdown-menu .dropdown-item:hover {
        color: #212529 !important;
        /* Teks menjadi gelap saat di-hover */
        background-color: #fff;
        /* Background sedikit lebih terang */
    }


    /* Button Styling */
    .navbar .btn-warning {
        border-radius: 20px;
        background-color: #FF9800;
        /* Orange background */
        border: none;
    }

    /* Navbar Toggler Styling */
    .navbar-toggler {
        border: none;
        background-color: rgba(255, 255, 255, 0.3);
        /* Warna latar tombol awal */
        padding: 8px 10px;
        border-radius: 4px;
        transition: background-color 0.3s ease, color 0.3s ease;
    }

    /* Warna saat toggler diaktifkan */
    .navbar-toggler.collapsed {
        /* Warna oranye dengan transparansi */
        color: white;
    }
    /* Mobile Specific Styling */
    @media (max-width: 768px) {
        .navbar-brand{
            font-size: 12px;
        }
        .navbar .nav-item {
            margin-bottom: 10px;
        }

        .navbar .dropdown-menu {
            position: static;
            float: none;
            width: 100%;
        }

        .navbar .btn {
            width: 90%;
            margin-top: 10px;
        }
    }
</style>
<nav class="navbar navbar-expand-lg shadow-sm">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="#">
            <img src="{{ asset('gambar_aset/images/koni.png') }}" alt="KONI Sukoharjo" style="height: 50px; border-radius: 50px;" class="me-3">
            <span class="fw-bold">KONI KABUPATEN SUKOHARJO</span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="mdi mdi-menu" style="font-size: 24px; color: white;"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('/') ? 'active' : '' }}" href="{{ url('/') }}">Beranda</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('berita','berita/*') ? 'active' : '' }}"
                        href="{{ url('/berita') }}">Berita</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle {{ Request::is('profil/*') ? 'active' : '' }}" href="#"
                        id="profilDropdown" role="button" data-bs-toggle="dropdown">Profil</a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item {{ Request::is('profil/tentang') ? 'active' : '' }}"
                                href="{{ url('/profil/tentang') }}">Tentang</a></li>
                        <li><a class="dropdown-item {{ Request::is('profil/struktur') ? 'active' : '' }}"
                                href="{{ url('/profil/struktur') }}">Struktur Organisasi</a></li>
                        <li><a class="dropdown-item {{ Request::is('profil/program') ? 'active' : '' }}"
                                href="{{ url('/profil/program') }}">Program</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle {{ Request::is('olahraga/*') ? 'active' : '' }}" href="#"
                        id="olahragaDropdown" role="button" data-bs-toggle="dropdown">Olahraga</a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item {{ Request::is('olahraga/cabor') ? 'active' : '' }}"
                                href="{{ url('/olahraga/cabor') }}">Cabor</a></li>
                        <li><a class="dropdown-item {{ Request::is('olahraga/event') ? 'active' : '' }}"
                                href="{{ url('/olahraga/event') }}">Events</a></li>
                        <li><a class="dropdown-item {{ Request::is('olahraga/atlet') ? 'active' : '' }}"
                                href="{{ url('/olahraga/atlet') }}">Atlet</a></li>
                        <li><a class="dropdown-item {{ Request::is('olahraga/pelatih') ? 'active' : '' }}"
                                href="{{ url('/olahraga/pelatih') }}">Pelatih</a></li>
                        <li><a class="dropdown-item {{ Request::is('olahraga/wasit') ? 'active' : '' }}"
                                href="{{ url('/olahraga/wasit') }}">Wasit</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle {{ Request::is('galeri/*') ? 'active' : '' }}" href="#"
                        id="galeriDropdown" role="button" data-bs-toggle="dropdown">Galeri</a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item {{ Request::is('galeri/foto') ? 'active' : '' }}"
                                href="{{ url('/galeri/foto') }}">Dokumentasi</a></li>
                        {{-- <li><a class="dropdown-item {{ Request::is('galeri/video') ? 'active' : '' }}"
                                href="{{ url('/galeri/video') }}">Video</a></li> --}}
                        <li><a class="dropdown-item {{ Request::is('galeri/prestasi') ? 'active' : '' }}"
                                href="{{ url('/galeri/prestasi') }}">Prestasi</a></li>
                        <li><a class="dropdown-item {{ Request::is('galeri/calender') ? 'active' : '' }}"
                                href="{{ url('/galeri/calender') }}">Calender</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('messages/create') ? 'active' : '' }}"
                        href="/messages/create">Kontak</a>
                </li>
                <li class="nav-item">
                    <a class="btn btn-warning text-white ms-3 px-3" href="{{ route('login') }}"
                        style="border-radius: 20px;">Login</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- JavaScript Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Sticky Header dengan efek smooth scroll
    let lastScrollTop = 0;
    const navbar = document.querySelector('.navbar');

    window.addEventListener('scroll', () => {
        const scrollTop = window.pageYOffset || document.documentElement.scrollTop;

        // Menambahkan background saat scroll
        if (scrollTop > 50) {
            navbar.classList.add('scrolled');
        } else {
            navbar.classList.remove('scrolled');
        }

        // Sembunyikan navbar saat scroll down, tampilkan saat scroll up
        if (scrollTop > lastScrollTop && scrollTop > 100) {
            navbar.classList.add('hidden');
        } else {
            navbar.classList.remove('hidden');
        }
        lastScrollTop = scrollTop;
    });
</script>
