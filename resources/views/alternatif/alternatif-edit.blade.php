@extends('layouts.app')

@section('content')
    <div id="breadcrumbs-wrapper" data-image="{{ asset('assets/images/gallery/breadcrumb-bg.jpg') }}">
        <!-- Search for small screen-->
        <div class="container">
            <div class="row">
                <div class="col s12 m6 l6">
                    <h5 class="breadcrumbs-title mt-0 mb-0"><span>Edit Data Alternatif</span></h5>
                </div>
                <div class="col s12 m6 l6 right-align-md">
                    <ol class="breadcrumbs mb-0">
                        <li class="breadcrumb-item"><a href="/dashboard">Home</a>
                        </li>
                        <li class="breadcrumb-item"><a href="/alternatif">Data Alternatif</a>
                        </li>
                        <li class="breadcrumb-item active">Edit Data Alternatif
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
                            <h4 class="card-title"><i class="material-icons left">edit</i> Edit Data Alternatif</h4>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col s12">
                            <form action="{{ route('alternatif.update', $alternatif->id) }}" method="POST">
                                @csrf
                                @method('put')
                                <div class="container">
                                    <div class="row">
                                        <div class="col s6">
                                            <div class="input-field col s12">
                                                <input id="no_anggota" name="no_anggota" type="text" class="validate"
                                                    value="{{ $alternatif->no_anggota }}" required>
                                                <label for="no_anggota">Nomor Anggota</label>
                                            </div>
                                            <div class="input-field col s12">
                                                <input id="nama_anggota" name="nama_anggota"
                                                    value="{{ $alternatif->nama_anggota }}" type="text" class="validate"
                                                    required>
                                                <label for="nama_anggota">Nama Anggota</label>
                                            </div>
                                            <div class="input-field col s12">
                                                <input id="tempat_lahir" name="tempat_lahir"
                                                    value="{{ $alternatif->tempat_lahir }}" type="text" class="validate"
                                                    required>
                                                <label for="tempat_lahir">Tempat Lahir</label>
                                            </div>
                                            <div class="input-field col s12">
                                                <input id="tanggal_lahir" name="tanggal_lahir"
                                                    value="{{ $alternatif->tanggal_lahir }}" type="date" class="validate"
                                                    required>
                                                <label for="tanggal_lahir">Tanggal Lahir</label>
                                            </div>
                                            {{-- <div class="input-field col s12">
                                                <input id="pekerjaan" name="pekerjaan" value="{{ $alternatif->pekerjaan }}"
                                                    type="text" class="validate" required>
                                                <label for="pekerjaan">Pekerjaan</label>
                                            </div>
                                            <div class="input-field col s12">
                                                <input id="penghasilan" name="penghasilan"
                                                    value="{{ $alternatif->penghasilan }}" type="number" class="validate"
                                                    required>
                                                <label for="penghasilan">Penghasilan</label>
                                            </div> --}}
                                            <div class="input-field col s12">
                                                <input id="alamat" name="alamat" value="{{ $alternatif->alamat }}"
                                                    type="text" class="validate" required>
                                                <label for="alamat">Alamat</label>
                                            </div>
                                            <div class="input-field col s12">
                                                <input id="keperluan" name="keperluan" value="{{ $alternatif->keperluan }}"
                                                    type="text" class="validate" required>
                                                <label for="keperluan">Keperluan</label>
                                            </div>
                                            <div class="input-field col s12">
                                                <input id="besar_pinjaman" name="besar_pinjaman"
                                                    value="{{ $alternatif->besar_pinjaman }}" type="text" class="validate"
                                                    required>
                                                <label for="besar_pinjaman">Besar Pinjaman</label>
                                            </div>
                                        </div>
                                        <div class="col s6">
                                            
                                                @foreach ($kriterias as $kriteria)
                                                    <div class="col s12">
                                                        <h6>{{ $kriteria->nama_kriteria }}</h6>
                                                        <div class="input-field ">
                                                            @php
                                                                $sub_kriteria_id = $alternatifSubKriteria->where('kriteria_id', $kriteria->id)->first();
                                                            @endphp
                                                            <select id="mySelect{{ $kriteria->id }}" class="select2 browser-default" name="subkriteria_id[]" id="subkriteria_id[]"
                                                                required>
            
                                                                @if (isset($sub_kriteria_id))
                                                                    @foreach ($subkriterias[$kriteria->id] as $subkriteria)
                                                                        <option value="{{ $subkriteria->id }}"
                                                                            {{ $subkriteria->id == $sub_kriteria_id->id ? 'selected' : '' }}>{{ $subkriteria->nama_subkriteria }}</option>
                                                                    @endforeach
                                                                @else
                                                                    <option value="" disabled selected>-- Pilih Jenis Sub Kriteria --</option>
                                                                    @foreach ($subkriterias[$kriteria->id] as $subkriteria)
                                                                        <option value="{{ $subkriteria->id }}">{{ $subkriteria->nama_subkriteria }}</option>
                                                                    @endforeach
                                                                @endif
            
                                                            </select>
                                                            {{-- <label>{{ $kriteria->nama_kriteria }}</label> --}}
                                                        </div>
                                                    </div>
                                                @endforeach
            
                                                <div class="row">
                                                    <div class="input-field col s12">
                                                        <button class="btn teal darken-4 waves-effect waves-light right" type="submit"
                                                            name="action">Simpan Perubahan
                                                            <i class="material-icons right">save</i>
                                                        </button>
                                                    </div>
                                                </div>

                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
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
