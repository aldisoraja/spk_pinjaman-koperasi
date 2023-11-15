@extends('layouts.app')

@section('content')
    <div id="breadcrumbs-wrapper" data-image="{{ asset('assets/images/gallery/breadcrumb-bg.jpg') }}">
        <!-- Search for small screen-->
        <div class="container">
            <div class="row">
                <div class="col s12 m6 l6">
                    <h5 class="breadcrumbs-title mt-0 mb-0"><span>Edit Data Nilai GAP</span></h5>
                </div>
                <div class="col s12 m6 l6 right-align-md">
                    <ol class="breadcrumbs mb-0">
                        <li class="breadcrumb-item"><a href="/dashboard">Home</a>
                        </li>
                        <li class="breadcrumb-item"><a href="/bobot-nilai-gap">Data Nilai GAP</a>
                        </li>
                        <li class="breadcrumb-item active">Edit Data Nilai GAP
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
                            <h4 class="card-title"><i class="material-icons left">edit</i>Edit Data Nilai Gap</h4>
                        </div>
                        
                    </div>
                    <div class="row">
                        <div class="col s12">
                            <form action="{{route('bobot-nilai-gap-update', $gapValue->id)}}" method="POST">
                                @csrf
                                <div class="row">
                                  <div class="input-field col s12">
                                    <input type="number" id="selisih" name="selisih" required class="validate" value="{{$gapValue->nilai_gap}}" class="validate" required>
                                    <label for="selisih">Selisih</label>
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="input-field col s12">
                                    <input id="bobot_nilai" name="bobot_nilai" required class="validate" value="{{$gapValue->bobot_nilai_kriteria}}" type="text" required>
                                    <label for="bobot_nilai">Bobot Nilai</label>
                                  </div>
                                </div>

                                <div class="row">
                                  <div class="input-field col s12">
                                    <input id="keterangan" name="keterangan" class="validate" value="{{$gapValue->keterangan}}" type="text" required>
                                    <label for="keterangan">Keterangan </label>
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
