@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col s12">
            <div class="container">
                <div class="section">
                    <!--card stats start-->
                    <div id="card-stats" class="pt-0">
                        <div class="row">
                            <div class="col s12 m6 l6 xl3">
                                <div
                                    class="card gradient-45deg-light-blue-cyan gradient-shadow min-height-100 white-text animate fadeLeft">
                                    <div class="padding-4">
                                        <div class="row">
                                            <div class="col s7 m7">
                                                <i class="material-icons background-round mt-5">manage_accounts</i>
                                                <p>User</p>
                                            </div>
                                            <div class="col s5 m5 right-align">
                                                <h5 class="mb-0 white-text">Total</h5>
                                                <p class="no-margin">{{ $countUser }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col s12 m6 l6 xl3">
                                <div
                                    class="card gradient-45deg-red-pink gradient-shadow min-height-100 white-text animate fadeLeft">
                                    <div class="padding-4">
                                        <div class="row">
                                            <div class="col s7 m7">
                                                <i class="material-icons background-round mt-5">storage</i>
                                                <p>Kriteria</p>
                                            </div>
                                            <div class="col s5 m5 right-align">
                                                <h5 class="mb-0 white-text">Total</h5>
                                                <p class="no-margin">{{ $countKriteria }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col s12 m6 l6 xl3">
                                <div
                                    class="card gradient-45deg-amber-amber gradient-shadow min-height-100 white-text animate fadeRight">
                                    <div class="padding-4">
                                        <div class="row">
                                            <div class="col s7 m7">
                                                <i class="material-icons background-round mt-5">cloud</i>
                                                <p>Sub Kriteria</p>
                                            </div>
                                            <div class="col s5 m5 right-align">
                                                <h5 class="mb-0 white-text">Total</h5>
                                                <p class="no-margin">{{ $countsubKriteria }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col s12 m6 l6 xl3">
                                <div
                                    class="card gradient-45deg-green-teal gradient-shadow min-height-100 white-text animate fadeRight">
                                    <div class="padding-4">
                                        <div class="row">
                                            <div class="col s6 m6">
                                                <i class="material-icons background-round mt-5">people</i>
                                                <p>Alternatif</p>
                                            </div>
                                            <div class="col s6 m6 right-align">
                                                <h5 class="mb-0 white-text">Total</h5>
                                                <p class="no-margin">{{ $countAlternatif }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col s12 m6">
                                    <div class="card">
                                        <div class="card-image">
                                            <img src="{{ asset('assets/images/gallery/49.jpg') }}">
                                            <span class="card-title">Metode Profile Matching</span>
                                            <a class="btn-floating halfway-fab waves-effect waves-light red"><i
                                                    class="material-icons">add</i></a>
                                        </div>
                                        <div class="card-content">
                                            <p style="text-align:justify">
                                                Konsep metode profile matching adalah membandingkan antara kompetensi
                                                individu dengan kompetensi yang dimiliki kandidat calon penerima
                                                pinjaman.
                                                Diketahui perbedaan kompetensi atau gapnya, semakin kecil gap yang
                                                dihasilkan maka semakin besar peluang calon untuk menerima pinjaman
                                                tersebut.
                                                Gap merupakan sebuah perbedaan antara kriteria yang dimiliki oleh
                                                masing-masing alternatif dengan kriteria yang diinginkan.
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col s12 m6">
                                    <div class="card">
                                        <div class="card-image">
                                            <img src="{{ asset('assets/images/gallery/46.jpg') }}">
                                            <span class="card-title">Sistem Pendukung Keputusan Pemberian Pinjaman
                                                Koperasi Menggunakan Metode Profile Matching</span>
                                            <a class="btn-floating halfway-fab waves-effect waves-light red"><i
                                                    class="material-icons">add</i></a>
                                        </div>
                                        <div class="card-content">
                                            <p style="text-align:justify">
                                                Sistem pendukung keputusan pemberian pinjaman non paket merupakan sistem
                                                SPK yang dapat memudahkan pengurus koperasi
                                                dalam memilih dan melakukan proses seleksi pemberian pinjaman sesuai
                                                dengan aturan yang telah ditetapkan.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
            text: 'Data gagal disimpan',
        })
    </script>
    @endif
@endpush
