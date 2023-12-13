<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    use HasFactory;

    protected $guarded = [];

    // 1 genre milik banyak band
    // pivot table band_genre
    public function bands(){
        return $this->belongsToMany(Band::class);
    }
}
