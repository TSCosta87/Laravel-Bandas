@extends('layouts.fe')

@section('content')

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

    <div class="container d-flex align-items-center justify-content-center" style="height: 100vh;">
        <div class="col-md-4 shadow rounded p-3">
            <main class="form-signin w-100 m-auto text-center">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('password.update') }}">
                    @csrf


                    <img class="mb-4 mx-auto d-block" src="{{ asset('img/logo.png') }}" alt="" width="100%" height="100%">
                    <h1 class="h3 mb-3 fw-normal">Reset Password</h1>

                    <div class="form-floating mb-3">
                        <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com" value="{{ $email ?? old('email') }}" required autofocus>
                        <label for="email">Email address</label>
                        @error('email')
                        <div class="Invalid-feedback text-danger" >
                           Please insert an email
                        </div>
                        @enderror
                    </div>

                    <div class="form-floating mb-3">
                        <input type="password" class="form-control" id="password" name="password" placeholder="New Password" required>
                        <label for="password">New Password</label>
                        @error('password')
                        <div class="Invalid-feedback text-danger" >
                            Confirm your password
                        </div>
                        @enderror
                    </div>

                    <div class="form-floating mb-3">
                        <input type="password" class="form-control" id="password-confirm" name="password_confirmation" placeholder="Confirm Password" required>
                        <label for="password-confirm">Confirm Password</label>
                        @error('password')
                        <div class="Invalid-feedback text-danger" >
                            Confirm your password
                        </div>
                        @enderror
                    </div>

                    <button class="w-100 btn btn-lg btn-warning" type="submit">Reset Password</button>
                    <input type="hidden" name="token" value="{{request()->route('token')}}">
                    <p class="mt-5 mb-3 text-muted">&copy; 2024</p>
                </form>
            </main>
        </div>
    </div>
@endsection
