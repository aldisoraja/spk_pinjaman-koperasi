@extends('layouts.app')

@section('content')
    <div id="breadcrumbs-wrapper" data-image="{{ asset('assets/images/gallery/breadcrumb-bg.jpg') }}">
        <!-- Search for small screen-->
        <div class="container">
            <div class="row">
                <div class="col s12 m6 l6">
                    <h5 class="breadcrumbs-title mt-0 mb-0"><span>Detail Hasil Perhitungan</span></h5>
                </div>
                <div class="col s12 m6 l6 right-align-md">
                    <ol class="breadcrumbs mb-0">
                        <li class="breadcrumb-item"><a href="/dashboard">Home</a>
                        </li>
                        <li class="breadcrumb-item"><a href="/hasil">Catatan Hasil Perhitungan</a>
                        </li>
                        <li class="breadcrumb-item active">Detail Hasil Perhitungan
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col s12">
            <div class="card">
                <div class="card-content">
                    <div class="flex">
                        <div class="col s12" style="margin-left: -12px">
                            <h4 class="card-title">Informasi</h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s6">
                            <table class="striped">
                                <tbody>
                                    <tr>
                                        <td>Diterima</td>
                                        <td>:</td>
                                        <td>{{ $detailHasilPerhitungan->where('keterangan','Di Terima')->count() ?? 0 }}</td>
                                    </tr>
                                    <tr>
                                        <td>Ditolak</td>
                                        <td>:</td>
                                        <td>{{ $detailHasilPerhitungan->where('keterangan','Di Tolak')->count() ?? 0 }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col s6">
                            <table class="striped">
                                <tbody>
                                    <tr>
                                        <td>Total pinjaman yang diterima</td>
                                        <td>:</td>
                                        <td>{{ "Rp " . number_format($detailHasilPerhitungan->where('keterangan','Di Terima')->sum('besar_pinjaman'),2,',','.');  }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col s12">
            <div class="card">
                <div class="card-content">
                    <div class="flex">
                        <div class="col s6" style="margin-left: -12px">
                            <h4 class="card-title">Detail Hasil Perhitungan</h4>
                        </div>
                    </div>
                     <div class="col s12 mb-3" style="text-align: right">
                        <a class='dropdown-trigger btn teal darken-4' href='#' data-target='dropdown1' style="margin-top: 25px"><i class="material-icons left">print</i>Cetak Data</a>
                        <!-- Dropdown Structure -->
                        <ul id='dropdown1' class='dropdown-content'>
                            <li><a href="{{ route('laporan-hasilperhitungan',[$detailHasilPerhitungan->first()->hasil_id]) }}" target="blank"><i class="material-icons">print</i>Print</a></li>
                            <li><a href="{{ route('export-excel-perhitungan',[$detailHasilPerhitungan->first()->hasil_id]) }}"><i class="material-icons">file_download</i>Export Excel</a></li>
                        </ul>
                    </div>
                    <div class="row">
                        <div class="col s12">
                            <table id="faktor" class="display dataTable">
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $('#faktor').DataTable();
    </script>
    <script>
        function confirmDelete(itemId) {
            Swal.fire({
                title: 'Konfirmasi',
                text: 'Apakah Anda yakin ingin menghapus data ini?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, Hapus',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('faktor.destroy' + itemId).submit();
                }
            });
        }
    </script>

    @if (session()->has('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: '{{ session('success') }}',
            })
        </script>
    @elseif (session()->has('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: '{{ session('error') }}',
            })
        </script>
    @endif
@endpush
