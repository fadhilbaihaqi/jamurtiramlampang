@extends('template_auth.layout')
@section('title', 'login dulu slur')
@section('content')
    <!-- page -->
    <div class="page">

        <!-- main-signin-wrapper -->
        <div class="my-auto page page-h">
            <div class="main-signin-wrapper">
                <div class="main-card-signin d-md-flex wd-100p">
                    <div class="wd-md-50p login d-none d-md-block page-signin-style p-5 text-white">
                        <div class="my-auto authentication-pages">
                            <div>
                                <img src="{{ asset('') }}assets/img/brand/logo-white.png" class=" m-0 mb-4" alt="logo">
                                <h5 class="mb-4">Responsive Modern Dashboard &amp; Admin Template</h5>
                            </div>
                        </div>
                    </div>
                    <div class="p-5 wd-md-50p">
                        <div class="main-signin-header">
                            @if (session()->has('loginSuccess'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('loginSuccess') }}
                                    <button type="button" class="btn btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif

                            @if (session('loginError'))
                                <div class="alert alert-solid-danger" role="alert">
                                    <span class="alert-inner--icon"><i class="fe fe-slash"></i></span>
                                    <button aria-label="Close" class="close" data-dismiss="alert" type="button">
                                        <span aria-hidden="true">&times;</span></button>
                                    <strong>{{ session('loginError') }}</strong>
                                </div>
                            @endif

                            @if (session()->has('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('success') }}
                                    <button type="button" class="btn btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif
                            <h2>Selamat Datang Di Jamur Lampang!</h2>
                            <h4>Silahkan Login Untuk Melanjutkan</h4>
                            <form action="{{ route('auth') }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label>Username</label>
                                    <input class="form-control" placeholder="Masukkan username dulu slur" type="username"
                                        name="username">
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input class="form-control" placeholder="Masukkan password dulu slur" type="password"
                                        name="password">
                                </div>
                                <button class="btn btn-main-primary btn-block" type="submit">Haiuuu Login <i
                                        class="fas fa-sign-in-alt"></i></button>
                            </form>
                        </div>
                        {{-- <div class="main-signin-footer mt-3 mg-t-5">
                            <p><a href="">Forgot password?</a></p>
                            <p>Belum punya akun? <a href="page-signup.html">Registrasi disini</a></p>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- page closed -->
@endsection
