@extends('layouts.fe')

@section('content')
    <div class="container mt-1">
        <div class="d-flex justify-content-between">
            <!-- Botão à esquerda -->
            <a class="btn btn-outline-warning" href="{{ route('all.bands') }}">
                <i class="fa-regular fa-circle-left fa-xl"></i>
            </a>
        </div>
    </div>

    <div class="container my-5">
        <div class="p-5 text-center bg-body-tertiary rounded-3">
            <h1 class="text-body-emphasis">{{ $albums->name }}</h1>
            <p class="lead">{{ $albums->band_name }}</p>
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

    <div class="container d-flex justify-content-center align-items-center mt-1">
        <div class="card shadow">
            <div class="upper ">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col"></th>
                        <th scope="col">Music Name</th>
                        <th scope="col" style="width: 200px;"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($musics as $music)
                        <tr>
                            <th scope="row">{{ $music->id }}</th>
                            <td>{{ $music->name }}</td>
                            <td class="text-center">
                                <button class="btn btn-outline-primary rounded-circle p-2 lh-1" data-bs-toggle="modal"
                                        data-bs-target="#editMusicModal-{{ $music->id }}">
                                    <i class="fa-solid fa-pen"></i>
                                </button>
                                @if (Auth::user()->user_type == App\Models\User::TYPE_ADMIN)
                                    <a href="{{ route('music.delete', $music->id) }}"
                                       class="btn btn-outline-danger rounded-circle p-2 lh-1">
                                        <i class="fa-solid fa-trash"></i>
                                    </a>
                                @endif
                            </td>
                        </tr>

                        <!-- Edit Music Modal -->
                        <div class="modal fade" id="editMusicModal-{{ $music->id }}" tabindex="-1"
                             aria-labelledby="editMusicModalLabel-{{ $music->id }}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editMusicModalLabel-{{ $music->id }}">Edit
                                            Music</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                    </div>
                                    <form action="{{ route('music.update', $music->id) }}" method="POST">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="form-floating mb-3">
                                                <input type="text" name="name" class="form-control"
                                                       id="music-name-{{ $music->id }}" value="{{ $music->name }}"
                                                       placeholder="Music Name">
                                                <label for="music-name-{{ $music->id }}">Music Name</label>
                                            </div>
                                            <input type="hidden" name="album_id" value="{{ $albums->id }}">
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                Cancel
                                            </button>
                                            <button type="submit" class="btn btn-success">Save</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    @if (Auth::user()->user_type == App\Models\User::TYPE_ADMIN)
                        <tr class="text-left">
                            <th></th>
                            <th colspan="3">
                                <button class="btn btn-outline-success rounded" data-bs-toggle="modal"
                                        data-bs-target="#newMusicModal">+<i class="fa-solid fa-music fa-lg"></i>
                                </button>
                            </th>

                        </tr>
                    @endif
                    </tbody>
                </table>

                @if (Auth::user()->user_type == App\Models\User::TYPE_ADMIN)
                    <!-- New Music Modal -->
                    <div class="modal fade" id="newMusicModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                         aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">{{ $albums->name }} | New
                                        Music</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                </div>
                                <form action="{{ route('music.create') }}" method="POST">
                                    @csrf
                                    <div class="modal-body">
                                        <!-- Music Name -->
                                        <div class="form-floating mb-3">
                                            <input type="text" name="name" class="form-control" id="floatingInput"
                                                   placeholder="Music Name">
                                            <label for="floatingInput">Music Name</label>
                                        </div>
                                        <input type="hidden" name="album_id" value="{{ $albums->id }}">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel
                                        </button>
                                        <button type="submit" class="btn btn-success">Add New Track</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
