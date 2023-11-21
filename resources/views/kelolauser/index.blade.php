@extends('layouts.main')
@section('title', 'Kelola User')
@section('content')

    <!-- /breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">Kelola User</li>
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
                        <h4 class="card-title mg-b-0 mt-2">Kelola User</h4>
                        {{-- awal button modal --}}
                        <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal"
                            data-bs-target="#exampleModal" data-bs-whatever="@mdo">Tambah User</button>
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
                                    <th class="wd-15p border-bottom-0">Username</th>
                                    <th class="wd-35p border-bottom-0">Role</th>
                                    <th class="wd-35p border-bottom-0">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($kelolauser as $ku)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>{{ $ku->username }}</td>
                                        <td>{{ $ku->role->role }}</td>
                                        <td>
                                            <a type="button" data-bs-toggle="modal"
                                                data-bs-target="#exampleModal{{ $ku->id }}" data-bs-whatever="@mdo">
                                                <i class="fas fa-edit" style="color:blue;"></i>
                                            </a>
                                            |
                                            {{-- <form action="{{ route('dataproduksi.delete', ['id' => $ku->id]) }}"
                                                method="post" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                            </form> --}}
                                            <a href="{{ route('kelolauser.delete', ['id' => $ku->id]) }}">
                                                <i class="fas fa-trash-alt" style="color:red"
                                                    onclick="return confirm('ingin menghapus data?')"></i></a>
                                        </td>
                                    </tr>
                                    <!-- awal modal edit -->
                                    <div class="modal fade" id="exampleModal{{ $ku->id }}" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Data User
                                                    </h1>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('kelolauser.update', ['id' => $ku->id]) }}"
                                                        method="post">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="form-group">
                                                            <input type="text" name="username" class="form-control"
                                                                placeholder="username" value="{{ $ku->username }}">
                                                        </div>
                                                        <div class="form-group">
                                                            <input type="password" name="password" class="form-control"
                                                                placeholder="password">
                                                        </div>

                                                        <div class="form-group">
                                                            <select name="role_id" id="role_id" class="form-control"
                                                                required="true">
                                                                <option>--pilih role--</option>
                                                                @foreach ($roles as $r)
                                                                    <option value="{{ $r->id }}"
                                                                        {{ $r->id == $ku->role_id ? 'selected' : '' }}>
                                                                        {{ $r->role }}</option>
                                                                @endforeach
                                                            </select>
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
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Data User</h1>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('kelolauser.store') }}" method="post">
                                            @csrf
                                            <div class="form-group">
                                                <input type="text" name="username" class="form-control"
                                                    placeholder="username">
                                            </div>

                                            <div class="form-group">
                                                <input type="password" name="password" class="form-control"
                                                    placeholder="password">
                                            </div>

                                            <div class="form-group">
                                                <select name="role_id" id="role_id" class="form-control"
                                                    required="true">
                                                    <option>--Pilih Role--</option>
                                                    @foreach ($roles as $r)
                                                        <option value="{{ $r->id }}">{{ $r->role }}</option>
                                                    @endforeach
                                                </select>
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
