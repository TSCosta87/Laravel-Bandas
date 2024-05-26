@extends('layouts.fe')

@section('content')
    <div class="container my-5">
        <div class="p-5 text-center bg-body-tertiary rounded-3">
            <h1 class="text-body-emphasis">{{ $album->name }}</h1>
            <p class="text-muted">Release Date: {{ $album->release_date }}</p>
        </div>
    </div>

    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-4"></div>
            <div class="col-4  shadow rounded">
                <h2>Musics in this Album</h2>
                <table class="table">
                    <tbody>

                        @foreach($musics as $music)
                        <tr>
                            <th scope="row">{{ $music->name }}</th>
                            <td><p><i class="fa-solid fa-play text-success"></i>  <i class="fa-solid fa-pause text-primary"></i>  <i class="fa-solid fa-stop text-danger"></i></p></td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
            <div class="col-4"></div>
        </div>
    </div>
@endsection
