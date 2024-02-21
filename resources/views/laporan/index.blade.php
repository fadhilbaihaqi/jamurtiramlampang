@extends('layouts.main')
@section('title', 'Laporan')
@section('content')

    <!-- /breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">Laporan</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- /breadcrumb -->
    <!-- row opened -->
    <div class="row row-sm">
        {{-- stokbibit --}}
        <div class="col-12">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title mg-b-0 mt-2">DATA STOK</h4>
                        <i class="mdi mdi-dots-horizontal text-gray"></i>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table text-md-nowrap">
                            <thead>
                                <tr>
                                    <th class="">Id</th>
                                    <th class="">Stok Bibit</th>
                                    <th class="">Tanggal produksi</th>
                                    <th class="">hasil produksi</th>
                                    <th class="">harga</th>
                                    <th class="">keterangan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($stok as $item => $s)
                                    <tr>
                                        <th scope="row">{{ $item + $stok->firstItem() }}</th>
                                        <td>{{ $s->stok_bibit }}</td>
                                        <td>{{ date('m-d-Y', strtotime($s->tgl_produksi)) }}</td>
                                        <td>{{ $s->quantity }}</td>
                                        <td>{{ $s->harga }}</td>
                                        <td>{{ $s->keterangan }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="card-header float-left">
                            showing
                            {{ $stok->firstItem() }}
                            of
                            {{ $stok->lastItem() }}
                            to
                            {{ $stok->total() }}
                            entries
                        </div>
                        <div class="float-right">
                            {{ $stok->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- stokbibt --}}

        {{-- dataproduksi --}}
        <div class="col-12">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title mg-b-0 mt-2">DATA PRODUKSI</h4>
                        <i class="mdi mdi-dots-horizontal text-gray"></i>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table text-md-nowrap">
                            <thead>
                                <tr>
                                    <th class="">Id</th>
                                    <th class="">Stok Bibit</th>
                                    <th class="">hasil produksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($dataproduksi as $item => $dp)
                                    <tr>
                                        <th scope="row">{{ $item + $dataproduksi->firstItem() }}</th>
                                        <td>{{ $dp->getstok->stok_bibit }}</td>
                                        <td>{{ $dp->hasil_produksi }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="card-header float-left">
                            showing
                            {{ $dataproduksi->firstItem() }}
                            of
                            {{ $dataproduksi->lastItem() }}
                            to
                            {{ $dataproduksi->total() }}
                            entries
                        </div>
                        <div class="float-right">
                            {{ $dataproduksi->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- dataproduksi --}}

        {{-- pemesanan --}}
        <div class="col-12">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title mg-b-0 mt-2">DATA Pemesanan</h4>
                        <i class="mdi mdi-dots-horizontal text-gray"></i>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table text-md-nowrap">
                            <thead>
                                <tr>
                                    <th class="">Id</th>
                                    <th class="">Nama Pemesan</th>
                                    <th class="">Nama Bibit</th>
                                    <th class="">Jumlah Pemesanan</th>
                                    <th class="">Alamat</th>
                                    <th class="">no hp</th>
                                    <th class="">status</th>
                                    <th class="">upload</th>
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
                                        <td>{{ $kp->jumlah_pemesanan }}</td>
                                        <td>{{ $kp->alamat }}</td>
                                        <td>{{ $kp->no_hp }}</td>
                                        <td>
                                            <span
                                                class="badge bg-{{ $kp->status > 0 ? 'success text-white' : 'info' }}">{{ $kp->status > 0 ? 'Selesai' : 'Progress' }}</span>
                                        </td>
                                        @if ($kp->upload != null)
                                            <td>
                                                <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                                    data-bs-target="#lihat{{ $kp->id }}">Lihat</button>
                                            </td>
                                        @else
                                            <td><span class="text-muted text-center">Belum Upload</span></td>
                                        @endif
                                    </tr>
                                    <div class="modal fade" id="lihat{{ $kp->id }}" tabindex="-1"
                                        aria-labelledby="lihat{{ $kp->id }}Label" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="lihat{{ $kp->id }}Label">
                                                        Bukti Pembayaran</h1>
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
                    </div>
                </div>
            </div>
        </div>
        {{-- pemesanan --}}
    </div>
    <!-- /row -->


@endsection
