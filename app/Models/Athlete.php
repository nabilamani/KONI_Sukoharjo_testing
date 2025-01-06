<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Athlete extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
        'sport_category',
        'birth_date',
        'gender',
        'weight',
        'height',
        'achievements',
        'photo'
    ];

    protected $keyType = 'string';
    public $incrementing = false;

    protected $dates = [
        'birth_date',
    ];

    public function getAgeAttribute()
    {
        return Carbon::parse($this->birth_date)->age;
    }

    public function sportCategory()
    {
        return $this->belongsTo(SportCategory::class, 'sport_category', 'id');
    }

    public function generateId()
    {
        $lastAthlete = Athlete::max('id');
        $lastNumber = $lastAthlete ? intval(substr($lastAthlete, 1)) : 0;
        $newNumber = str_pad($lastNumber + 1, 4, '0', STR_PAD_LEFT);
        return 'A' . $newNumber;
    }
}
