@extends('backend.index')
@section('content')
@php
$ar_judul = ['No','Nama'];
$no = 1;
@endphp
<h3>Daftar Divisi</h3>
<a href="" class="btn btn-primary btn-sm" title="Tambah Data">
    <i class="bi bi-clipboard-plus"></i> Tambah
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
		@foreach($ar_divisi as $d)
			<tr>
				<td>{{ $no++ }}</td>
				<td>{{ $d->nama }}</td>
			</tr>
		@endforeach
	</tbody>
</table>
@endsection