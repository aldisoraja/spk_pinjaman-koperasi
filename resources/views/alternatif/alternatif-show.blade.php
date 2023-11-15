@extends('layouts.app')

@section('content')
    <div id="breadcrumbs-wrapper" data-image="{{ asset('assets/images/gallery/breadcrumb-bg.jpg') }}">
        <!-- Search for small screen-->
        <div class="container">
            <div class="row">
                <div class="col s12 m6 l6">
                    <h5 class="breadcrumbs-title mt-0 mb-0"><span>Data Alternatif</span></h5>
                </div>
                <div class="col s12 m6 l6 right-align-md">
                    <ol class="breadcrumbs mb-0">
                        <li class="breadcrumb-item"><a href="/dashboard">Home</a>
                        </li>
                        <li class="breadcrumb-item"><a href="/alternatif">Data Alternatif</a>
                        </li>
                        <li class="breadcrumb-item active"> Data Alternatif - {{$alternatif->nama_anggota}} 
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
                            <h4 class="card-title">Data Alteratif - {{ $alternatif->nama_anggota }}</h4>
                        </div>
                        <div class="col s6" style="text-align: right">
                            <a class="waves-effect waves-light btn modal-trigger btn-small btn gradient-45deg-blue-cyan box-shadow-none border-round mr-1 mb-1"
                                href="{{route('alternatif.index')}}"><i class="material-icons left">arrow_back</i>Kembali</a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12">
                            <div class="container">
                                <div class="section user-view">
                                    <div class="card">
                                        <div class="card-content">
                                            <div class="row">
                                                <div class="col s12 m6">
                                                    <table class="striped">
                                                        <tbody>
                                                            <tr>
                                                                <td>Tanggal Pinjaman</td>
                                                                <td>:</td>
                                                                <td>{{ $alternatif->created_at->format('d-m-Y') }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Nama Anggota</td>
                                                                <td>:</td>
                                                                <td>{{ $alternatif->nama_anggota }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Nomor Anggota</td>
                                                                <td>:</td>
                                                                <td>{{ $alternatif->no_anggota }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Tempat lahir</td>
                                                                <td>:</td>
                                                                <td>{{ $alternatif->tempat_lahir }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Tanggal Lahir</td>
                                                                <td>:</td>
                                                                <td>{{ \Carbon\Carbon::parse($alternatif->tanggal_lahir)->format('d-m-Y') }}</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="col s12 m6">
                                                    <table class="striped">
                                                        <tbody>
                                                            <tr>
                                                                <td>Alamat</td>
                                                                <td>:</td>
                                                                <td>{{ $alternatif->alamat }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Pekerjaan</td>
                                                                <td>:</td>
                                                                <td>{{ $pekerjaan->subkriteria->nama_subkriteria ?? '-' }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Besar Pinjaman</td>
                                                                <td>:</td>
                                                                <td>{{ "Rp " . number_format($alternatif->besar_pinjaman,2,',','.');  }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Keperluan</td>
                                                                <td>:</td>
                                                                <td>{{ $alternatif->keperluan }}</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @foreach ($alternatifSub as $item)
                                    @php
                                        $kriteria = \app\Models\MasterCriteria::find($item->subkriteria->kriteria_id);
                                    @endphp
                                    <div class="card-content">
                                        <h4 class="card-title">{{ $kriteria->nama_kriteria }}</h4>
                                        <div class="row">
                                            <div class="col s12">
                                            </div>
                                            <div class="col s12">
                                                <table class="highlight">
                                                    <thead>
                                                        <tr>
                                                            <th style="width: 450px">{{ $kriteria->nama_kriteria }}</th>
                                                            <th>Nilai</th>
                                                            <th>Keterangan</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>{{ $item->subkriteria->nama_subkriteria }}</td>
                                                            <td>{{ $item->subkriteria->nilai_subkriteria }}</td>
                                                            <td>{{ $item->subkriteria->keterangan_subkriteria }}</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
