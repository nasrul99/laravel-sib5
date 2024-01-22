@extends('backend.index')
@section('content')
<div class="pagetitle">
    <h1>Manajemen Asset</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active">Kelola User</li>
        </ol>
    </nav>
</div>
@php
    $ar_judul = ['No','Nama','Role','IsActive','Action'];
    $no = 1;
@endphp
<div class="card">
    <div class="card-body">
        <h5 class="card-title">Data User</h5>
        <a href="{{ route('user.create') }}" class="btn btn-primary btn-sm" title="Tambah Data">
            <i class="bi bi-clipboard-plus"></i> Tambah
        </a>
        <br /><br />
        <table class="table datatable">
            <thead>
                <tr>
                    @foreach($ar_judul as $jdl)
                        <th>{{ $jdl }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach($ar_user as $u)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $u->name }}</td>
                        <td>{{ $u->role }}</td>
                        <td>{{ $u->isactive }}</td>
                        <td>
                            <form method="POST" action="{{ route('user.destroy', $u->id) }}">
                                @csrf
                                @method('DELETE')
                                <a class="btn btn-info btn-sm" href="{{ route('user.show', $u->id) }}" title="Detail User">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a class="btn btn-warning btn-sm" href="{{ route('user.edit', $u->id) }}" title="Ubah User">
                                    <i class="bi bi-pencil-fill"></i>
                                </a>
                                <button type="submit" class="btn btn-danger btn-sm show-alert-delete-box"
                                    title="Hapus User" onclick="return confirm('Anda Yakin Data diHapus')">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
