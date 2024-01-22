@extends('backend.index')
@section('content')
@php
$ar_judul = ['No','Nama','Barcode','Kategori','Harga','Kondisi','Action'];
$no = 1;
@endphp
<h3>Daftar Asset</h3>
<a href="{{ route('asset.create') }}" class="btn btn-primary" title="Tambah Data">
    <i class="bi bi-clipboard-plus"></i>
</a>
<a href="{{ route('asset.pdf') }}" class="btn btn-danger" title="Export to PDF">
	<i class="bi bi-file-earmark-pdf"></i>
</a>
<a href="{{ route('asset.excel') }}" class="btn btn-success" title="Export to Excel">
	<i class="bi bi-file-excel"></i>
</a>
<br/><br/>
<table class="table datatable">
	<thead>
		<tr>
			@foreach($ar_judul as $jdl)
				<th>{{ $jdl }}</th>
			@endforeach
		</tr>
	</thead>
	<tbody>
		@foreach($ar_asset as $a)
			<tr>
				<td>{{ $no++ }}</td>
				<td>{{ $a->nama }}</td>
				<td>{!! DNS1D::getBarcodeHTML('$ '. $a->id, 'C39') !!}</td>
				<td>{{ $a->kategori->nama }}</td>
				<td>Rp. {{ number_format($a->harga,0,',','.') }}</td>
				<td>{{ $a->kondisi }}</td>
                <td>
					<form method="POST" action="{{ route('asset.delete', $a->id) }}">
					@csrf
                    @method('DELETE')		
					<a class="btn btn-info btn-sm" href="{{ route('asset.show', $a->id) }}" title="Detail Asset">
                        <i class="bi bi-eye"></i>
                    </a>
                    <a class="btn btn-warning btn-sm" href="{{ route('asset.edit', $a->id) }}" title="Ubah Asset">
                        <i class="bi bi-pencil-fill"></i>
                    </a>
					<button type="submit" class="btn btn-danger btn-sm show-alert-delete-box" title="Hapus Asset">
						<i class="bi bi-trash"></i>
					</button>
					</form>
				</td>
			</tr>
		@endforeach
	</tbody>
</table>
@endsection