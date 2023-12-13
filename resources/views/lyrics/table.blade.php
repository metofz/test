@extends('layouts.backend')

@section('content')
    <div class="card">
        <div class="card-header">{{ $title }}</div>
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>Lyric</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($lyrics as $lyric)
                        <tr>
                            <td>{{ $lyrics->count() * ($lyrics->currentPage() - 1) + $loop->iteration }}</td>
                            <td>{{ $lyric->title }}</td>
                            <td>{{ $lyric->body }}</td>
                            <td>
                                <a href="{{ route('lyrics.edit', $lyric) }}" class="btn btn-warning btn-sm">Edit</a>
                                <div endpoint="{{ route('lyrics.delete', $lyric) }}" class="delete d-inline"></div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $lyrics->links() }}
        </div>
    </div>
@endsection