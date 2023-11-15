@extends('layouts.app')

@section('content')
    <div id="breadcrumbs-wrapper" data-image="{{ asset('assets/images/gallery/breadcrumb-bg.jpg') }}">
        <!-- Search for small screen-->
        <div class="container">
            <div class="row">
                <div class="col s12 m6 l6">
                    <h5 class="breadcrumbs-title mt-0 mb-0"><span>Nilai Ideal</span></h5>
                </div>
                <div class="col s12 m6 l6 right-align-md">
                    <ol class="breadcrumbs mb-0">
                        <li class="breadcrumb-item"><a href="/dashboard">Home</a>
                        </li>
                        <li class="breadcrumb-item active">Nilai Ideal
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
                            <h4 class="card-title">Data Nilai Ideal</h4>
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
                                <h5><i class="material-icons left">add</i>Tambah Data Nilai Ideal</h5>
                                <br>
                                <div class="row">
                                    <form id="nilai-ideal" class="col s12" action="{{ route('nilai-ideal-store') }}"
                                        method="post">
                                        @csrf
                                        <div class="row">
                                            <div class="input-field col s12">
                                                <select name="kriteria" id="kriteria" required>
                                                    <option value="" disabled selected>-- Pilih Kriteria --
                                                    </option>
                                                    @foreach ($kriterias as $kriteria)
                                                        @if($nilaiIdeal->where('kriteria_id',$kriteria->id)->count() > 0)
                                                        @else
                                                           <option value="{{ $kriteria->id }}">{{ $kriteria->nama_kriteria }}
                                                        </option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                                <label> Kriteria</label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="input-field col s12">
                                                <select name="nilai_ideal"id="nilai_ideal" required>
                                                    <option value="" disabled selected>-- Pilih Nilai Ideal--
                                                    </option>
                                                    @foreach($valueNilai as $item)
                                                        <option value="{{ $item }}">{{ $item }}</option>
                                                    @endforeach
                                                </select>
                                                {{-- <input id="nilai_ideal" required type="number" name="nilai_ideal"
                                                    value="{{ old('nilai_ideal') }}" class="validate"> --}}
                                                <label for="nilai_ideal">Nilai Ideal</label>
                                            </div>
                                        </div>
                                        {{-- <div class="row">
                                            <div class="input-field col s12">
                                                <input id="keterangan" type="text" name="keterangan"
                                                    value="{{ old('keterangan') }}" class="validate">
                                                <label for="keterangan">Keterangan</label>
                                            </div>
                                        </div> --}}
                                    </form>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <a href="javascript:void(0);"
                                    class="modal-action modal-close waves-effect waves-light btn-small btn red darken-4"
                                    onclick="document.getElementById('nilai-ideal').reset();"><i
                                        class="material-icons right">cancel</i>Cancel</a>
                                <a href="javascript:void(0);"
                                    class="modal-action modal-close waves-effect waves-light btn-small btn teal darken-4"
                                    onclick="document.getElementById('nilai-ideal').submit();"><i
                                        class="material-icons right">send</i>Submit</a>
                            </div>
                        </div>
                    @endif
                    <div class="row">
                        <div class="col s12">
                            <table id="nilaiIdeal" class="display">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Kriteria</th>
                                        <th>Nilai Ideal</th>
                                        
                                        @if (Auth::user()->role_id == 1)
                                            <th class="center-align" style="width: 200px;">Aksi</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($nilaiIdeal as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->kriteria->nama_kriteria }}</td>
                                            <td>{{ $item->nilai_ideal }}</td>
                                            @if (Auth::user()->role_id == 1)
                                                <td class="center-align">
                                                    <a class="waves-effect waves-light btn btn-small teal darken-4 box-shadow-none border-round mr-1 mb-1"
                                                        href="{{ route('nilai-ideal-edit', $item->id) }}"><i
                                                            class="material-icons">edit</i></a>

                                                    <form id="ideal-delete{{ $item->id }}" method="POST"
                                                        style="display: none;"
                                                        action="{{ route('nilai-ideal-delete', $item->id) }}">
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
        $('#nilaiIdeal').DataTable();
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
                    document.getElementById('ideal-delete' + itemId).submit();
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
