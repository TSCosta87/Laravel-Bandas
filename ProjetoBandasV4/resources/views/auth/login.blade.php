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
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
    </div>

    <div class="container d-flex align-items-center justify-content-center" style="height: 100vh;">
        <div class="col-md-4 shadow rounded p-3">
            <main class="form-signin w-100 m-auto text-center">
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <img class="mb-4 mx-auto d-block" src="{{ asset('img/logo.png') }}" alt="" width="100%"
                         height="100%">
                    <h1 class="h3 mb-3 fw-normal">Please sign in</h1>

                    <div class="form-floating mb-3">
                        <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com"
                               required>
                        <label for="email">Email address</label>

                    </div>
                    <div class="form-floating mb-3">
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password"
                               required>
                        <label for="password">Password</label>
                        @error('email')
                        <div class="Invalid-feedback text-danger text-left" >
                            Invalid email or password!
                        </div>
                        @enderror
                    </div>

                    <button class="w-100 btn btn-lg btn-warning" type="submit">Sign in</button>
                    <div class="mt-3">
                        <a href="{{ route('password.request') }}" class="text-decoration-none">Forgot password?</a>
                    </div>
                    <p class="mt-3"><a href="{{ route('register') }}">Don't have an account? Sign up</a></p>
                    <p class="mt-5 mb-3 text-muted">&copy; 2024</p>
                </form>
            </main>
        </div>
    </div>
@endsection
