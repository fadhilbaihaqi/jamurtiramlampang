@extends('layouts.main')
@section('title', 'Data Produksi')
@section('content')

    <!-- /breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">Data Poduksi</li>
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
                        <h4 class="card-title mg-b-0 mt-2">DATA PRODUKSI</h4>
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
                                    <th class="">Stok Bibit</th>
                                    <th class="">hasil produksi</th>
                                    <th class="">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($dataproduksi as $dp)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>{{ $dp->stokbibit->stok_bibit }}</td>
                                        <td>{{ $dp->hasil_produksi }}</td>
                                        <td>
                                            <a type="button" data-bs-toggle="modal"
                                                data-bs-target="#exampleModal{{ $dp->id }}" data-bs-whatever="@mdo">
                                                <i class="fas fa-edit" style="color:blue;"></i>
                                            </a>
                                            |
                                            {{-- <form action="{{ route('dataproduksi.delete', ['id' => $dp->id]) }}"
                                                method="post" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                            </form> --}}
                                            <a href="{{ route('dataproduksi.delete', ['id' => $dp->id]) }}">
                                                <i class="fas fa-trash-alt" style="color:red"
                                                    onclick="return confirm('ingin menghapus data?')"></i></a>
                                        </td>
                                    </tr>
                                    <!-- awal modal edit -->
                                    <div class="modal fade" id="exampleModal{{ $dp->id }}" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Data Produksi
                                                    </h1>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('dataproduksi.update', ['id' => $dp->id]) }}"
                                                        method="post">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="form-group">
                                                            <input type="text" name="stok_bibit" class="form-control"
                                                                placeholder="stok bibit" value="{{ $dp->stok_bibit }}">
                                                        </div>

                                                        <div class="form-group">
                                                            <input type="date" name="tgl_produksi" class="form-control"
                                                                value="{{ $dp->tgl_produksi }}">
                                                        </div>

                                                        {{-- <div class="form-group">
                                                            <input type="text" name="jml_produksi" class="form-control"
                                                                placeholder="jumlah produksi"
                                                                value="{{ $dp->jml_produksi }}">
                                                        </div> --}}

                                                        <div class="form-group">
                                                            <input type="text" name="hasil_produksi" class="form-control"
                                                                placeholder="hasil produksi"
                                                                value="{{ $dp->hasil_produksi }}">
                                                        </div>

                                                        <div class="form-group">
                                                            <input type="text" name="keterangan" class="form-control"
                                                                placeholder="keterangan" value="{{ $dp->keterangan }}">
                                                        </div>

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
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Data Produksi</h1>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('dataproduksi.store') }}" method="post">
                                            @csrf
                                            <div class="form-group">
                                                <select name="stok_bibit_id" id="stok_bibit_id" class="form-control"
                                                    required="true">
                                                    <option>--Pilih Bibit--</option>
                                                    @foreach ($stokbibit as $sb)
                                                        <option value="{{ $sb->id }}"
                                                            {{ $sb->id == $sb->stok_bibit_id ? 'selected' : '' }}>
                                                            {{ $sb->stok_bibit }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            {{-- <div class="form-group">
                                                <input type="date" name="tgl_produksi" class="form-control">
                                            </div> --}}

                                            {{-- <div class="form-group">
                                                <input type="text" name="jml_produksi" class="form-control"
                                                    placeholder="jumlah produksi">
                                            </div> --}}

                                            <div class="form-group">
                                                <input type="number" name="hasil_produksi" class="form-control"
                                                    placeholder="hasil produksi">
                                            </div>

                                            {{-- <div class="form-group">
                                                <input type="text" name="keterangan" class="form-control"
                                                    placeholder="keterangan">
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
