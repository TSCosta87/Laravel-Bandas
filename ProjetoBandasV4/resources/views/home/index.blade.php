@extends('layouts.fe')

@section('content')
    <div class="container my-5">
        <div class="p-5 text-center bg-body-tertiary rounded-3">
            <h1 class="text-body-emphasis">Welcome to TC-Bands</h1>
            <p class="lead">Your one-stop platform for managing and exploring bands, albums, and music.</p>
            <a href="{{ route('register') }}" class="btn btn-warning">Join Now</a>
        </div>
    </div>

    <div class="container col-8 mt-3">
        @if (session('message'))
            <div class="alert alert-success text-center">
                {{ session('message') }}
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger text-center">
                {{ session('error') }}
            </div>
        @endif
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
    </div>

    <div class="container mt-5 mb-5">
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
            @foreach($bands as $band)
                <div class="col">
                    <div class="card shadow-sm">
                        <img src="{{ $band->photo ? asset('storage/' . $band->photo) : asset('img/noPhotoBand.png') }}"
                             alt="" class="bd-placeholder-img card-img-top" width="100" height="225 px" role="img">
                        <div class="card-body">
                            <h4 class="card-text">{{ $band->name }}</h4>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="btn-group">
                                    <a href="{{ route('band.view', $band->id) }}"
                                       class="btn btn-sm btn-outline-secondary">View Albums</a>
                                </div>
                                <small class="text-muted">{{ $band->albums_count }} albums</small>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
