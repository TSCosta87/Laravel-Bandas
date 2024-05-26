@extends('layouts.fe')

@section('content')
    @php
        use App\Models\User;
    @endphp

    <div class="container my-5 ">
        <div class="p-5 text-center bg-body-tertiary rounded-3">
            <h1 class="text-body-emphasis">All Bands</h1>
            <p class="lead">In this page you can manage all Bands</p>
        </div>
    </div>

    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-4"></div>
            <div class="col-4">
                <form action="">
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">Search</span>
                        <input name="search" value="{{ request()->query('search') }}" type="text" class="form-control"
                               placeholder="Band Name" aria-label="" aria-describedby="basic-addon1">
                    </div>
                </form>
            </div>
            <div class="col-4"></div>
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
        <div class="row">
            <div class="col-2"></div>
            <div class="col-8 shadow">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col"></th>
                        <th scope="col">Band Name</th>
                        <th scope="col">Albums</th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($bands as $band)
                        <tr>
                            <th scope="row">{{ $band->id }}</th>
                            <td><img height="30px" width="30px" class="rounded" src="{{ $band->photo ? asset('storage/' . $band->photo) : asset('img/noPhotoBand.png') }}"></td>
                            <td>{{ $band->name }}</td>
                            <td>{{ $band->num_albums }}</td>
                            <td>
                                <!--Band Edit/View-->
                                <a href="{{ route('band.detail', $band->id) }}" class="btn btn-outline-primary rounded-circle p-2 lh-1">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                            </td>
                            <td>
                                @if (Auth::user()->user_type == User::TYPE_ADMIN)
                                <!--Delete Band-->
                                <a data-bs-toggle="modal" data-bs-target="#exampleModalDelete-{{ $band->id }}" class="btn btn-outline-danger rounded-circle p-2 lh-1">
                                    <i class="fa-solid fa-trash"></i>
                                </a>
                                <div class="modal fade" id="exampleModalDelete-{{ $band->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <img width="100px" src="{{ asset('img/logo.png') }}" alt="">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Band</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Are you sure you want delete <span class="text-danger">{{ $band->name }}</span>? If you delete this band, all the albums related with this band also will be deleted.
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                <a href="{{ route('band.delete', $band->id) }}" type="button" class="btn btn-danger">Delete</a>
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
                        <th scope="col"></th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                        <!--New Band Button-->
                        <th scope="col">
                            <a class="btn btn-outline-success rounded" data-bs-toggle="modal" data-bs-target="#newBandModal">+<i class="fa-solid fa-guitar fa-xl"></i></a>
                            <!--New Band Modal-->
                            <div class="modal fade" id="newBandModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <img width="100px" src="{{ asset('img/logo.png') }}" alt="">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">New Band</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form action="{{ route('band.create') }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="modal-body">
                                                <!--Form Band Name-->
                                                <div class="form-floating mb-3">
                                                    <input type="text" name="band_name" class="form-control" id="floatingInput" placeholder="Xutos & Pontapés">
                                                    <label for="floatingInput">Band Name</label>
                                                </div>
                                                <!--Form Band Cover-->
                                                <div class="mb-3">
                                                    <label for="formFile" class="form-label">Band Cover</label>
                                                    <input class="form-control" accept="image/*" name="photo" type="file" id="formFile">
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                                                <button type="submit" class="btn btn-success">Create Band</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </th>
                        <th scope="col"></th>
                        <th></th>
                    </tr>
                    @endif
                    </tbody>
                </table>
            </div>
            <div class="col-2"></div>
        </div>
    </div>
@endsection
