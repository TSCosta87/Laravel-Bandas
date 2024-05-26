@extends('layouts.fe')

@section('content')

    <div class="container my-5">
        <div class="p-5 text-center bg-body-tertiary rounded-3">
            <h1 class="text-body-emphasis">Add Album</h1>
        </div>
    </div>

    @if (Auth::user()->user_type == App\Models\User::TYPE_ADMIN)

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
        <form action="{{ route('album.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row mb-3">
                <div class="col-md-6">
                    <div class="form-floating">
                        <select class="form-select" id="band-select" name="band_id">
                            <option value="">Select a band</option>
                            @foreach($bands as $band)
                                <option value="{{ $band->id }}">{{ $band->name }}</option>
                            @endforeach
                        </select>
                        <label for="band-select">Select Band</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-floating mb-3">
                        <input type="date" name="release_date" class="form-control" id="release-date" placeholder="Release Date">
                        <label for="release-date">Release Date</label>
                    </div>
                </div>
            </div>

            <div class="form-floating mb-3">
                <input type="text" name="name" class="form-control" id="album-name" placeholder="Album Name">
                <label for="album-name">Album Name</label>
            </div>

            <div class="form-floating mb-3">
                <input type="file" name="photo" class="form-control" id="album-photo">
                <label for="album-photo">Album Photo</label>
            </div>

            <button type="submit" class="btn btn-warning"><i class="fa-solid fa-compact-disc"></i> Add New Album <i class="fa-solid fa-compact-disc"></i></button>
        </form>
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
