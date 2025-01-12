<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Dokumentasi - KONI Sukoharjo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('gambar_aset/images/koni.png') }}">
    <link rel="stylesheet" href="{{ asset('gambar_aset/vendor/owl-carousel/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('gambar_aset/vendor/owl-carousel/css/owl.theme.default.min.css') }}">
    <link href="{{ asset('gambar_aset/vendor/jqvmap/css/jqvmap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('gambar_aset/css/style.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('gambar_aset/assets/vendor/fonts/boxicons.css') }}" />
    <script src="{{ asset('assets/fullcalendar/dist/index.global.js') }}"></script>
    <style>
        body {
            overflow-x: hidden;
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

        /* Modal Header Customization */
        .modal-header {
            font-size: 1rem;
            font-weight: 600;
            padding: 1rem 1.5rem;
        }

        /* Modal Body Styling */
        .modal-body {
            line-height: 1.5;
            /* Mengatur jarak antar baris */
            font-size: 0.95rem;
            padding: 1.5rem;
        }

        #modalContent p {
            margin-bottom: 0.5rem;
            /* Kurangi margin antar paragraf */
        }

        #modalContent h5 {
            font-size: 1.2rem;
            font-weight: bold;
            margin-bottom: 1rem;
            color: #333;
        }

        /* Modal Footer Styling */
        .modal-footer {
            padding: 1rem 1.5rem;
            gap: 0.5rem;
        }

        .btn-outline-secondary {
            border-color: #6c757d;
            color: #6c757d;
            transition: all 0.2s ease-in-out;
        }

        .btn-outline-secondary:hover {
            background-color: #6c757d;
            color: #fff;
        }

        /* Icon Styling */
        .modal-title i {
            font-size: 1.2rem;
        }

        /* Button Hover Effects */
        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }


        #calendar-wrap {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        #calendar {
            max-width: 1100px;
            width: 100%;
            margin: 20px 0;
            padding: 10px;
            background: #fff;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        /* Warna untuk event umum */
        .event-item {
            background-color: #007bff;
            /* Biru */
            color: white;
        }

        /* Warna untuk jadwal latihan */
        .schedule-item {
            background-color: #28a745;
            /* Hijau */
            color: white;
        }

        @media (max-width: 768px) {
            .hero-title {
                font-size: 16px;
            }

            .hero-subtitle {
                font-size: 12px;
            }

            #calendar {
                padding: 5px;
            }

            .fc-toolbar-title {
                font-size: 1.2rem;
            }

            .fc-button {
                font-size: 0.8rem;
                padding: 5px;
            }
        }
    </style>
</head>

