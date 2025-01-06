<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'sport_category',
        'description',
        'date',
        'location',
        'media_type',
        'media_path',
    ];

    /**
     * Optional: Add any relationships or custom methods for the Gallery model here.
     */

    // Example: Scope for filtering by sport category
    public function scopeBySportCategory($query, $sportCategory)
    {
        return $query->where('sport_category', $sportCategory);
    }

    public function sportCategory()
    {
        return $this->belongsTo(SportCategory::class, 'sport_category', 'id');
    }

    // Example: Check if media is a photo
    public function isPhoto()
    {
        return $this->media_type === 'photo';
    }

    // Example: Check if media is a video
    public function isVideo()
    {
        return $this->media_type === 'video';
    }
}
