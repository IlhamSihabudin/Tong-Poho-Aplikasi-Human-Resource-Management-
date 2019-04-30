@php
    // Fungsi header dengan mengirimkan raw data excel
    header("Content-type: application/vnd-ms-excel");

    // Mendefinisikan nama file ekspor "hasil-export.xls"
    header("Content-Disposition: attachment; filename=LaporanAbsen". date('d-m-Y', strtotime(Session::get('tgl_awal'))) . "sampai" . date('d-m-Y', strtotime(Session::get('tgl_akhir'))) . ".xls");
@endphp

<h3>Absent Report Division {{ $division->division }}</h3>
<h4>From {{ date('d F Y', strtotime(Session::get('tgl_awal'))) . " to " . date('d F Y', strtotime(Session::get('tgl_akhir'))) }}</h4>

<table border="1" style="float: left">
    <thead>
    <tr align="center">
        <th width="20px">#</th>
        <th>Name</th>
        @foreach($only_tgl as $item)
            <th>{{ $item }}</th>
        @endforeach
        <th>Rekap</th>
    </tr>
    </thead>
    <tbody align="center">
    @for($i=0;$i<count($karyawan);$i++)
        <tr>
                <td>{{ $i+1 }}</td>
                <td>{{ $karyawan[$i]->name }}</td>
            @for($j=0;$j<count($only_tgl);$j++)
                <td width="50">{{ $absen_report[$i][$j] }}</td>
            @endfor
            <td>HT=<b>{{ $telat[$i] }}</b>;S=<b>{{ $sakit[$i] }}</b>;I=<b>{{ $izin[$i] }}</b>;A=<b>{{ $alpa[$i] }}</b></td>
        </tr>
    @endfor
    </tbody>
</table>
