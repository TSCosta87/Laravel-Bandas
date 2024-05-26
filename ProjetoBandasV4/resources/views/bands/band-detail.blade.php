@extends('layouts.fe')

@section('content')
    @php
        use App\Models\User;
    @endphp

    <div class="container mt-1">
        <div class="d-flex justify-content-between">
            <!-- Botão à esquerda -->
            <a class="btn btn-outline-warning" href="{{ route('all.bands') }}">
                <i class="fa-regular fa-circle-left fa-xl"></i>
            </a>
        </div>
    </div>

    <div class="container my-5">
        <div class="p-5 text-center bg-body-tertiary rounded-3" style="max-width: 80%; margin: auto;">
            <h1 class="text-body-emphasis">{{ $band->name }}</h1>
        </div>
    </div>

    <div class="container d-flex justify-content-center align-items-center mt-1">
        <div class="card shadow" style="width: 80%;">
            <div class="upper text-center">
                <img height="80%" width="80%" class="img-fluid mt-5 mb-5 rounded shadow"
                     src="{{ $band->photo ? asset('storage/' . $band->photo) : asset('img/noPhotoBand.png') }}">
            </div>
            <div class="user text-center mb-1">
                <h3>{{ $band->name }}</h3>
            </div>
            <div class="container">
                <hr>
            </div>
            <form action="{{ route('band.create') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="container mt-1">
                    <div class="row justify-content-center">
                        <div class="col-md-10">
                            <div class="form-floating mb-3">
                                <input name="band_name" type="text" class="form-control" id="floatingInput"
                                       placeholder="Band Name" value="{{ $band->name }}">
                                <label for="floatingInput">Band Name</label>
                            </div>
                            <div class="mb-3">
                                <label for="formFile" class="form-label">Band Cover:</label>
                                <input name="photo" accept="image/*" class="form-control" type="file" id="formFile">
                            </div>
                            <div class="mb-3 text-center">
                                <button type="submit" class="btn btn-success">Update</button>
                            </div>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="id" value="{{ $band->id }}">
            </form>
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

    <!-- Band Albums list -->
    <div class="container d-flex justify-content-center align-items-center mt-5" id="albumSection">
        <div class="card shadow" style="width: 80%;">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col"></th>
                        <th scope="col">Album Name</th>
                        <th scope="col">Release Date</th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($albums as $album)
                        <tr>
                            <th scope="row">{{ $album->id }}</th>
                            <td><img height="30px" width="30px" class="rounded"
                                     src="{{ $album->photo ? asset('storage/' . $album->photo) : asset('img/noPhotoBand.png') }}">
                            </td>
                            <td>{{ $album->name }}</td>
                            <td>{{ $album->release_date }}</td>
                            <td>
                                <a href="{{ route('album.detail', $album->id) }}"
                                   class="btn btn-outline-primary rounded-circle p-2 lh-1">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                            </td>
                            <td>
                                @if (Auth::user()->user_type == User::TYPE_ADMIN)
                                    <a data-bs-toggle="modal" data-bs-target="#albumModalDelete-{{ $album->id }}"
                                       class="btn btn-outline-danger rounded-circle p-2 lh-1">
                                        <i class="fa-solid fa-trash"></i>
                                    </a>
                                    <div class="modal fade" id="albumModalDelete-{{ $album->id }}" tabindex="-1"
                                         aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <img width="100px" src="{{ asset('img/logo.png') }}" alt="">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Delete
                                                        Album</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Are you sure you want delete <span
                                                        class="text-danger">{{ $album->name }}</span>? If you delete
                                                    this Album, all the musics related with this Album also will be
                                                    deleted.
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Cancel
                                                    </button>
                                                    <a href="{{ route('album.delete', $album->id) }}" type="button"
                                                       class="btn btn-danger">Delete</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    @if (Auth::user()->user_type == User::TYPE_ADMIN)
                        <tr>
                            <td colspan="6" class="text-center">
                                <a type="button" class="btn btn-outline-success" title="Add new Album"
                                   data-bs-toggle="modal" data-bs-target="#newAlbumModal">
                                    <i class="fa-solid fa-plus fa"></i> <i class="fa-solid fa-record-vinyl fa-lg"></i>
                                </a>
                            </td>
                        </tr>
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal Novo Album -->
    @if (Auth::user()->user_type == User::TYPE_ADMIN)
        <div class="modal fade" id="newAlbumModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <img width="100px" src="{{ asset('img/logo.png') }}" alt="">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">{{ $band->name }} | New Album</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('album.create') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <!-- Nome do Album-->
                            <div class="form-floating mb-3">
                                <input type="text" name="name" class="form-control" id="floatingInput"
                                       placeholder="Espiritual">
                                <label for="floatingInput">Album Name</label>
                            </div>
                            <!-- Data de Lancamento -->
                            <div class="form-floating mb-3">
                                <input type="date" name="release_date" class="form-control" id="floatingInput"
                                       placeholder="">
                                <label for="floatingInput">Release Date</label>
                            </div>
                            <!-- Photo -->
                            <div>
                                <label for="formFile" class="form-label">Album Cover</label>
                                <input class="form-control" accept="image/*" name="photo" type="file" id="formFile">
                            </div>
                            <!-- Band-->
                            <div class="mt-5">
                                <label for="formFile" class="form-label">Band</label>
                                <select class="form-select" aria-label="Disabled select example" disabled>
                                    <option selected>{{ $band->name }}</option>
                                </select>
                            </div>
                            <input type="hidden" name="band_id" value="{{ $band->id }}">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-success">Create Album</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif

@endsection
