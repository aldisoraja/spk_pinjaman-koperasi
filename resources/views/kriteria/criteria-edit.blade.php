@extends('layouts.app')

@section('content')
    <div id="breadcrumbs-wrapper" data-image="{{ asset('assets/images/gallery/breadcrumb-bg.jpg') }}">
        <!-- Search for small screen-->
        <div class="container">
            <div class="row">
                <div class="col s12 m6 l6">
                    <h5 class="breadcrumbs-title mt-0 mb-0"><span>Edit Kriteria</span></h5>
                </div>
                <div class="col s12 m6 l6 right-align-md">
                    <ol class="breadcrumbs mb-0">
                        <li class="breadcrumb-item"><a href="/dashboard">Home</a>
                        </li>
                        <li class="breadcrumb-item"><a href="/criteria">Kriteria</a>
                        </li>
                        <li class="breadcrumb-item active">Edit Kriteria
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
                            <h4 class="card-title"><i class="material-icons left">edit</i> Edit Kriteria</h4>
                        </div>
                        
                    </div>
                    <div class="row">
                        <div class="col s12">
                            <form action="{{route('criteria.update', $kriteria->id)}}" method="POST">
                                @csrf
                                @method('put')
                                <div class="row">
                                  <div class="input-field col s12">
                                    <input type="text" id="disabled" name="kode_kriteria" class="validate" disabled value="{{$kriteria->kode_kriteria}}" class="validate" required>
                                    <label for="disabled">Kode Kriteria (disable) </label>
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="input-field col s12">
                                    <input id="nama_kriteria" name="nama_kriteria" class="validate" value="{{$kriteria->nama_kriteria}}" type="text" required>
                                    <label for="nama_kriteria">Nama Kriteria</label>
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="input-field col s12">
                                    <select name="faktor_id" id="faktor_id" required>
                                      
                                        @foreach ($factors as $faktor)
                                            <option value="{{ $faktor->id }}" {{ $kriteria->faktor_id == $faktor->id ? 'selected' : '' }}>{{ $faktor->nama_faktor }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <label for="faktor_id">Jenis Faktor</label>
                                  </div>
                                </div>
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
