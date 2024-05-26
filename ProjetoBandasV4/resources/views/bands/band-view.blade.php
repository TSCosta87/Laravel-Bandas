@extends('layouts.fe')

@section('content')
    <div class="container my-5">
        <div class="p-5 text-center bg-body-tertiary rounded-3">
            <h1 class="text-body-emphasis">{{ $band->name }}</h1>
        </div>
    </div>

    <div class="container mt-5 mb-5">
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
            @foreach($albums as $album)
                <div class="col">
                    <div class="card shadow-sm">
                        <img src="{{ $album->photo ? asset('storage/' . $album->photo) : asset('img/noPhotoBand.png') }}" alt="" class="bd-placeholder-img card-img-top" width="100" height="225 px" role="img">
                        <div class="card-body">
                            <h4 class="card-text">{{ $album->name }}</h4>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="btn-group">
                                    <a href="{{ route('album.view', $album->id) }}" class="btn btn-sm btn-outline-secondary">View Musics</a>
                                </div>
                            </div>
                            <small class="text-muted">Release Date: {{ $album->release_date }}</small>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
