@extends('layouts.app')

@section('content')
    <div id="breadcrumbs-wrapper" data-image="{{ asset('assets/images/gallery/breadcrumb-bg.jpg') }}">
        <!-- Search for small screen-->
        <div class="container">
            <div class="row">
                <div class="col s12 m6 l6">
                    <h5 class="breadcrumbs-title mt-0 mb-0"><span>Tambah Data Alternatif</span></h5>
                </div>
                <div class="col s12 m6 l6 right-align-md">
                    <ol class="breadcrumbs mb-0">
                        <li class="breadcrumb-item"><a href="/dashboard">Home</a>
                        </li>
                        <li class="breadcrumb-item"><a href="/alternatif">Data Alternatif</a>
                        </li>
                        <li class="breadcrumb-item active">Tambah Data Alternatif
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
                        {{-- <div class="col s6" style="margin-left: -12px">
                            <h4 class="card-title"><i class="material-icons left">add</i> Tambah Data Alternatif</h4>
                        </div> --}}

                    </div>
                    <div class="row">
                        <div class="col s12">
                            <form id="alternatif.store" action="{{ route('alternatif.store') }}" method="POST">
                                @csrf
                                <div class="modal-content">
                                    <h5><i class="material-icons left">add</i>Tambah Data Alternatif</h5>
                                    <br>
                                    <div class="row">
                                        <div class="col s6">
                                            <div class="input-field col s12">
                                                <input id="no_anggota" name="no_anggota" type="number" class="validate"
                                                    value="{{ old('no_anggota') }}" required>
                                                <label for="no_anggota">Nomor Anggota</label>
                                            </div>
                                            <div class="input-field col s12">
                                                <input id="nama_anggota" name="nama_anggota"
                                                    value="{{ old('nama_anggota') }}" type="text" class="validate"
                                                    required>
                                                <label for="nama_anggota">Nama Anggota</label>
                                            </div>
                                            <div class="input-field col s12">
                                                <input id="tempat_lahir" name="tempat_lahir"
                                                    value="{{ old('tempat_lahir') }}" type="text" class="validate"
                                                    required>
                                                <label for="tempat_lahir">Tempat Lahir</label>
                                            </div>
                                            <div class="input-field col s12">
                                                <input id="tanggal_lahir" name="tanggal_lahir"
                                                    value="{{ old('tanggal_lahir') }}" type="date"
                                                    class="validate" required>
                                                <label for="tanggal_lahir">Tanggal Lahir</label>
                                            </div>
                                           
                                            <div class="input-field col s12">
                                                <input id="alamat" name="alamat" value="{{ old('alamat') }}"
                                                    type="text" class="validate" required>
                                                <label for="alamat">Alamat</label>
                                            </div>
                                            <div class="input-field col s12">
                                                <input id="keperluan" name="keperluan" value="{{ old('keperluan') }}"
                                                    type="text" class="validate" required>
                                                <label for="keperluan">Keperluan</label>
                                            </div>
                                             <div class="input-field col s12">
                                                <input id="besar_pinjaman" name="besar_pinjaman"
                                                    value="{{ old('besar_pinjaman') }}" type="number"
                                                    class="validate" required>
                                                <label for="besar_pinjaman">Besar Pinjaman</label>
                                            </div>
                                        </div>
                                        <div class="col s6">
                                           

                                            {{-- <div class="col m6 s12">
                                            <h6 class="card-title">Basic Select2</h6>
                                            <p class="card-text">Use <code class="token function language-javascript">.select2</code>
                                                class for basic select2 control.</p>
                                            <div class="input-field">
                                                <select class="select2 browser-default">
                                                <option value="square">Square</option>
                                                <option value="rectangle">Rectangle</option>
                                                <option value="rombo">Rombo</option>
                                                <option value="romboid">Romboid</option>
                                                <option value="trapeze">Trapeze</option>
                                                <option value="traible">Triangle</option>
                                                <option value="polygon">Polygon</option>
                                                </select>
                                            </div>
                                            </div> --}}

                                            @foreach ($kriterias as $kriteria)
                                                {{-- <label></label> --}}
                                                <div class=" col s12">
                                                    <h6>{{ $kriteria->nama_kriteria }}</h6>
                                                    <div class="input-field">
                                                        <select id="mySelect{{ $kriteria->id }}" class="select2 browser-default" name="subkriteria_id[]"  required>
                                                            <option value="" disabled selected>-- Pilih Jenis Sub Kriteria --</option>
                                                            @foreach ($subkriterias[$kriteria->id] as $subkriteria)
                                                                <option value="{{ $subkriteria->id }}">{{ $subkriteria->nama_subkriteria }}</option>
                                                            @endforeach
                                                        </select>
                                                     </div>

                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer right mt-3">
                                    <a href="javascript:void(0);"
                                        class="modal-action modal-close waves-effect waves-light btn-small btn red darken-4"
                                        onclick="document.getElementById('alternatif.store').reset();"><i
                                            class="material-icons right">lock_reset</i>Reset</a>
                                    <a href="javascript:void(0);"
                                        class="modal-action modal-close waves-effect waves-light btn-small btn teal darken-4"
                                        onclick="document.getElementById('alternatif.store').submit();"><i
                                            class="material-icons right">send</i>Submit</a>
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
