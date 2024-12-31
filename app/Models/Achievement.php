<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Achievement extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'sport_category',
        'event_type',
        'athlete_name',
        'description',
        'region_level',
        'rank',
        'certificate_date'
    ];

    protected $keyType = 'string';
    public $incrementing = false;

    /**
     * Generate a custom ID for achievements.
     *
     * @return string
     */
    public function generateId()
{
    do {
        // Generate a unique ID, e.g., ACH followed by a unique number
        $id = 'ACH' . str_pad(rand(1, 9999), 4, '0', STR_PAD_LEFT);
    } while (Achievement::where('id', $id)->exists());

    return $id;
}

}
