@extends('layouts.main')
@section('title', 'halaman dashboard')
@section('content')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div>
            <h4 class="content-title mb-2">HALO, SELAMAT DATANG, {{ auth()->user()->username }}!</h4>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">ini Dasboard</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- /breadcrumb -->
    @if (session('success'))
        <div class="alert alert-solid-success" role="alert">
            <span class="alert-inner--icon"><i class="fe fe-thumbs-up"></i></span>
            <button aria-label="Close" class="close" data-dismiss="alert" type="button">
                <span aria-hidden="true">&times;</span></button>
            <strong>{{ session('success') }}</strong>
        </div>
    @endif

    <!-- row -->
    <div class="row row-sm justify-content-center">
        <div class="col-sm-12 col-md-6 col-lg-6 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="card-order">
                        <h6 class="mb-2">Total User</h6>
                        <h2 class="text-right ">
                            <i class="mdi mdi-account icon-size float-left text-primary text-primary-shadow"></i>
                            <span>{{ $Totaluser }}</span>
                        </h2>
                        <p class="mb-0"><span class="float-right"></span></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-6 col-lg-6 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="card-order">
                        <h6 class="mb-2">Total konsumen</h6>
                        <h2 class="text-right ">
                            <i class="mdi mdi-account icon-size float-left text-primary text-primary-shadow"></i>
                            <span>{{ $Totalkonsumen }}</span>
                        </h2>
                        <p class="mb-0"><span class="float-right"></span></p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-12 col-md-6 col-lg-6 col-xl-3">
            <div class="card ">
                <div class="card-body">
                    <div class="card-widget">
                        <h6 class="mb-2">Total Pesanan</h6>
                        <h2 class="text-right">
                            <i class="mdi mdi-file-plus icon-size float-left text-info text-success-shadow"></i>
                            <span>{{ $Totalpemesanan }}</span>
                        </h2>
                        <p class="mb-0"><span class="float-right"></span></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /row -->
@endsection
