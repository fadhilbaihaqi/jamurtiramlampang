@extends('layouts.main')
@section('title', 'Kelola Pemesanan')
@section('content')

    <!-- /breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">Kelola Pemesanan</li>
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
            <span class="alert-inner--icon"><i class="fe fe-slash"></i> Warning</span>
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
                        <h4 class="card-title mg-b-0 mt-2">KELOLA PEMESANAN</h4>
                        {{-- awal button modal --}}
                        <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal"
                            data-bs-target="#exampleModal" data-bs-whatever="@mdo">Tambah Pemesanan</button>
                        {{-- akhir button modal --}}
                        <i class="mdi mdi-dots-horizontal text-gray"></i>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table text-md-nowrap">
                            <thead>
                                <tr>
                                    <th class="border-bottom-0">Id</th>
                                    <th class="border-bottom-0">Nama Pemesan</th>
                                    <th class="border-bottom-0">Nama Bibit</th>
                                    <th class="border-bottom-0">harga Bibit</th>
                                    <th class="border-bottom-0">Jumlah Pemesanan</th>
                                    <th class="border-bottom-0">Alamat</th>
                                    <th class="border-bottom-0">no hp</th>
                                    <th class="border-bottom-0">total bayar</th>
                                    <th class="border-bottom-0">status</th>
                                    <th class="border-bottom-0">upload</th>
                                    <th class="border-bottom-0">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = 1;
                                @endphp
                                @foreach ($kelolapemesanan as $item => $kp)
                                    <tr>
                                        <th scope="row">{{ $item + $kelolapemesanan->firstItem() }}</th>
                                        <td>{{ $kp->user->username }}</td>
                                        <td>{{ $kp->stok->stok_bibit }}</td>
                                        <td>Rp. {{ number_format($kp->stok->harga) }}</td>
                                        <td>{{ $kp->jumlah_pemesanan }}</td>
                                        <td>{{ $kp->alamat }}</td>
                                        <td>{{ $kp->no_hp }}</td>
                                        <td>Rp. {{ number_format($kp->stok->harga * $kp->jumlah_pemesanan) }}</td>
                                        @if (strtolower(auth()->user()->role->role) == strtolower('konsumen'))
                                            @if ($kp->status == 0)
                                                <td>
                                                    <button type="button" class="btn btn-sm btn-info"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#uploadTask{{ $kp->id }}">Upload
                                                        Bukti Pembayaran</button>
                                                </td>
                                            @else
                                                <td><span class="badge bg-success">Selesai</span></td>
                                            @endif
                                        @else
                                            @if ($kp->status == 0)
                                                <td><span class="badge bg-info">Progress</span></td>
                                            @else
                                                <td><span class="badge bg-success text-white">Selesai</span></td>
                                            @endif
                                        @endif

                                        @if ($kp->upload != null)
                                            <td>
                                                <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                                    data-bs-target="#lihat{{ $kp->id }}">Lihat</button>
                                            </td>
                                        @else
                                            <td><span class="text-muted text-center">Belum Upload</span></td>
                                        @endif
                                        <td>
                                            @if ($kp->status == 0)
                                                <a type="button" data-bs-toggle="modal"
                                                    data-bs-target="#exampleModal{{ $kp->id }}"
                                                    data-bs-whatever="@mdo">
                                                    <i class="fas fa-edit" style="color:blue;"></i>
                                                </a>
                                                |
                                                <a href="{{ route('kelolapemesanan.delete', ['id' => $kp->id]) }}"><i
                                                        class="fas fa-trash-alt" style="color:red;"
                                                        onclick="return confirm('Ingin menghapus data ?')"></i></a>
                                            @endif
                                        </td>
                                    </tr>
                                    <!-- uploadtask -->
                                    <div class="modal fade" id="uploadTask{{ $kp->id }}" tabindex="-1"
                                        aria-labelledby="uploadTask{{ $kp->id }}Label" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="uploadTask{{ $kp->id }}Label">
                                                        Upload Bukti Pembayaran</h1>
                                                </div>
                                                <form
                                                    action="{{ route('kelolapemesanan.validateTask', ['id' => $kp->id]) }}"
                                                    enctype="multipart/form-data" method="post">
                                                    <div class="modal-body">
                                                        @csrf
                                                        <div class="mb-3">
                                                            <label for="upload" class="col-form-label">Upload
                                                                Bukti Pembayaran:</label>
                                                            <input type="file" class="form-control" id="upload"
                                                                name="upload" required>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-success">Upload</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- uploadtask -->
                                    <!-- lihat -->
                                    <div class="modal fade" id="lihat{{ $kp->id }}" tabindex="-1"
                                        aria-labelledby="lihat{{ $kp->id }}Label" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="lihat{{ $kp->id }}Label">
                                                        Task Finish</h1>
                                                </div>
                                                <div class="modal-body">
                                                    @csrf
                                                    <div class="mb-3">
                                                        <img src="{{ asset('storage/' . $kp->upload) }}"
                                                            class="img-fluid text-center">
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- lihat -->
                                    <!-- awal modal edit -->
                                    <div class="modal fade" id="exampleModal{{ $kp->id }}" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Data
                                                        Pemesanan
                                                    </h1>
                                                </div>
                                                <div class="modal-body">
                                                    <form
                                                        action="{{ route('kelolapemesanan.update', ['id' => $kp->id]) }}"
                                                        method="post">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="form-group">
                                                            <select name="stok_bibit_id" id="stok_bibit_id"
                                                                class="form-control" required="true">
                                                                <option>--Pilih Bibit--</option>
                                                                @foreach ($stokbibit as $sb)
                                                                    <option value="{{ $sb->id }}"
                                                                        {{ $sb->id == $kp->stok_bibit_id ? 'selected' : '' }}>
                                                                        {{ $sb->stok_bibit }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>

                                                        <div class="form-group">
                                                            <input type="number" name="jumlah_pemesanan"
                                                                class="form-control" placeholder="jumlah pemesanan"
                                                                value="{{ $kp->jumlah_pemesanan }}">
                                                        </div>

                                                        <div class="form-group">
                                                            <textarea name="alamat" id="alamat" class="form-control" placeholder="Alamat Pemesan">{{ $kp->alamat }}</textarea>
                                                        </div>

                                                        <div class="form-group">
                                                            <input type="text" name="no_hp" class="form-control"
                                                                placeholder="no_hp" value="{{ $kp->no_hp }}">
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
                        <div class="card-header float-left">
                            showing
                            {{ $kelolapemesanan->firstItem() }}
                            of
                            {{ $kelolapemesanan->lastItem() }}
                            to
                            {{ $kelolapemesanan->total() }}
                            entries
                        </div>
                        <div class="float-right">
                            {{ $kelolapemesanan->links() }}
                        </div>

                        <!-- awal modal tambah -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Data Pemesanan</h1>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('kelolapemesanan.store') }}" method="post">
                                            @csrf
                                            <div class="form-group">
                                                <input type="number" name="jumlah_pemesanan" class="form-control"
                                                    placeholder="jumlah pemesanan">
                                            </div>

                                            <div class="form-group">
                                                <select name="stok_bibit_id" id="stok_bibit_id" class="form-control"
                                                    required="true">
                                                    <option>--Pilih Bibit--</option>
                                                    @foreach ($stokbibit as $sb)
                                                        <option value="{{ $sb->id }}">{{ $sb->stok_bibit }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <textarea name="alamat" id="alamat" class="form-control" placeholder="Alamat Pemesan"></textarea>
                                            </div>

                                            <div class="form-group">
                                                <input type="text" name="no_hp" class="form-control"
                                                    placeholder="no hp">
                                            </div>

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
