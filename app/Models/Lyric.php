<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lyric extends Model
{
    use HasFactory;

    protected $guarded = [];

    // 1 lyric milik 1 album
    public function album(){
        return $this->belongsTo(Album::class);
    }

    // 1 lyric milik 1 band
    public function band(){
        return $this->belongsTo(Band::class);
    }
}
