<?php

use App\Http\Controllers\AchievementController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AthleteController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\UserController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\CaborController;
use App\Http\Controllers\CoachController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GaleriController;
use App\Http\Controllers\KoniStructureController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\RefereeController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\SportCategoryController;
use App\Http\Controllers\VenueController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//authentication

// Route login custom
Route::get('/konilogin', [AuthenticatedSessionController::class, 'create'])
    ->name('login');
Route::post('/konilogin', [AuthenticatedSessionController::class, 'store']);
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->name('logout');

//Viewpublik
Route::get('/', [Controller::class, 'home'])->name('home');

Route::get('/berita', [BeritaController::class, 'publik'])->name('berita.publik');
Route::get('/berita/daftar', [BeritaController::class, 'daftarberita'])->name('berita.daftar');
Route::get('/berita/{id}', [BeritaController::class, 'detail'])->name('berita.detail');

Route::get('/profil', [BeritaController::class, 'publik'])->name('profil.publik');

Route::get('/profil/tentang', function () {
    return view('viewpublik.profil.tentang');
});

Route::get('/olahraga/cabor', [CaborController::class, 'home'])->name('home');
Route::get('/olahraga/event', [EventController::class, 'showEvents'])->name('showEvents');
Route::get('/galeri/calender', [EventController::class, 'showCalender'])->name('showCalender');
Route::get('/olahraga/atlet', [AthleteController::class, 'showAthletes'])->name('showAthletes');
Route::get('/olahraga/pelatih', [CoachController::class, 'showCoaches'])->name('showCoaches');
Route::get('/olahraga/wasit', [RefereeController::class, 'showReferees'])->name('showReferees');
Route::get('/profil/struktur', [KoniStructureController::class, 'showstruktur'])->name('showstruktur');
Route::get('/olahraga/cabor/{id}', [CaborController::class, 'show'])->name('cabor.show');

Route::get('/galeri/foto', [GaleriController::class, 'showPhoto'])->name('showPhoto');
Route::get('/galeri/prestasi', [AchievementController::class, 'showPrestasi'])->name('showPrestasi');

Route::get('/kontak', function () {
    return view('viewpublik.kontak');
});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


//viewpublik



Route::get('Admin', function () {
    return view('dashboard');
})->middleware(['auth', 'verified', 'role:Admin']);

Route::get('pengurus', function () {
    return '<h1>Hello Pengurus Cabor</h1>';
})->middleware(['auth', 'verified', 'role:pengurus|Admin']);

Route::get('badminton', function () {
    return view('badminton');
})->middleware(['auth', 'verified', 'role_or_permission:lihat-data|Admin']);



Route::get('/Admin', function () {
    return view('dashboard');
});

Route::get('/tambah', function () {
    return view('layouts.tambah');
});

// Route::get('/profil/struktur', function () {
//     return view('viewpublik.profil.strukturalkoni');
// });

Route::get('/api/cari-pelatih', [CoachController::class, 'cariPelatih'])->name('cari-pelatih');
Route::get('/api/cari-atlet', [AthleteController::class, 'cariAtlet'])->name('cari-atlet');

//middleware auth

Route::middleware(['auth'])->group(function () {

    // Rute dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Rute pelatih
    Route::resource('coaches', CoachController::class);
    Route::put('/edit-pelatih/{id}', [CoachController::class, 'update']);
    Route::delete('/delete-pelatih/{id}', [CoachController::class, 'destroy']);
    Route::get('/cetak-pelatih', [CoachController::class, 'cetakPelatih'])->name('cetak-pelatih');
    

    // Rute atlet
    Route::resource('athletes', AthleteController::class);
    Route::put('/edit-athlete/{id}', [AthleteController::class, 'update']);
    Route::delete('/delete-athlete/{id}', [AthleteController::class, 'destroy']);
    Route::get('/cetak-athlete', [AthleteController::class, 'cetakAthlete'])->name('cetak-athlete');

    // Rute wasit
    Route::resource('referees', RefereeController::class);
    Route::put('/edit-referee/{id}', [RefereeController::class, 'update']);
    Route::delete('/delete-referee/{id}', [RefereeController::class, 'destroy']);
    Route::get('/cetak-referee', [RefereeController::class, 'cetakBerita'])->name('cetak-berita');

    // Rute event
    Route::resource('events', EventController::class);
    Route::put('/edit-event/{id}', [EventController::class, 'update']);
    Route::delete('/delete-event/{id}', [EventController::class, 'destroy']);
    Route::get('/cetak-event', [EventController::class, 'cetakEvent'])->name('cetak-event');

    // Rute venue
    Route::resource('venues', VenueController::class);
    Route::put('/edit-venue/{id}', [VenueController::class, 'update']);
    Route::delete('/delete-venue/{id}', [VenueController::class, 'destroy']);
    Route::get('/cetak-venue', [VenueController::class, 'cetakVenue'])->name('cetak-venue');

    // Rute Jadwal
    Route::resource('schedules', ScheduleController::class);
    Route::put('/edit-schedule/{id}', [ScheduleController::class, 'update']);
    Route::delete('/delete-schedules/{id}', [ScheduleController::class, 'destroy']);

    // Rute prestasi
    Route::resource('achievements', AchievementController::class);
    Route::put('/edit-achievment/{id}', [AchievementController::class, 'update']);
    Route::delete('/delete-achievment/{id}', [AchievementController::class, 'destroy']);
    Route::get('/cetak-achievement', [AchievementController::class, 'cetakPrestasi'])->name('cetak-prestasi');
    

    // Rute berita
    Route::resource('beritas', BeritaController::class);
    Route::put('/edit-berita/{id}', [BeritaController::class, 'update']);
    Route::delete('/delete-berita/{id}', [BeritaController::class, 'destroy']);
    Route::get('/cetak-berita', [BeritaController::class, 'cetakBerita'])->name('cetak-berita');

    // Rute galeri
    Route::resource('galleries', GaleriController::class);
    Route::put('/edit-gallery/{id}', [GaleriController::class, 'update']);
    Route::delete('/delete-gallery/{id}', [GaleriController::class, 'destroy']);
    Route::get('/cetak-gallery', [GaleriController::class, 'cetakGaleri'])->name('cetak-geleri');

    Route::resource('konistructures', KoniStructureController::class);
    Route::put('/edit-konistructure/{id}', [KoniStructureController::class, 'update']);
    Route::delete('/delete-konistructure/{id}', [KoniStructureController::class, 'destroy']);
    Route::get('/cetak-konistructure', [KoniStructureController::class, 'cetakStructure'])->name('cetak-konistructure');

    Route::resource('sportcategories', SportCategoryController::class);
    Route::put('/edit-sportcategory/{id}', [SportCategoryController::class, 'update']);
    Route::delete('/delete-sportcategory/{id}', [SportCategoryController::class, 'destroy']);

    Route::resource('users', UserController::class);
    Route::put('/edit-user/{id}', [UserController::class, 'update']);
    Route::delete('/delete-user/{id}', [UserController::class, 'destroy']);

    
    Route::put('/edit-message/{id}', [MessageController::class, 'update']);
    Route::delete('/delete-message/{id}', [MessageController::class, 'destroy']);
    Route::patch('/messages/{message}/update-status', [MessageController::class, 'updateStatus'])->name('messages.updateStatus');




    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Rute lainnya sesuai kebutuhan...
});

Route::resource('messages', MessageController::class);




require __DIR__ . '/auth.php';
