<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Referee extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'id',
        'name',
        'sport_category',
        'gender',
        'birth_date',
        'age',
        'license',
        'whatsapp',
        'instagram',
        'experience',
        'photo',
    ];

    protected $keyType = 'string';
    public $incrementing = false;

    protected $dates = [
        'birth_date',
    ];

    // Accessor to dynamically calculate age from birth_date
    public function getAgeAttribute()
    {
        return Carbon::parse($this->birth_date)->age;
    }

    public function sportCategory()
    {
        return $this->belongsTo(SportCategory::class, 'sport_category', 'id');
    }


    // Method to generate a custom ID with a prefix 'R'
    public function generateId()
    {
        $lastReferee = Referee::max('id');
        $lastNumber = $lastReferee ? intval(substr($lastReferee, 1)) : 0;
        $newNumber = str_pad($lastNumber + 1, 4, '0', STR_PAD_LEFT);
        return 'R' . $newNumber;
    }
}
