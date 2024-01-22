@extends('backend.index')
@section('content')
<div class="card">
    <div class="row">
        <div class="col-md-4">
			<center>
			@empty($rs->foto)
				<br/><img src="{{ asset('backend/assets/img/noimage.png') }}" class="img-fluid rounded-start" />
			@else
				<img src="{{ asset('backend/assets/img') }}/{{ $rs->foto }}" />
			@endempty
			</center>
        </div>
        <div class="col-md-4">
            <div class="card-body">
            <br/>
            {!! DNS2D::getBarcodeHTML($rs->id.'-'.date('Y'), 'QRCODE') !!}
            </div>
        </div>
        <div class="col-md-4">
            <div class="card-body">
                <h5 class="card-title">{{ $rs->nama }}</h5>
                <p class="card-text">
					Kategori Asset: {{ $rs->kategori->nama }}
                    <br />Tahun Beli: Rp. {{ $rs->thn_beli }}
                    <br />Harga Asset: Rp.
                    {{ number_format($rs->harga,0,',','.') }}
                    <br />Masa Umur: {{ $rs->masa_umur }} tahun
                    <br />Kondisi: {{ $rs->kondisi }}
                    <br />Lokasi: {{ $rs->lokasi }}
				</p>
				<a href="{{ url('/asset') }}" class="btn btn-primary">Go Back</a>
            </div>
        </div>
    </div>
</div>
@endsection
