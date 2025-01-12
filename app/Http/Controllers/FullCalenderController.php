<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Schedule;
use Carbon\Carbon;
use Illuminate\Http\Request;

class FullCalenderController extends Controller
{
    public function index()
    {
        // Ambil semua data event
        $events = Event::all(['id', 'name', 'start_date', 'end_date', 'location']);

        // Ambil semua data jadwal latihan
        $schedules = Schedule::all(['id', 'name', 'date', 'time', 'sport_category', 'venue_name', 'notes']);

        // Format data untuk FullCalendar (event)
        $calendarEvents = $events->map(function ($event) {
            return [
                'id' => 'event-' . $event->id, // Berikan prefix untuk membedakan ID
                'title' => $event->name,
                'start' => $event->start_date ? Carbon::parse($event->start_date)->format('Y-m-d') : null,
                'end' => $event->end_date ? Carbon::parse($event->end_date)->format('Y-m-d') : null, // Menambahkan end date
                'description' => $event->location,
                'classNames' => 'event-item', // Tambahkan class khusus untuk event
            ];
        });

        // Format data untuk FullCalendar (schedule)
        $calendarSchedules = $schedules->map(function ($schedule) {
            return [
                'id' => 'schedule-' . $schedule->id, // Berikan prefix untuk membedakan ID
                'title' => $schedule->name . ' (' . $schedule->sport_category . ')',
                'start' => $schedule->date ? Carbon::parse($schedule->date)->format('Y-m-d') : null,
                'description' => 'Venue: ' . $schedule->venue_name . "\nNotes: " . $schedule->notes,
                'time' => $schedule->time,
                'sport_category' => $schedule->sportCategory->sport_category ?? 'Semua',
                'classNames' => 'schedule-item', // Tambahkan class khusus untuk jadwal latihan
            ];
        });

        // Gabungkan data event dan jadwal
        $calendarEvents = $calendarEvents->merge($calendarSchedules);

        // Ambil event mendatang (future events) yang tanggal_event > sekarang
        $upcomingEvents = Event::where('start_date', '>=', now()->startOfDay()) // Menyertakan hari ini
            ->orderBy('start_date', 'asc') // Urutkan berdasarkan tanggal event
            ->take(4) // Ambil 4 event mendatang
            ->get();

        // Kirim data ke view
        return view('viewpublik.Galeri.calender', ['calendarEvents' => $calendarEvents, 'events' => $events, 'upcomingEvents' => $upcomingEvents,]);
    }
}
