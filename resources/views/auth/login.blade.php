@extends('layouts.app')

@section('addCSS')
    <style>
        body {
            background: url('https://i.ibb.co/j6Mym5d/8d60e456-5ade-4640-a1d4-50fd11891171.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }
    </style>
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-dark text-light">{{ __('Sign in to your account') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="row">
                                <div class="col-12">
                                    <label for="email">Masukkan Email</label>
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" required autocomplete="email" autofocus>
                                </div>

                                <div class="col-12 mt-3">
                                    <label for="password">Masukkan Password</label>
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="current-password">
                                </div>

                                <div class="col-12 mt-3">
                                    <button type="submit" class="btn btn-primary btn-block">
                                        {{ __('Masuk Sekarang') }}
                                    </button>
                                </div>
                            </div>

                            <center class="mt-3">
                                <label>Belum punya akun?</label>
                                <a href="{{ route('register') }}" class="btn btn-link">Daftar Sekarang</a>

                                <div class="row">
                                    <div class="col">
                                        <a class="btn btn-link" href="{{ route('password.request') }}">
                                            {{ __('Forgot Your Password?') }}
                                        </a>
                                    </div>
                                </div>
                            </center>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
