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

    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h2>Dashboard</h2>
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title">User Details</h5>
                        <p class="card-text"><strong>Name:</strong> {{ Auth::user()->name }}</p>
                        <p class="card-text"><strong>Email:</strong> {{ Auth::user()->email }}</p>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Change Password</h5>
                        @if(session('status'))
                            <div class="alert alert-success">{{ session('status') }}</div>
                        @endif
                        <form method="POST" action="{{ route('password.update') }}">
                            @csrf
                            <div class="form-floating mb-3">
                                <input type="password" class="form-control" id="current_password" name="current_password" placeholder="Current Password" required>
                                <label for="current_password">Current Password</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="password" class="form-control" id="new_password" name="new_password" placeholder="New Password" required>
                                <label for="new_password">New Password</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="password" class="form-control" id="new_password_confirmation" name="new_password_confirmation" placeholder="Confirm New Password" required>
                                <label for="new_password_confirmation">Confirm New Password</label>
                            </div>
                            <button type="submit" class="btn btn-warning">Update Password</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
