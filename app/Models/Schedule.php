<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',           // Nama kebutuhan latihan
        'date',           // Tanggal latihan
        'time',           // Waktu latihan
        'sport_category', // Kategori olahraga (cabor)
        'venue_name',     // Nama tempat latihan
        'venue_map',      // Iframe peta lokasi
        'notes',          // Catatan tambahan
    ];

    // Optional: Define relationships or custom methods as needed for the Schedule model
    public function sportCategory()
    {
        return $this->belongsTo(SportCategory::class, 'sport_category', 'id');
    }
}
