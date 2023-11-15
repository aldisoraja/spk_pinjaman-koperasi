@extends('layouts.app')

@section('content')
    <div id="breadcrumbs-wrapper" data-image="{{ asset('assets/images/gallery/breadcrumb-bg.jpg') }}">
        <!-- Search for small screen-->
        <div class="container">
            <div class="row">
                <div class="col s12 m6 l6">
                    <h5 class="breadcrumbs-title mt-0 mb-0"><span>Kriteria</span></h5>
                </div>
                <div class="col s12 m6 l6 right-align-md">
                    <ol class="breadcrumbs mb-0">
                        <li class="breadcrumb-item"><a href="/dashboard">Home</a>
                        </li>
                        <li class="breadcrumb-item active">Kriteria
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
                            <h4 class="card-title">Menentukan Bobot Core Factor dan Secondary Factor</h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12">
                            <div class="responsive-table">
                                <table id="faktor" class="display dataTable">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Faktor</th>
                                            <th style="width: 200px;">Bobot (Presentase)</th>
                                            @if (Auth::user()->role_id == 1)
                                                <th class="center-align" style="width: 200px;">Aksi</th>
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
                                                    <td class="center-align">
                                                        <a class="waves-effect waves-light btn btn-small teal darken-4 box-shadow-none border-round mr-1 mb-1 modal-trigger"
                                                            href="{{ route('faktor.edit', $item->id) }}"><i
                                                                class="material-icons">edit</i></a>
                                                    </td>
                                                @endif
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <h6><b>Catatan : Untuk mencapai validasi bobot faktor harus 100%.</b></h6>
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
                            <h4 class="card-title">Data Kriteria</h4>
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
                            <form id="kriteria.store" action="{{ route('criteria.store') }}" method="POST">
                                @csrf
                                <div class="modal-content">
                                    <h5><i class="material-icons left">add</i>Tambah Data Kriteria</h5>
                                    <br>
                                    <div class="row">
                                        <div class="col s12">
                                            <form>
                                                <div class="row">
                                                    <div class="input-field col s12">
                                                        <input id="kode_kriteria" name="kode_kriteria" type="text"
                                                            class="validate" value="{{ old('kode_kriteria') }}" required>
                                                        <label for="kode_kriteria">Kode Kriteria</label>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="input-field col s12">
                                                        <input id="nama_kriteria" name="nama_kriteria"
                                                            value="{{ old('nama_kriteria') }}" type="text" class="validate"
                                                            required>
                                                        <label for="nama_kriteria">Nama Kriteria</label>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="input-field col s12">
                                                        <select name="faktor_id" id="faktor_id" required>
                                                            <option value="" disabled selected>-- Pilih Jenis Kriteria --
                                                            </option>
                                                            @foreach ($factors as $faktor)
                                                                <option value="{{ $faktor->id }}">{{ $faktor->nama_faktor }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        <label>Jenis Kriteria</label>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <a href="javascript:void(0);"
                                        class="modal-action modal-close waves-effect waves-light btn-small btn red darken-4"
                                        onclick="document.getElementById('kriteria.store').reset();"><i
                                            class="material-icons right">cancel</i>Cancel</a>
                                    <a href="javascript:void(0);"
                                        class="modal-action modal-close waves-effect waves-light btn-small btn teal darken-4"
                                        onclick="document.getElementById('kriteria.store').submit();"><i
                                            class="material-icons right">send</i>Submit</a>
                                </div>
                            </form>
                        </div>
                    @endif
                    <div class="row">
                        <div class="col s12">
                            <div class="responsive-table">
                                <table id="kriteria" class="display dataTable">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th style="width: 150px;">Kode Kriteria</th>
                                            <th>Nama Kriteria</th>
                                            <th style="width: 200px;">Jenis</th>
                                            @if (Auth::user()->role_id == 1)
                                                <th class="center-align" style="width: 200px;">Aksi</th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($kriterias as $num => $kriteria)
                                            <tr>
                                                <td>{{ $num + 1 }}</td>
                                                <td>{{ $kriteria->kode_kriteria }}</td>
                                                <td>{{ $kriteria->nama_kriteria }}</td>
                                                <td>{{ $kriteria->faktor->nama_faktor }}</td>
                                                @if (Auth::user()->role_id == 1)
                                                    <td class="center-align">
                                                        <a class="waves-effect waves-light btn btn-small teal darken-4 box-shadow-none border-round mr-1 mb-1"
                                                            href="{{ route('criteria.edit', $kriteria->id) }}"><i
                                                                class="material-icons">edit</i></a>

                                                        <form id="criteria.destroy{{ $kriteria->id }}"
                                                            action="{{ route('criteria.destroy', $kriteria->id) }}"
                                                            method="POST" style="display: none;">
                                                            @csrf
                                                            @method('delete')
                                                        </form>
                                                        <a class="wave☻s-effect waves-light btn-small btn red darken-4 box-shadow-none border-round mr-1 mb-1"
                                                            onclick="confirmDelete({{ $kriteria->id }})"><i
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
    </div>
@endsection

@push('scripts')
    <script>
      
        $('#faktor').DataTable();
        $('#kriteria').DataTable();
    </script>
    <script>
        function confirmDelete(kriteriaId) {
            Swal.fire({
                title: 'Konfirmasi',
                text: 'Apakah Anda yakin ingin menghapus data ini?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, Hapus',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('criteria.destroy' + kriteriaId).submit();
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
