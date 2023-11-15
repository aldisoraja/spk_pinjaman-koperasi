@extends('layouts.app')

@section('content')
    <div id="breadcrumbs-wrapper" data-image="{{ asset('assets/images/gallery/breadcrumb-bg.jpg') }}">
        <!-- Search for small screen-->
        <div class="container">
            <div class="row">
                <div class="col s12 m6 l6">
                    <h5 class="breadcrumbs-title mt-0 mb-0"><span>Detail Perhitungan Profile Matching</span></h5>
                </div>
                <div class="col s12 m6 l6 right-align-md">
                    <ol class="breadcrumbs mb-0">
                        <li class="breadcrumb-item"><a href="/dashboard">Home</a>
                        </li>
                        <li class="breadcrumb-item active">Detail Perhitungan Profile Matching
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
                        <div class="col s6" style="margin-left: -12px">
                            <h4 class="card-title">Mengkonversi Nilai Data Alternatif</h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12">
                            <div class="responsive-table">
                                <table id="konversi-alternatif" class="display dataTable">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama</th>
                                            @foreach ($kriteria as $item)

                                            <th>C{{ $loop->iteration  }}</th>
                                            @endforeach
                                           
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($dataPerhitungans as $items)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $items[0]['nama_alternatif'] }}</td>
                                                @foreach ($items as $item)
                                                <td>{{ $item['nilai_sub_kriteria'] }}</td>
                                                @endforeach
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
    </div>

    <div class="row">
        <div class="col s12">
            <div class="card">
                <div class="card-content">
                    <div class="flex">
                        <div class="col s6" style="margin-left: -12px">
                            <h4 class="card-title">Nilai Ideal</h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12">
                            <table id="nilai-ideal" class="display dataTable">
                                <thead>
                                    <tr>
                                        @foreach ($kriteria as $item)

                                            <th>C{{ $loop->iteration  }}</th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        @foreach ($nilaiIdeal as $item)
                                            <td>{{ $item->nilai_ideal  }}</td>
                                            
                                        @endforeach
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
                            <h4 class="card-title">Hasil Perhitungan Pemetaan GAP</h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12">
                            <table id="perhitungan-gap" class="display dataTable">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        @foreach ($kriteria as $item)

                                        <th>C{{ $loop->iteration  }}</th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($dataPembobotanGapCollection as $items)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $items[0]['nama_alternatif'] }}</td>
                                                @foreach ($items as $item)
                                                    <td>{{ $item['nilai_pemetaan_gap'] }}</td>
                                                @endforeach

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

    <div class="row">
        <div class="col s12">
            <div class="card">
                <div class="card-content">
                    <div class="flex">
                        <div class="col s6" style="margin-left: -12px">
                            <h4 class="card-title">Hasil Pembobotan GAP</h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12">
                            <table id="pembobotan-gap" class="display dataTable">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        @foreach ($kriteria as $item)

                                        <th>C{{ $loop->iteration  }}</th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($dataPembobotanGapCollection as $items)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $items[0]['nama_alternatif'] }}</td>
                                                @foreach ($items as $item)
                                                    {{-- @dd($item) --}}
                                                    <td>{{ $item['nilai_bobot_gap'] }}</td>
                                                @endforeach

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

    <div class="row">
        <div class="col s12">
            <div class="card">
                <div class="card-content">
                    <div class="flex">
                        <div class="col s6" style="margin-left: -12px">
                            <h4 class="card-title">Hasil Perhitungan Core Factor dan Secondary Factor</h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12">
                            <table id="perhitungan" class="display dataTable">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>(
                                            @foreach ($kriteria->where('faktor_id',1) as $item)
                                            @if($loop->iteration == 1)

                                            @else
                                            +
                                            @endif
                                            {{ $item->kode_kriteria }}
                                          
                                            @endforeach)</th>
                                        <th>( @foreach ($kriteria->where('faktor_id',2) as $item)
                                            @if($loop->iteration == 1)

                                            @else
                                            +
                                            @endif
                                            {{ $item->kode_kriteria }}
                                          
                                            @endforeach)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($dataMapping as $items)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $items['nama_alternatif'] }}</td>
                                                <td>{{ $items['hasil_core_faktor'] }}</td>
                                                <td>{{ $items['hasil_secondary_faktor'] }}</td>
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

    <div class="row">
        <div class="col s12">
            <div class="card">
                <div class="card-content">
                    <div class="flex">
                        <div class="col s6" style="margin-left: -12px">
                            <h4 class="card-title">Hasil Perhitungan Nilai Total</h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12">
                            <table id="perhitungan-total" class="display dataTable">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Nilai Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                     @foreach ($hasilNilaiAkhir as $item)

                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $item['nama_alternatif'] }}</td>
                                                <td>{{ $item['total'] }}</td>
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

    <div class="row">
        <div class="col s12">
            <div class="card">
                <div class="card-content">
                    <div class="flex">
                        <div class="col s6" style="margin-left: -12px">
                            <h4 class="card-title">Hasil Perankingan</h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12">
                            <table id="perangkingan" class="display dataTable">
                                <thead>
                                    <tr>
                                        <th>Nama</th>
                                        <th>Nilai Total</th>
                                        <th>Ranking</th>
                                    </tr>
                                </thead>
                                <tbody>
                                   @foreach ($hasilRanking as $item)

                                            <tr>
                                                <td>{{ $item['nama_alternatif'] }}</td>
                                                <td>{{ $item['total'] }}</td>
                                                <td>{{ $loop->iteration }}</td>

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
        $('#konversi-alternatif').DataTable();
        $('#nilai-ideal').DataTable();
        $('#perhitungan-gap').DataTable();
        $('#pembobotan-gap').DataTable();
        $('#perhitungan').DataTable();
        $('#perhitungan-total').DataTable();
        $('#perangkingan').DataTable(
            {
        order: [[1, 'desc']],
            }
        );
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
