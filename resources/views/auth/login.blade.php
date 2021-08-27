@extends('layouts.auth')

@section('title', 'Masuk')

@section('content')
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="form-group">
            <label for="email">Alamat email</label>
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                value="{{ old('email') }}" required autocomplete="email" autofocus>
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group">
            <label for="password">Password
            </label>
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                name="password" required autocomplete="current-password">
            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            <div class="text-right">
                <a href="{{ route('password.request') }}" class="small">
                    Lupa password?
                </a>
            </div>
        </div>

        <div class="form-group">
            <div class="form-check position-relative mb-2">
                <input type="checkbox" class="form-check-input d-none" id="remember" name="remember"
                    {{ old('remember') ? 'checked' : '' }}>
                <label class="checkbox checkbox-xxs form-check-label ml-1" for="remember" data-icon="&#xe936">Ingat
                    saya</label>
            </div>
        </div>

        <div class="form-group no-margin">
            <button type="submit" class="btn btn-primary">
                Masuk
            </button>
        </div>
        <div class="text-center mt-3 small">
            Belum punya akun? <a href="{{ route('register') }}">Daftar</a>
        </div>
    </form>
@endsection
