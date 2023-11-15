@extends('layouts.app')

@section('content')
    <div id="breadcrumbs-wrapper" data-image="{{ asset('assets/images/gallery/breadcrumb-bg.jpg') }}">
        <!-- Search for small screen-->
        <div class="container">
            <div class="row">
                <div class="col s12 m6 l6">
                    <h5 class="breadcrumbs-title mt-0 mb-0"><span>Edit Sub Kriteria</span></h5>
                </div>
                <div class="col s12 m6 l6 right-align-md">
                    <ol class="breadcrumbs mb-0">
                        <li class="breadcrumb-item"><a href="/dashboard">Home</a>
                        </li>
                        <li class="breadcrumb-item"><a href="/subkriteria">Sub Kriteria</a>
                        </li>
                        <li class="breadcrumb-item active">Edit Sub Kriteria
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
                            <h4 class="card-title">Data Sub Kriteria</h4>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col s12">
                            <form action="{{ route('subkriteria.update', $subkriteria->id) }}" method="POST">
                                @csrf
                                @method('put')
                                <div class="row">
                                    <div class="input-field col s12">
                                        <select name="kriteria_id" id="kriteria_id" required>
                                            @foreach ($kriterias as $kriteria)
                                                <option value="{{ $kriteria->id }}"
                                                    {{ $kriteria->kriteria_id == $kriteria->id ? 'selected' : '' }}>{{ $kriteria->nama_kriteria }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <label for="kriteria_id">Jenis Kriteria</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s12">
                                        <input id="nama_subkriteria" name="nama_subkriteria" class="validate"
                                            value="{{ $subkriteria->nama_subkriteria }}" type="text" required>
                                        <label for="nama_subkriteria">Nama Sub Kriteria</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s12">
                                        <select name="nilai_subkriteria" id="nilai_subkriteria" required>
                                            <option value="1"
                                                {{ $subkriteria->nilai_subkriteria == 1 ? 'selected' : '' }}>1 - Kurang
                                            </option>
                                            <option value="2"
                                                {{ $subkriteria->nilai_subkriteria == 2 ? 'selected' : '' }}>2 - Cukup
                                            </option>
                                            <option value="3"
                                                {{ $subkriteria->nilai_subkriteria == 3 ? 'selected' : '' }}>3 - Cukup Baik
                                            </option>
                                            <option value="4"
                                                {{ $subkriteria->nilai_subkriteria == 4 ? 'selected' : '' }}>4 - Baik
                                            </option>
                                            <option value="5"
                                                {{ $subkriteria->nilai_subkriteria == 5 ? 'selected' : '' }}>5 - Sangat Baik
                                            </option>
                                        </select>
                                        <label for="faktor_id">Nilai Sub Kriteria</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s12">
                                        <button class="waves-effect waves-light btn btn-small teal darken-4 right" type="submit"
                                            name="action">Simpan Perubahan
                                            <i class="material-icons right">save</i>
                                        </button>
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
