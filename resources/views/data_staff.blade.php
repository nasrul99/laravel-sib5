<h3 align="center">Daftar Pegawai</h3>
<table align="center" border="1" cellpadding="10" cellspacing="0">
	<thead>
		<tr bgcolor="#7EAA92">
			@foreach($ar_judul as $jdl)
			    <th>{{ $jdl }}</th>
			@endforeach
		</tr>
	</thead>
	<tbody>
		@php $no = 1; @endphp
		@foreach($ar_pegawai as $pegawai)
            @php
            //--------ambil kolom tertentu untuk struktur kendali---------
            $jabatan = $pegawai['jabatan'];
            $status = $pegawai['status'];
            $agama = $pegawai['agama'];
            //print_r($jabatan); die();
            @endphp
			@switch($jabatan)
				@case('Manager') @php $gapok = 15000000; @endphp @break
				@case('Asisten Manager')  @php $gapok = 10000000; @endphp @break
				@case('Supervisor')  @php $gapok = 7500000; @endphp @break
				@case('Staff')  @php $gapok = 3000000; @endphp @break
				@default  @php $gapok = 0; @endphp @break
			@endswitch
            @php
			$tunjab = 0.2 * $gapok;
			$bpjs = 0.05 * $gapok;
			$tunkel = ($status == 'Menikah') ? 0.1 * $gapok : 0;
			$gator = $gapok + $tunjab + $bpjs + $tunkel;
            $zakat = ($agama == "Islam" && $gator >= 6000000) ? 0.025 * $gator : 0;
			$gaber = $gator - $zakat;
			$warna = ($no % 2 == 1) ? 'beige' : 'khaki';
            @endphp
			
			<tr bgcolor="{{ $warna }}">
				<td>{{ $no }}</td>
				<td>{{ $pegawai['nip'] }}</td>
				<td>{{ $pegawai['nama'] }}</td>
				<td>{{ $pegawai['jabatan'] }}</td>
				<td>{{ $pegawai['status'] }}</td>
				<td>{{ $pegawai['agama'] }}</td>
				<td align="right">Rp. {{ number_format($gapok,0,',','.') }}</td>
				<td align="right">Rp. {{ number_format($tunjab,0,',','.') }}</td>
				<td align="right">Rp. {{ number_format($bpjs,0,',','.') }}</td>
				<td align="right">Rp. {{ number_format($tunkel,0,',','.') }}</td>
                <td align="right">Rp. {{ number_format($zakat,0,',','.') }}</td>
				<td align="right">Rp. {{ number_format($gaber,0,',','.') }}</td>
			</tr>
        @php $no++; @endphp
		@endforeach	
		
	</tbody>
</table>