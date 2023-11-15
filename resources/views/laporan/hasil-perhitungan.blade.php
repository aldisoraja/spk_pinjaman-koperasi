<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Hasil Perhitungan</title>
    <link rel="apple-touch-icon" href="{{asset('assets/images/logo/2.png')}}">
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('assets/images/logo/2.png')}}">
    <style type="text/css">
        body{
            font-family: Arial;
            color: black;
        }
        table {
            border-collapse: collapse;
            border-spacing: 0;
            width: 100%;
            margin: 0 auto;
        }
        th, td {
            text-align: left;
            padding: 5px 10px;
            border: 1px solid #000000;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        .signature_wrapper{
            text-align: right;
        }
    </style>
</head>
<body>
    <div class="row">
        <div style="display: flex; align-items: center; justify-content: center; column-gap: 3rem">
            <img src="{{asset('assets/images/logo/2.png')}}" alt="" width="180px" height="200px">
            <div style="text-align: center">
                <h2>KOPERASI ANEKA USAHA "SIDO MAKMUR"</h2>
                <h2>KELURAHAN MENANGGAL KECAMATAN GAYUNGAN</h2>
                <h2>BADAN HUKUM NO. 7342/BH/II/92 TGL. 22 JULI 1992</h2>
                <p>Kantor : Jl. Menanggal VII/1 Gayungan Surabaya</p>
                <p>Telp/Fax (031)51512819</p>
            </div>
            <img src="{{asset('assets/images/logo/3.png')}}" alt="" width="180px" height="230px">
        </div>
        <h1 style="margin-top:-20px">_____________________________________________________________________________</h1>
    </div>
    <br>
    <br>
    <h2 style="text-align:center">Laporan Hasil Perhitungan Data Alternatif</h2>
    <br>
    <tr>
        <td>Diterima</td>
        <td>:</td>
        <td>{{ $detailHasilPerhitungan->where('keterangan','Di Terima')->count() ?? 0 }}</td>
    </tr>
    <br>
    <tr>
        <td>Ditolak</td>
        <td>:</td>
        <td>{{ $detailHasilPerhitungan->where('keterangan','Di Tolak')->count() ?? 0 }}</td>
    </tr>
    <br>
    <tr>
        <td>Total pinjaman yang diterima</td>
        <td>:</td>
        <td>{{ "Rp " . number_format($detailHasilPerhitungan->where('keterangan','Di Terima')->sum('besar_pinjaman'),2,',','.');  }}</td>
    </tr>
    <br>
    <br>
    <br>
    <table border="1">
        <thead>
          <tr>
            <th>No</th>
            <th>Tanggal Perhitungan</th>
            <th>No Anggota</th>
            <th>Nama Anggota</th>
            <th>Besar Pinjaman</th>
            <th>Nilai</th>
            <th>Keterangan</th>
          </tr>
        </thead>

        <tbody>
        @foreach ($detailHasilPerhitungan as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->created_at->format('d-m-Y H:i:s') }}</td>
                <td>{{ $item->alternatif->no_anggota }}</td>
                <td>{{ $item->alternatif->nama_anggota }}</td>
                <td>{{ "Rp " . number_format( $item->besar_pinjaman,2,',','.');  }}</td>
                <td>{{ $item->nilai_total }}</td>
                <td>{{ $item->keterangan ?? '' }}</td>

            </tr>
        @endforeach
        </tbody>
    </table>
    <br>
    <br>
    <div class="signature_wrapper">
        <p>Surabaya, {{ \Carbon\Carbon::now()->locale('id')->isoFormat('D MMMM YYYY')}}<br>Mengetahui</p>
        <br>
        <br>
        <p><strong><ins>({{ $ketua->name ?? 'Ketua' }})</ins><br>{{ $ketua->jabatan ?? 'Koperasi Sido Makmur' }}</strong></p>
    </div>
    
    <script type="text/javascript">
        window.print();
    </script>

</body>
</html>