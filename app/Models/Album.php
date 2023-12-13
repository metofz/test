<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    use HasFactory;

    protected $guarded = [];

    // 1 album dimiliki 1 band
    public function band(){
        return $this->belongsTo(Band::class);
    }

    // 1 album memiliki banyak banyak lirik
    public function lyrics(){
        return $this->hasMany(Lyric::class);
    }
}
