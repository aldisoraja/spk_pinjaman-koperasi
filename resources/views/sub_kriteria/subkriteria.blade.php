@extends('layouts.app')

@section('content')
    <div id="breadcrumbs-wrapper" data-image="{{ asset('assets/images/gallery/breadcrumb-bg.jpg') }}">
        <!-- Search for small screen-->
        <div class="container">
            <div class="row">
                <div class="col s12 m6 l6">
                    <h5 class="breadcrumbs-title mt-0 mb-0"><span>Sub Kriteria</span></h5>
                </div>
                <div class="col s12 m6 l6 right-align-md">
                    <ol class="breadcrumbs mb-0">
                        <li class="breadcrumb-item"><a href="/dashboard">Home</a>
                        </li>
                        <li class="breadcrumb-item active">Sub Kriteria
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
                        @if (Auth::user()->role_id == 1)
                            <div class="col s6" style="text-align: right">
                                <a class="waves-effect waves-light btn modal-trigger btn-small btn light-blue darken-3 box-shadow-none border-round mr-1 mb-1"
                                    href="#modal1"><i class="material-icons left">add</i>Tambah Data</a>
                            </div>
                        @endif
                    </div>
                    @if (Auth::user()->role_id == 1)
                        <div id="modal1" class="modal modal-fixed-footer">
                            <form id="subkriteria.store" action="{{ route('subkriteria.store') }}" method="POST">
                                @csrf
                                <div class="modal-content">
                                    <h5><i class="material-icons left">add</i>Tambah Data Sub Kriteria</h5>
                                    <br>
                                    <div class="row">
                                        <div class="col s12">
                                            <div class="row">
                                                <div class="input-field col s12">
                                                    <select id="kriteria_id" name="kriteria_id" required>
                                                        <option value="" disabled selected>-- Pilih Jenis Kriteria --
                                                        </option>
                                                        @foreach ($kriterias as $kriteria)
                                                            <option value="{{ $kriteria->id }}">{{ $kriteria->nama_kriteria }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    <label>Kriteria</label>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="input-field col s12">
                                                    <input id="nama_subkriteria" name="nama_subkriteria" type="text"
                                                        class="validate" value="{{ old('nama_subkriteria') }}" required>
                                                    <label for="nama_subkriteria">Nama Sub Kriteria</label>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="input-field col s12">
                                                    <select id="nilai_subkriteria" name="nilai_subkriteria" required>
                                                        <option value="#" disabled selected>-- Pilih Nilai --</option>
                                                        <option value="1">1 - Kurang</option>
                                                        <option value="2">2 - Cukup</option>
                                                        <option value="3">3 - Cukup Baik</option>
                                                        <option value="4">4 - Baik</option>
                                                        <option value="5">5 - Sangat Baik</option>
                                                    </select>
                                                    <label>Nilai Sub Kriteria</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <a href="javascript:void(0);"
                                        class="modal-action modal-close waves-effect waves-light btn-small btn red darken-4"
                                        onclick="document.getElementById('subkriteria.store').reset();"><i
                                            class="material-icons right">cancel</i>Cancel</a>
                                    <a href="javascript:void(0);"
                                        class="modal-action modal-close waves-effect waves-light btn-small btn teal darken-4"
                                        onclick="document.getElementById('subkriteria.store').submit();"><i
                                            class="material-icons right">send</i>Submit</a>
                                </div>
                            </form>
                        </div>
                    @endif
                    <div class="row">
                        <div class="col s12">
                            <table id="subkriteria" class="display dataTable">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Kriteria</th>
                                        <th>Nama Sub Kriteria</th>
                                        <th>Nilai</th>
                                        <th>Keterangan</th>
                                        @if (Auth::user()->role_id == 1)
                                            <th class="center-align">Aksi</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($subkriterias as $num => $subkriteria)
                                        <tr>
                                            <td>{{ $num + 1 }}</td>
                                            <td>{{ $subkriteria->kriteria->nama_kriteria }}</td>
                                            <td>{{ $subkriteria->nama_subkriteria }}</td>
                                            <td>{{ $subkriteria->nilai_subkriteria }}</td>
                                            <td>{{ $subkriteria->keterangan_subkriteria }}</td>
                                            @if (Auth::user()->role_id == 1)
                                                <td class="center-align">
                                                    <a class="waves-effect waves-light btn btn-small teal darken-4 box-shadow-none border-round mr-1 mb-1"
                                                        href="{{ route('subkriteria.edit', $subkriteria->id) }}"><i
                                                            class="material-icons">edit</i></a>

                                                    <form id="subkriteria.destroy{{ $subkriteria->id }}"
                                                        action="{{ route('subkriteria.destroy', $subkriteria->id) }}"
                                                        method="POST" style="display: none;">
                                                        @csrf
                                                        @method('delete')
                                                    </form>

                                                    <a class="wave☻s-effect waves-light btn-small btn red darken-4 box-shadow-none border-round mr-1 mb-1"
                                                        onclick="confirmDelete({{ $subkriteria->id }})"><i
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

        $('#subkriteria').DataTable();
    </script>
    <script>
        document.getElementById('kriteria_id').addEventListener('change', function() {
            var selectedOption = this.options[this.selectedIndex];
            var selectedKriteria = selectedOption.text;

            var label = document.querySelector('label[for="nama_subkriteria"]');
            label.textContent = selectedKriteria;
        });
    </script>

    <script>
        function confirmDelete(subkriteriaId) {
            Swal.fire({
                title: 'Konfirmasi',
                text: 'Apakah Anda yakin ingin menghapus data ini?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, Hapus',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('subkriteria.destroy' + subkriteriaId).submit();
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
