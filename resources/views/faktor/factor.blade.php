@extends('layouts.app')

@section('content')
    <div id="breadcrumbs-wrapper" data-image="{{ asset('assets/images/gallery/breadcrumb-bg.jpg') }}">
        <!-- Search for small screen-->
        <div class="container">
            <div class="row">
                <div class="col s12 m6 l6">
                    <h5 class="breadcrumbs-title mt-0 mb-0"><span>Faktor</span></h5>
                </div>
                <div class="col s12 m6 l6 right-align-md">
                    <ol class="breadcrumbs mb-0">
                        <li class="breadcrumb-item"><a href="/dashboard">Home</a>
                        </li>
                        <li class="breadcrumb-item active">Faktor
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
                            <h4 class="card-title">Data Faktor</h4>
                        </div>
                        @if (Auth::user()->role_id == 1)
                            <div class="col s6" style="text-align: right">
                                <a class="waves-effect waves-light btn modal-trigger btn-small btn light-blue darken-3 box-shadow-none border-round mr-1 mb-1"
                                    href="#modal1"><i class="material-icons left">add</i>Tambah Data</a>
                            </div>
                        @endif
                    </div>
                    @if (Auth::user()->role_id == 1)
                        <form id="store.factor" class="col s12" method="POST" action="{{ route('faktor.store') }}">
                            @csrf
                            <div id="modal1" class="modal modal-fixed-footer">
                                <div class="modal-content">
                                    <h5><i class="material-icons left">add</i>Tambah Data Faktor</h5>
                                    <br>
                                    <div class="row">

                                        <div class="row">
                                            <div class="input-field col s12">
                                                <input id="nama_faktor" name="nama_faktor" type="text" class="validate"
                                                    value="{{ old('nama_faktor') }}" required>
                                                <label for="nama_faktor">Nama Faktor</label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="input-field col s12">
                                                <input id="bobot_faktor" name="bobot_faktor" type="number" class="validate"
                                                    value="{{ old('bobot_faktor') }}" required>
                                                <label for="bobot_faktor">Bobot(Presentase)</label>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <a href="javascript:void(0);"
                                        class="modal-action modal-close waves-effect waves-light btn-small btn red darken-4"
                                        onclick="document.getElementById('store.factor').reset();"><i
                                            class="material-icons right">cancel</i>Cancel</a>
                                    <a href="javascript:void(0);"
                                        class="modal-action modal-close waves-effect waves-light btn-small btn teal darken-4"
                                        onclick="document.getElementById('store.factor').submit();"><i
                                            class="material-icons right">send</i>Submit</a>
                                </div>
                            </div>
                        </form>
                    @endif
                    <div class="row">
                        <div class="col s12">
                            <table id="faktor" class="display dataTable">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Faktor</th>
                                        <th style="width: 200px;">Bobot (Presentase)</th>
                                        @if (Auth::user()->role_id == 1)
                                            <th style="width: 200px;">Aksi</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($factors as $factor => $item)
                                        <tr>
                                            <td>{{ $factor + 1 }}</td>
                                            <td>{{ $item->nama_faktor }}</td>
                                            <td>{{ $item->bobot_faktor }}%</td>
                                            @if (Auth::user()->role_id == 1)
                                                <td>
                                                    <a class="waves-effect waves-light btn btn-small teal darken-4 box-shadow-none border-round mr-1 mb-1 modal-trigger"
                                                        href="{{ route('faktor.edit', $item->id) }}"><i
                                                            class="material-icons">edit</i></a>

                                                    <form id="faktor.destroy{{ $item->id }}"
                                                        action="{{ route('faktor.destroy', $item->id) }}" method="POST"
                                                        style="display: none;">
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
        $('#faktor').DataTable();
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
                    document.getElementById('faktor.destroy' + itemId).submit();
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
