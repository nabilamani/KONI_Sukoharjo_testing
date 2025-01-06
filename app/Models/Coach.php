<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coach extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'sport_category', 'address', 'age', 'whatsapp','instagram','description', 'photo'];

    // Relasi ke kategori olahraga
    public function sportCategory()
    {
        return $this->belongsTo(SportCategory::class, 'sport_category', 'id');
    }
    
}
