@extends('layouts.app')

@section('content')
    <div class="row">
        <div id="breadcrumbs-wrapper" data-image="{{ asset('assets/images/gallery/breadcrumb-bg.jpg') }}">
            <!-- Search for small screen-->
            <div class="container">
                <div class="row">
                    <div class="col s12 m6 l6">
                        <h5 class="breadcrumbs-title mt-0 mb-0"><span>Perhitungan</span></h5>
                    </div>
                    <div class="col s12 m6 l6 right-align-md">
                        <ol class="breadcrumbs mb-0">
                            <li class="breadcrumb-item"><a href="/pengurus/dashboard">Home</a>
                            </li>
                            <li class="breadcrumb-item active">Perhitungan
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col s12 m12">
                <div class="card">
                    <div class="card-content black-text">
                        <span class="card-title">Perhitungan Profile Matching</span>
                        <br>
                        <form action="{{ route('proses-hitung') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="input-field col s12">
                                    <input id="jumlah" type="number" name="jumlah_anggaran" class="validate">
                                    <label for="jumlah">Masukkan Jumlah Anggaran</label>
                                </div>
                            </div>
                            <div style="text-align: center">
                                <button type="submit" id="btnSubmit" class="waves-effect waves-light btn teal darken-4"><i
                                        class="material-icons left">calculate</i>Hitung</button>
                                <button type="reset" class="waves-effect waves-light btn red darken-4"><i
                                        class="material-icons left">restart_alt</i>Reset</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection

    @push('scripts')

        <script>
            $( document ).ready(function() 
            {
                var countAlternatif = {{ $countAlternatif }};
                if (countAlternatif <= 0)
                {
                     Swal.fire({
                    icon: 'info',
                    title: 'Info !!',
                    text: 'Harap pilih atau checklist alternatif terlebih dahulu',
                    })
                    
                    $('#btnSubmit').prop('disabled',true);
                }
                else
                {
                    $('#btnSubmit').prop('disabled',false);

                }
             });
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
