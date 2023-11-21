@extends('layouts.main')
@section('title', 'Data Stok')
@section('content')

    <!-- /breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">Data Stok</li>
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

    @if (session('catch'))
        <div class="alert alert-solid-warning" role="alert">
            <span class="alert-inner--icon"><i class="fe fe-info"></i></span>
            <button aria-label="Close" class="close" data-dismiss="alert" type="button">
                <span aria-hidden="true">&times;</span></button>
            <strong>{{ session('catch') }}</strong>
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-solid-danger" role="alert">
            <span class="alert-inner--icon"><i class="fe fe-slash"></i></span>
            <button aria-label="Close" class="close" data-dismiss="alert" type="button">
                <span aria-hidden="true">&times;</span></button>
            <strong>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </strong>
        </div>
    @endif

    <!-- row opened -->
    <div class="row row-sm">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title mg-b-0 mt-2">DATA STOK</h4>
                        {{-- awal button modal --}}
                        <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal"
                            data-bs-target="#exampleModal" data-bs-whatever="@mdo">Tambah Data</button>
                        {{-- akhir button modal --}}
                        <i class="mdi mdi-dots-horizontal text-gray"></i>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table text-md-nowrap">
                            <thead>
                                <tr>
                                    <th class="wd-1p border-bottom-0">Id</th>
                                    <th class="wd-15p border-bottom-0">Nama Bibit</th>
                                    <th class="wd-25p border-bottom-0">tgl produksi</th>
                                    <th class="wd-15p border-bottom-0">quantity</th>
                                    <th class="wd-15p border-bottom-0">Harga</th>
                                    <th class="wd-15p border-bottom-0">keterangan</th>
                                    <th class="wd-15p border-bottom-0">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($stokbibit as $stb)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>{{ $stb->stok_bibit }}</td>
                                        <td>{{ $stb->tgl_produksi }}</td>
                                        <td>{{ $stb->quantity }}</td>
                                        <td>Rp. {{ number_format($stb->harga) }}</td>
                                        <td>{{ $stb->keterangan }}</td>
                                        <td>
                                            <a type="button" data-bs-toggle="modal"
                                                data-bs-target="#exampleModal{{ $stb->id }}" data-bs-whatever="@mdo">
                                                <i class="fas fa-edit" style="color:blue;"></i>
                                            </a>
                                            |
                                            <a href="{{ route('stokbibit.delete', ['id' => $stb->id]) }}">
                                                <i class="fas fa-trash-alt" style="color:red"
                                                    onclick="return confirm('ingin menghapus data?')"></i></a>
                                        </td>
                                    </tr>
                                    <!-- awal modal edit -->
                                    <div class="modal fade" id="exampleModal{{ $stb->id }}" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Data Stok
                                                    </h1>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('stokbibit.update', ['id' => $stb->id]) }}"
                                                        method="post">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="form-group">
                                                            <input type="text" name="stok_bibit" class="form-control"
                                                                placeholder="stok bibit" value="{{ $stb->stok_bibit }}">
                                                        </div>
                                                        <div class="form-group">
                                                            <input type="date" name="tgl_produksi" class="form-control"
                                                                value="{{ $stb->tgl_produksi }}">
                                                        </div>
                                                        <div class="mb-3">
                                                            <div class="form-group">
                                                                <input type="number" name="harga" class="form-control"
                                                                    placeholder="quantity" value="{{ $stb->harga }}">
                                                            </div>
                                                        </div>
                                                        <div class="mb-3">
                                                            <div class="form-group">
                                                                <input type="text" name="keterangan" class="form-control"
                                                                    placeholder="quantity"
                                                                    value="{{ $stb->keterangan }}">
                                                            </div>
                                                        </div>
                                                        {{-- <div class="mb-3">
                                                            <div class="form-group">
                                                                <input type="number" min="0" max="100"
                                                                    name="quantity" class="form-control"
                                                                    placeholder="quantity"
                                                                    value="{{ $stb ? $stb->quantity : '' }}">
                                                            </div>
                                                        </div> --}}
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-outline-secondary"
                                                                data-bs-dismiss="modal">Close</button>
                                                            <button type="submit"
                                                                class="btn btn-outline-primary">Save</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- akhir modal edit -->
                                @endforeach
                            </tbody>
                        </table>
                        <!-- awal modal tambah -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Data Stok</h1>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('stokbibit.store') }}" method="post">
                                            @csrf
                                            <div class="form-group">
                                                <input type="text" name="stok_bibit" class="form-control"
                                                    placeholder="stok bibit">
                                            </div>
                                            <div class="form-group">
                                                <input type="date" name="tgl_produksi" class="form-control">
                                            </div>
                                            <div class="mb-3">
                                                <div class="form-group">
                                                    <input type="number" name="harga" class="form-control"
                                                        placeholder="harga">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <input type="text" name="keterangan" class="form-control"
                                                    placeholder="keterangan">
                                            </div>
                                            {{-- <div class="mb-3">
                                                <div class="form-group">
                                                    <input type="number" min="0" max="100" name="quantity"
                                                        class="form-control" placeholder="quantity">
                                                </div>
                                            </div> --}}
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-outline-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-outline-primary">Save</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- akhir modal tambah -->
                    </div>
                </div>
            </div>
        </div>
        <!-- /row -->
    </div>
@endsection
