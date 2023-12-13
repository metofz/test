<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Band;
use App\Models\Lyric;
use Illuminate\Support\Str;

class LyricController extends Controller
{
    public function create()
    {
        return view('lyrics.create', ['title' => 'New Lyric']);
    }
    
    public function store()
    {
        request()->validate([
            'album' => 'required',
            'band' => 'required',
            'title' => 'required',
            'body' => 'required',
        ]);

        $band = Band::find(request('band'));

        $band->lyrics()->create([
            'title' => request('title'),
            'slug' => Str::slug(request('title')),
            'body' => request('body'),
            'album_id' => request('album'),
        ]);
        return response()->json(['message' => 'The lyric was created into band ' . $band->name]);
    }

    public function table() 
    {
        return view('lyrics.table', [
            'title' => 'All Lyric',
            'lyrics' => Lyric::latest()->paginate(16),
        ]);
    }

    public function edit(Lyric $lyric)
    {
        return view('lyrics.edit', [
            'title' => "Edit Lyrics : {$lyric->title}",
            'lyric' => $lyric,
            'bands' => Band::get(),
            'albums' => Album::get(),
        ]);
    }

    public function update(Lyric $lyric)
    {
        $lyric->update([
            'title' => request('title'),
            'slug' => Str::slug(request('title')),
            'body' => request('body'),
            'album_id' => request('album'),
            'band_id' => request('band'),
        ]);

        return redirect()->route('lyrics.table')->with('success', 'The lyrics was updated');
    }
}
