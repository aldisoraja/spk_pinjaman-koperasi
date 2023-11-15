@extends('layouts.app')

@section('content')
    <div id="breadcrumbs-wrapper" data-image="{{ asset('assets/images/gallery/breadcrumb-bg.jpg') }}">
        <!-- Search for small screen-->
        <div class="container">
            <div class="row">
                <div class="col s12 m6 l6">
                    <h5 class="breadcrumbs-title mt-0 mb-0"><span>Edit Nilai Ideal</span></h5>
                </div>
                <div class="col s12 m6 l6 right-align-md">
                    <ol class="breadcrumbs mb-0">
                        <li class="breadcrumb-item"><a href="/dashboard">Home</a>
                        </li>
                        <li class="breadcrumb-item"><a href="/nilai-ideal">Nilai Ideal</a>
                        </li>
                        <li class="breadcrumb-item active">Edit Nilai Ideal
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
                            <h4 class="card-title"><i class="material-icons left">edit</i>Edit Data Nilai Ideal</h4>
                        </div>
                        
                    </div>
                    <div class="row">
                        <div class="col s12">
                            <form action="{{route('nilai-ideal-update', $nilaiIdeal->id)}}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="input-field col s12">
                                        <select name="kriteria" id="kriteria" disabled required>
                                            @foreach ($kriterias as $kriteria)
                                                <option value="{{ $kriteria->id }}" {{ $nilaiIdeal->kriteria_id == $kriteria->id ? 'selected' : ''}}>{{ $kriteria->nama_kriteria }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <label> Kriteria (disabled)</label>
                                    </div>
                                </div>
                                <div class="row">
                                  <div class="input-field col s12">
                                    <select name="nilai_ideal"id="nilai_ideal" required>
                                        <option value="" disabled selected>-- Pilih Nilai Ideal--
                                        </option>
                                        @foreach($valueNilai as $item)
                                            <option value="{{ $item }}" {{ $item == $nilaiIdeal->nilai_ideal? 'selected' : '' }}>{{ $item }}</option>
                                        @endforeach
                                    </select>
                                    {{-- <input id="nilai_ideal" name="nilai_ideal" required class="validate" value="{{$nilaiIdeal->nilai_ideal}}" type="text" required> --}}
                                    <label for="nilai_ideal">Nilai Ideal</label>
                                  </div>
                                </div>

                                {{-- <div class="row">
                                  <div class="input-field col s12">
                                    <input id="keterangan" name="keterangan" class="validate" value="{{$nilaiIdeal->keterangan}}" type="text" required>
                                    <label for="keterangan">Keterangan </label>
                                  </div>
                                </div> --}}
                                
                                <div class="row">
                                    <div class="input-field col s12">
                                      <button class="waves-effect waves-light btn btn-small teal darken-4 right" type="submit" name="action">Simpan Perubahan
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
