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
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <img class="mb-4 mx-auto d-block" src="{{ asset('img/logo.png') }}" alt="" width="100%"
                         height="100%">
                    <h1 class="h3 mb-3 fw-normal">Please sign up</h1>

                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="name" name="name" placeholder="John Doe" required>
                        <label for="name">Name</label>
                        @error('name')
                        <div class="Invalid-feedback text-danger">
                            Invalid name!
                        </div>
                        @enderror
                    </div>
                    <div class="form-floating mb-3">
                        <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com"
                               required>
                        <label for="email">Email address</label>
                        @error('email')
                        <div class="Invalid-feedback text-danger">
                            Invalid email!
                        </div>
                        @enderror
                    </div>
                    <div class="form-floating mb-3">
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password"
                               required>
                        <label for="password">Password</label>

                    </div>
                    <div class="form-floating mb-3">
                        <input type="password" class="form-control" id="password_confirmation"
                               name="password_confirmation" placeholder="Confirm Password" required>
                        <label for="password_confirmation">Confirm Password</label>
                        @error('password')
                        <div class="Invalid-feedback text-danger">
                            Password don't match!
                        </div>
                        @enderror
                    </div>
                    <div class="form-floating mb-3">
                        <select class="form-select" id="type" name="type" required>
                            <option value="{{ \App\Models\User::TYPE_USER }}">User</option>
                            <option value="{{ \App\Models\User::TYPE_ADMIN }}">Admin</option>
                        </select>
                        <label for="type">Role</label>
                    </div>
                    <button class="w-100 btn btn-lg btn-warning" type="submit">Sign up</button>
                    <p class="mt-5 mb-3 text-muted">&copy; 2024</p>
                </form>
            </main>
        </div>
    </div>
@endsection