<body>
    @include('viewpublik/layouts/navbar')
    <section class="hero-section">
        <div class="hero-overlay d-flex flex-column justify-content-center align-items-center text-center px-5 py-5">
            <!-- Lottie Player -->
            <script src="https://unpkg.com/@dotlottie/player-component@2.7.12/dist/dotlottie-player.mjs" type="module"></script>
            <dotlottie-player src="https://lottie.host/e6c1829e-6930-4c02-a1db-da23d437555d/hphKx9koWl.lottie"
                background="transparent" speed="1" style="width: 300px; height: 300px" loop
                autoplay></dotlottie-player>

            <!-- Hero Title -->
            <h1 class="hero-title text-white fst-italic mb-3">
                #KALENDER_KONI_SKH
            </h1>

            <!-- Subtitle -->
            <p class="hero-subtitle text-white mb-4">
                KONI Sukoharjo, wujudkan Peluang Emas untuk Para Atlet Muda Sukoharjo.
            </p>

            <!-- Button -->
            <a href="#cabor-section" class="btn btn btn-warning px-4 py-2">
                Selengkapnya
            </a>
        </div>
    </section>
    <div>
        <div class="container">
            <div class="row mt-5">
                <!-- Konten Utama (Kalender) -->
                <div class="col-md-8">
                    <nav class="breadcrumb bg-transparent p-0 mb-2">
                        <a class="breadcrumb-item text-decoration-none" href="/galeri/foto">Galeri</a>
                        <span class="breadcrumb-item active text-primary" style="color: #FF6924;">Calender</span>
                    </nav>
                    <div id="calendar-wrap">
                        <div id="calendar" style="height: 600px;"></div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="col-md-4">
                    <div class="card mb-4">
                        <div class="card-body">
                            <h5 class="card-title">Event Mendatang</h5>
                            <hr>
                            <div class="mb-4">
                                <form>
                                    <div class="input-group shadow-sm">
                                        <input type="text" class="form-control" id="search"
                                            placeholder="Cari event...">
                                        <button type="submit" class="btn btn-primary text-white">Cari</button>
                                    </div>
                                </form>
                            </div>

                            @forelse ($upcomingEvents as $event)
                                <div class="d-flex align-items-start p-1" data-id="{{ $event->id }}"
                                    data-name="{{ $event->name }}"
                                    data-start_date="{{ \Carbon\Carbon::parse($event->start_date)->format('d F Y') }}"
                                    data-banner="{{ asset($event->banner) }}"
                                    data-location_map="{{ $event->location_map }}"
                                    data-sport_category="{{ $event->sport_category }}">
                                    <!-- Banner -->
                                    <img src="{{ asset($event->banner ?? 'https://via.placeholder.com/80x80') }}"
                                        class="me-3 rounded" alt="Banner Event"
                                        style="width: 80px; height: 80px; object-fit: cover; cursor: pointer;">
                                    <!-- Event Details -->
                                    <div>
                                        <h6 class="mb-1 text-dark text-decoration-none">{{ $event->name }}</h6>
                                        <small class="text-muted">
                                            <i
                                                class="mdi mdi-calendar me-2"></i>{{ \Carbon\Carbon::parse($event->start_date)->format('d F Y') }}
                                        </small><br>
                                        <small class="text-muted">
                                            <i
                                                class="mdi mdi-soccer me-2"></i>{{ $event->sportCategory->sport_category ?? 'Semua' }}
                                        </small>
                                    </div>
                                </div>
                                <hr class="my-1">
                            @empty
                                <div class="text-center py-5">
                                    <i class="mdi mdi-calendar-remove text-warning display-4 mb-3"></i>
                                    <h6 class="text-muted">Belum ada event yang tersedia.</h6>
                                </div>
                            @endforelse

                            <a href="/olahraga/event" class="btn btn-primary w-100">Lihat Semua Event</a>
                        </div>
                    </div>

                    <!-- Modal -->
                    <div class="modal fade" id="imageModal" data-bs-backdrop="false" tabindex="-1"
                        aria-labelledby="imageModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-body text-center">
                                    <img id="modalImage" src="" alt="Full Banner" class="img-fluid rounded">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="eventScheduleModal" tabindex="-1" aria-labelledby="eventScheduleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg">
                <div class="modal-header bg-primary text-white border-0">
                    <h5 class="modal-title d-flex align-items-center" id="eventScheduleModalLabel">
                        <i class="mdi mdi-calendar me-2"></i> Detail Event/Jadwal
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body py-4">
                    <div id="modalContent" class="text-dark">
                        <!-- Konten detail akan dimuat di sini -->
                    </div>
                </div>
                <div class="modal-footer bg-light border-0 d-flex justify-content-between">
                    <button type="button" class="btn btn-outline-secondary btn-sm px-4" data-bs-dismiss="modal">
                        Tutup
                    </button>
                    <a href="#" class="btn btn-primary btn-sm px-4" id="eventActionLink">
                        Selengkapnya
                    </a>
                </div>
            </div>
        </div>
    </div>



    @include('viewpublik/layouts/footer')

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendarEvents = @json($calendarEvents);

            var calendar = new FullCalendar.Calendar(calendarEl, {
                locale: 'id',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
                },
                events: calendarEvents,
                editable: false,
                droppable: false,
                eventClick: function(info) {
                    var event = info.event;

                    // Format konten modal
                    var modalContent = '';
                    if (event.id.startsWith('event-')) {
                        modalContent = `
            <h5 class="text-primary">Detail Event</h5>
            <p><strong>Nama :</strong> ${event.title}</p>
            <p><strong>Tanggal Mulai :</strong> ${event.startStr}</p>
            <p><strong>Tanggal Selesai :</strong> ${event.endStr || 'N/A'}</p>
            <p><strong>Lokasi :</strong> ${event.extendedProps.description}</p>
        `;
                    } else if (event.id.startsWith('schedule-')) {
                        modalContent = `
            <h5 class="text-success">Detail Jadwal</h5>
            <p><strong>Nama :</strong> ${event.title}</p>
            <p><strong>Tanggal :</strong> ${event.startStr}</p>
            <p><strong>Jam :</strong> ${event.extendedProps.time}</p>
            <p><strong>Kategori Olahraga :</strong> ${event.extendedProps.sport_category}</p>
            <p><strong>Lokasi :</strong> ${event.extendedProps.description.split('\n')[0].replace('Venue: ', '')}</p>
            <p><strong>Catatan :</strong> ${event.extendedProps.description.split('\n')[1].replace('Notes: ', '')}</p>
        `;
                    }

                    // Isi konten modal
                    document.getElementById('modalContent').innerHTML = modalContent;

                    // Tampilkan modal
                    var modal = new bootstrap.Modal(document.getElementById('eventScheduleModal'));
                    modal.show();
                },

                windowResize: function() {
                    if (window.innerWidth <= 768) {
                        calendar.changeView('listWeek');
                    } else {
                        calendar.changeView('dayGridMonth');
                    }
                }
            });

            calendar.render();
        });
    </script>




</body>

</html>
