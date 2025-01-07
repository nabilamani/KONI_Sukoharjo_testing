<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
        'event_date',
        'sport_category',
        'location',
        'banner',
        'location_map',
    ];

    protected $keyType = 'string';
    public $incrementing = false;

    protected $dates = [
        'event_date', 
    ];

    public function sportCategory()
    {
        return $this->belongsTo(SportCategory::class, 'sport_category', 'id');
    }

    public function generateId()
    {
        // Retrieve the maximum ID currently in the database, remove the prefix, and increment it
        $lastEvent = $this->max('id');
        $lastNumber = $lastEvent ? intval(substr($lastEvent, 1)) : 0;
        $newNumber = str_pad($lastNumber + 1, 4, '0', STR_PAD_LEFT);
        
        // Return the new ID with a prefix 'E'
        return 'E' . $newNumber;
    }
}
