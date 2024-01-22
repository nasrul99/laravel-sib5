@extends('backend.index')
@section('content')
<div class="card">
    <div class="card-body">
        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <h5 class="card-title">Form Edit Asset</h5>
        <!-- No Labels Form -->
        <form method="POST" action="{{ route('asset.update',$row->id) }}" 
          enctype="multipart/form-data">
        @csrf
        @method('PUT') 
            <div class="col-md-12">
                <label for="basic-url" class="form-label">Nama Asset</label>
                <input type="text" class="form-control" name="nama" value="{{ $row->nama }}" placeholder="Nama Asset">
            </div>
            <div class="col-md-12">
                <label for="basic-url" class="form-label">Kategori Asset</label>
                <select name="kategori_id" class="form-select">
                    <option>-- Pilih Kategori Asset --</option>
                    @foreach($ar_kategori as $k)
                        @php 
                        $sel = ($k->id == $row->kategori_id) ? 'selected' : ''; 
                        @endphp
                        <option value="{{ $k->id }}" {{ $sel }}>{{ $k->nama }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-6">
                <label for="basic-url" class="form-label">Tahun Beli</label>
                <input type="text" class="form-control" name="thn_beli" value="{{ $row->thn_beli }}" placeholder="Tahun Beli">
            </div>
            <div class="col-md-6">
                <label for="basic-url" class="form-label">Harga</label>
                <input type="text" class="form-control" name="harga" value="{{ $row->harga }}" placeholder="Harga">
            </div>
            <div class="col-md-6">
                <label for="basic-url" class="form-label">Masa Umur</label>
                <input type="text" class="form-control" name="masa_umur" value="{{ $row->masa_umur }}" placeholder="Masa Umur">
            </div>
            <div class="col-md-6">
                <fieldset class="row mb-3">
                    <legend class="col-form-label col-sm-2 pt-0">Kondisi</legend>
                    <div class="col-sm-10">
                        @foreach($ar_kondisi as $k )
                            @php 
                            $cek = ($k == $row->kondisi) ? 'checked' : ''; 
                            @endphp
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="kondisi" value="{{ $k }}" {{ $cek }}>
                                <label class="form-check-label">
                                    {{ $k }}
                                </label>
                            </div>
                        @endforeach
                    </div>
                </fieldset>
            </div>
            <div class="col-6">
                <label for="basic-url" class="form-label">Lokasi</label>
                <textarea class="form-control" name="lokasi" cols="50" rows="5">{{ $row->lokasi }}</textarea>
            </div>
            <div class="col-md-6">
                <label for="basic-url" class="form-label">Foto</label>
                <input type="file" class="form-control" name="foto" />
            </div>
            <hr/>
            <div class="text-center">
                <button type="submit" class="btn btn-primary btn-sm">Ubah</button>
                <a href="{{ url('/asset') }}" class="btn btn-secondary btn-sm">Batal</a>
            </div>
        </form><!-- End No Labels Form -->
    </div>
</div>
@endsection
