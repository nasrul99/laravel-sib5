@extends('backend.index')
@section('content')
@php
    $ar_judul = ['No','Nama'];
    $no = 1;
@endphp
<h3>Daftar Kategori Asset</h3>
<!-- Basic Modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#basicModal">
    <i class="bi bi-clipboard-plus"></i> Tambah
</button>
<div class="modal fade" id="basicModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Form Kategori</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card">
                    <div class="card-body">
                        <br/>
                        <!-- No Labels Form -->
                        <form class="row g-3" method="POST" action="{{ route('kategori.store') }}">
                            @csrf
                            <div class="col-md-12">
                                <input type="text" class="form-control" name="nama" placeholder="Nama Asset">
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                                <button type="reset" class="btn btn-secondary">Batal</button>
                            </div>
                        </form><!-- End No Labels Form -->
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div><!-- End Basic Modal-->
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
        @foreach($ar_kategori as $k)
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $k->nama }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
