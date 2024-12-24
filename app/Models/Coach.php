<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coach extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'name', 'sport_category', 'address', 'age', 'whatsapp','instagram','description', 'photo'];
    protected $keyType = 'string';
    public $incrementing = false;
    
    public function generateId()
    {
        $lastCoach = $this->max('id');
        $lastNumber = $lastCoach ? intval(substr($lastCoach, 1)) : 0;
        $newNumber = str_pad($lastNumber + 1, 4, '0', STR_PAD_LEFT);
        return 'P' . $newNumber;
    }
    
}
