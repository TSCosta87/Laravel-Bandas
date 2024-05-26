@extends('layouts.fe')

@section('content')

    @if (Auth::user()->user_type == App\Models\User::TYPE_ADMIN)

        <div class="container my-5">
            <div class="p-5 text-center bg-body-tertiary rounded-3">
                <h1 class="text-body-emphasis">Add Music</h1>
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
        </div>

        <div class="container mt-5 mb-5">
            <form action="{{ route('music.add-music') }}" method="GET">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="form-floating">
                            <select class="form-select" id="band-select" name="band_id" onchange="this.form.submit()">
                                <option value="">Select a band</option>
                                @foreach($bands as $band)
                                    <option
                                        value="{{ $band->id }}" {{ $selectedBand == $band->id ? 'selected' : '' }}>{{ $band->name }}</option>
                                @endforeach
                            </select>
                            <label for="band-select">Select Band</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating">
                            <select class="form-select" id="album-select" name="album_id"
                                    {{ empty($albums) ? 'disabled' : '' }} onchange="this.form.submit()">
                                <option value="">Select an album</option>
                                @foreach($albums as $album)
                                    <option
                                        value="{{ $album->id }}" {{ $selectedAlbum == $album->id ? 'selected' : '' }}>{{ $album->name }}</option>
                                @endforeach
                            </select>
                            <label for="album-select">Select Album</label>
                        </div>
                    </div>
                </div>
            </form>

            @if($selectedAlbum)
                <form action="{{ route('music.store') }}" method="POST">
                    @csrf
                    <div class="form-floating mb-3">
                        <input type="text" name="name" class="form-control" id="music-name" placeholder="Music Name">
                        <label for="music-name">Music Name</label>
                    </div>
                    <input type="hidden" name="album_id" value="{{ $selectedAlbum }}">
                    <button type="submit" class="btn btn-warning"><i class="fa-solid fa-music"></i> Add Track <i
                            class="fa-solid fa-music"></i></button>
                </form>

                <div class="mt-5">
                    <h3>Musics in the Album</h3>
                    <ul class="list-group">
                        @foreach($musics as $music)
                            <li class="list-group-item">{{ $music->name }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
    @else
        <div class="container-fluid row rounded shadow mt-5 mb- 5">

            <div class="col-2"></div>
            <div class="col-8">
            <h1 class="text-danger">Ups, you cannot be in here!!!</h1>
            </div>
        </div>
    @endif
@endsection



