@extends('backend.index')
@section('content')
<div class="card">
    <div class="card-body">
        <br />
        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <h5 class="card-title">Form User</h5>
        <!-- No Labels Form -->
        <form class="row g-3" method="POST" action="{{ route('user.store') }}"
            enctype="multipart/form-data">
            @csrf
            <div class="col-md-12">
                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                    value="{{ old('name') }}" placeholder="Fullname">
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-6">
                <input type="email" class="form-control @error('email') is-invalid @enderror"
                    name="email" value="{{ old('email') }}" placeholder="Email">
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-6">
                <input type="password" class="form-control @error('password') is-invalid @enderror"
                    name="password" value="{{ old('password') }}" placeholder="Password">
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-6">
                <select name="role" 
                    class="form-select @error('role') is-invalid @enderror">
                    <option>-- Pilih Role --</option>
                    @foreach($ar_role as $r)
                        @php $sel = ( old('role') == $r ) ? 'selected' : ''; @endphp
                        <option value="{{ $r }}" {{ $sel }}>{{ $r }}</option>
                    @endforeach
                </select>
                @error('role')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-6">
                <select name="isactive" 
                    class="form-select @error('isactive') is-invalid @enderror">
                    <option>-- Pilih IsActive --</option>
                    @foreach($ar_isactive as $i)
                        @php $sel = ( old('isactive') == $i ) ? 'selected' : ''; @endphp
                        <option value="{{ $i }}" {{ $sel }}>{{ $i }}</option>
                    @endforeach
                </select>
                @error('isactive')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-12">
                <label for="basic-url" class="form-label">Foto</label>
                <input type="file" class="form-control @error('foto') is-invalid @enderror" 
                 name="foto" value="{{ old('foto') }}" />
                 @error('foto')
                    <div class="invalid-feedback">{{ $message }}</div>
                 @enderror   
            </div>
            <br/>
            <div class="text-center">
                <a href="{{ url('/user') }}" class="btn btn-warning btn-sm">Batal</a>
                <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
            </div>
        </form><!-- End No Labels Form -->
    </div>
</div>
@endsection
