@extends('layouts.app')

@section('content')
    <div id="breadcrumbs-wrapper" data-image="{{ asset('assets/images/gallery/breadcrumb-bg.jpg') }}">
        <!-- Search for small screen-->
        <div class="container">
            <div class="row">
                <div class="col s12 m6 l6">
                    <h5 class="breadcrumbs-title mt-0 mb-0"><span>Bobot Nilai GAP</span></h5>
                </div>
                <div class="col s12 m6 l6 right-align-md">
                    <ol class="breadcrumbs mb-0">
                        <li class="breadcrumb-item"><a href="/dashboard">Home</a>
                        </li>
                        <li class="breadcrumb-item active">Bobot Nilai GAP
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
                            <h4 class="card-title">Data Nilai GAP</h4>
                        </div>
                        @if (Auth::user()->role_id == 1)
                            <div class="col s6" style="text-align: right">
                                <a class="waves-effect waves-light btn modal-trigger btn-small btn light-blue darken-3 box-shadow-none border-round mr-1 mb-1"
                                    href="#modal1"><i class="material-icons left">add</i>Tambah Data</a>
                            </div>
                        @endif
                    </div>
                    @if (Auth::user()->role_id == 1)
                        <div id="modal1" class="modal modal-fixed-footer">
                            <div class="modal-content">
                                <h5><i class="material-icons left">add</i>Tambah Data Nilai GAP</h5>
                                <br>
                                <div class="row">
                                    <form id="form-gap" class="col s12" action="{{ route('bobot-nilai-gap-store') }}"
                                        method="post">
                                        @csrf
                                        <div class="row">
                                            <div class="input-field col s12">
                                                <input id="selisih" type="number" value="{{ old('selisih') }}"
                                                    name="selisih" class="validate" required>
                                                <label for="selisih">Selisih</label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="input-field col s12">
                                                <input id="bobot_nilai" type="number" name="bobot_nilai"
                                                    value="{{ old('bobot_nilai') }}" class="validate">
                                                <label for="bobot_nilai">Bobot Nilai</label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="input-field col s12">
                                                <input id="keterangan" type="text" name="keterangan"
                                                    value="{{ old('keterangan') }}" class="validate">
                                                <label for="keterangan">Keterangan</label>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <a href="javascript:void(0);"
                                    class="modal-action modal-close waves-effect waves-light btn-small btn red darken-4"
                                    onclick="document.getElementById('form-gap').reset();"><i
                                        class="material-icons right">cancel</i>Cancel</a>
                                <a href="javascript:void(0);"
                                    class="modal-action modal-close waves-effect waves-light btn-small btn teal darken-4"
                                    onclick="document.getElementById('form-gap').submit();"><i
                                        class="material-icons right">send</i>Submit</a>
                            </div>
                        </div>
                    @endif
                    <div class="row">
                        <div class="col s12">
                            <table id="data-gap" class="display">
                                <thead>
                                    <tr>
                                        <th class="center-align">No</th>
                                        <th class="center-align">Selisih</th>
                                        <th class="center-align">Bobot Nilai</th>
                                        <th>Keterangan</th>
                                        @if (Auth::user()->role_id == 1)
                                            <th class="center-align" style="width: 200px;">Aksi</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($nilaiGap as $item)
                                        <tr>
                                            <td class="center-align">{{ $loop->iteration }}</td>
                                            <td class="center-align">{{ $item->nilai_gap }}</td>
                                            <td class="center-align">{{ $item->bobot_nilai_kriteria }}</td>
                                            <td>{{ $item->keterangan }}</td>
                                            @if (Auth::user()->role_id == 1)
                                                <td class="center-align">
                                                    <a class="waves-effect waves-light btn btn-small teal darken-4 box-shadow-none border-round mr-1 mb-1"
                                                        href="{{ route('bobot-nilai-gap-edit', $item->id) }}"><i
                                                            class="material-icons">edit</i></a>

                                                    <form style="display: none;" id="gap-delete{{ $item->id }}"
                                                        method="POST"
                                                        action="{{ route('bobot-nilai-gap-delete', $item->id) }}">
                                                        @csrf
                                                        @method('delete')

                                                    </form>
                                                    <a class="wave☻s-effect waves-light btn-small btn red darken-4 box-shadow-none border-round mr-1 mb-1"
                                                    onclick="confirmDelete({{ $item->id }})"><i
                                                            class="material-icons">delete</i></a>

                                                </td>
                                            @endif
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
        $('#data-gap').DataTable();
    </script>
     <script>
        function confirmDelete(itemId) {
            Swal.fire({
                title: 'Konfirmasi',
                text: 'Apakah Anda yakin ingin menghapus data ini?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, Hapus',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('gap-delete' + itemId).submit();
                }
            });
        }
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
