@extends('layouts.backend')

@section('content')
    <div class="card">
        <div class="card-header">{{ $title }}</div>
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Band</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($genres as $genre)
                    <tr>
                        <td>{{ $genres->count() * ($genres->currentPage() - 1) + $loop->iteration }}</td>
                        <td>{{ $genre->name }}</td>
                        <td>{{ $genre->bands->count() }}</td>
                        <td>
                            <a href="{{ route('genres.edit', $genre) }}" class="btn btn-warning btn-sm">Edit</a>
                            <div endpoint="{{ route('genres.delete', $genre) }}" class="delete d-inline"></div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $genres->links() }}
        </div>
    </div>
@endsection