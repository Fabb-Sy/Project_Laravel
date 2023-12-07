@extends('layouts.app')

@section('title', 'Login - Web Perpustakaan')

@section('icon', 'img/book_1.png')

@section('header')
    <style>
        body {
            background: radial-gradient(circle at top right, transparent 10%, #dcdaff 10%, #dcdaff 20%, transparent 21%), radial-gradient(circle at left bottom, transparent 10%, #dcdaff 10%, #dcdaff 20%, transparent 21%), radial-gradient(circle at top left, transparent 10%, #dcdaff 10%, #dcdaff 20%, transparent 21%), radial-gradient(circle at right bottom, transparent 10%, #dcdaff 10%, #dcdaff 20%, transparent 21%), radial-gradient(circle at center, #dcdaff 30%, transparent 31%);
            background-size: 4em 4em;
            background-color: #ffffff;
            opacity: 1
        }
    </style>
@endsection

@section('main')
    <section class="login-container">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Berhasil!</strong> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @elseif ($errors->has('message'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Gagal!</strong> {{ $errors->first('message') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="card shadow-lg">
            <div class="card-header">
                <img src="{{ asset('img/logo.svg') }}" alt="img-logo" class="img-logo" loading="lazy" />
            </div>
            <div class="card-body">
                <form action="{{ route('user.login') }}" method="POST">
                    @csrf
                    <div class="form-group my-3">
                        <label for="username" class="form-label">Username</label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="bi bi-person-fill"></i>
                            </span>
                            <input type="text" name="username" id="username" class="form-control"
                                placeholder="Masukkan username Anda" required />
                        </div>
                    </div>
                    @error('username')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                    <div class="form-group my-3">
                        <label for="password" class="form-label">Password</label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="bi bi-key-fill"></i>
                            </span>
                            <input type="password" name="password" id="password" class="form-control"
                                placeholder="Masukkan password Anda" required />
                        </div>
                    </div>
                    @error('password')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                    <div class="form-group my-3 d-grid">
                        <button class="btn btn-primary" type="submit">Login</button>
                    </div>
                </form>
            </div>
            <div class="card-footer">
                <a href="{{ route('register') }}" class="link-underline link-underline-opacity-0">
                    <p class="text-center" style="color: #8423ff;">
                        Tidak punya akun? Silahkan mendaftar
                    </p>
                </a>
            </div>
        </div>
    </section>
@endsection
