@php
$ar_judul = ['No','Nama','Kategori','Harga','Kondisi'];
$no = 1;
@endphp
<h3 align="center">Daftar Asset</h3>
<br/><br/>
<table border="1" align="center" cellpadding="10" cellspacing="0">
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
				<td>{{ $a->kategori->nama }}</td>
				<td>Rp. {{ number_format($a->harga,0,',','.') }}</td>
				<td>{{ $a->kondisi }}</td>
			</tr>
		@endforeach
	</tbody>
</table>