@php
$siswa = 'Budi Santoso';
$nilai = 75;
$ket = $nilai >= 60 ? 'Lulus' : 'Gagal';
@endphp

{{-- if multikondisi dengan syarat > 1 --}}
@if($nilai >= 85 && $nilai <= 100) @php $grade = 'A'; @endphp
@elseif($nilai >= 75 && $nilai < 85 ) @php $grade = 'B'; @endphp
@elseif($nilai >= 60 && $nilai < 75 ) @php $grade = 'C'; @endphp
@elseif($nilai >= 30 && $nilai < 60 ) @php $grade = 'D'; @endphp
@elseif($nilai >= 0 && $nilai < 30 ) @php $grade = 'E'; @endphp
@else @php $grade = ''; @endphp
@endif


@switch($grade)
	@case('A') @php $predikat = 'Memuaskan'; @endphp @break 
	@case('B') @php $predikat = 'Bagus'; @endphp @break
	@case('C') @php $predikat = 'Cukup'; @endphp @break
	@case('D') @php $predikat = 'Kurang'; @endphp @break
	@case('E') @php $predikat = 'Buruk'; @endphp @break
	@default @php $predikat = ''; @endphp @break
@endswitch

Nama Siswa: {{  $siswa }}
<br/>Nilai: {{ $nilai }}
<br/>Keterangan: {{ $ket }}
<br/>Grade: {{ $grade }}
<br/>Predikat: {{ $predikat }}
