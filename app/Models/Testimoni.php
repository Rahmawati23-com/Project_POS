<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testimoni extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 
        'position', 
        'company', 
        'content', 
        'rating', 
        'avatar',
        'featured'
    ];

    // Scope untuk testimoni featured
    public function scopeFeatured($query)
    {
        return $query->where('featured', true);
    }

    // Scope untuk testimoni terbaru
    public function scopeLatest($query, $limit = 10)
    {
        return $query->orderBy('created_at', 'desc')->limit($limit);
    }
}