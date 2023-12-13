<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Band extends Model
{
    use HasFactory;

    protected $guarded = [];

    // 1 band memiliki banyak album
    // band menitipkan id ke table album sebagai foreign key
    public function albums(){
        return $this->hasMany(Album::class);
    }

    // 1 band memiliki banyak lyric
    // band menitipkan id ke table lyric sebagai foreign key
    public function lyrics(){
        return $this->hasMany(Lyric::class);
    }

    // 1 band milik banyak genre
    // pivot table band_genre
    public function genres(){
        return $this->belongsToMany(Genre::class);
    }
}
