@extends('layouts.backend')

@section('content')
    <div class="card">
        <div class="card-header">{{ $title }}</div>
        <div class="card-body">
            <form action="{{ route('lyrics.edit', $lyric) }}" method="POST">
                @csrf
                @method("put")
                <div class="form-group mb-2">
                    <label for="band">Band</label>
                    <select name="band" id="band" class="form-control">
                        <option disabled selected>Choose Band</option>
                        @foreach ($bands as $band)
                            <option {{ $band->id == $lyric->band_id ? "selected" : "" }} value="{{$band->id}}">{{$band->name}}</option>
                        @endforeach
                    </select>
                    @error('band')
                        <div class="text-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group mb-2">
                    <label for="album">Album</label>
                    <select name="album" id="album" class="form-control">
                        <option disabled selected>Choose Album</option>
                        @foreach ($albums as $album)
                            <option {{ $album->id == $lyric->album_id ? "selected" : "" }} value="{{$album->id}}">{{$album->name}}</option>
                        @endforeach
                    </select>
                    @error('band')
                        <div class="text-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-group mb-3">
                    <label for="title">Title</label>
                    <input type="text" name="title" value="{{ old('title') ?? $lyric->title }}" id="title" class="form-control"/>
                    @error('title')
                        <div class="mt-2 text-danger">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-group mb-3">
                    <label for="body">Lyric</label>
                    <textarea type="text" name="body" value="{{ old('body') ?? $lyric->body }}" id="body" rows="10" class="form-control">{{ $lyric->body }}</textarea>
                    @error('body')
                        <div class="mt-2 text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
@endsection