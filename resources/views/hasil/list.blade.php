@extends('layouts.app')

@section('content')
    <div id="breadcrumbs-wrapper" data-image="{{ asset('assets/images/gallery/breadcrumb-bg.jpg') }}">
        <!-- Search for small screen-->
        <div class="container">
            <div class="row">
                <div class="col s12 m6 l6">
                    <h5 class="breadcrumbs-title mt-0 mb-0"><span>Catatan Hasil Perhitungan</span></h5>
                </div>
                <div class="col s12 m6 l6 right-align-md">
                    <ol class="breadcrumbs mb-0">
                        <li class="breadcrumb-item"><a href="/dashboard">Home</a>
                        </li>
                        <li class="breadcrumb-item active">Catatan Hasil Perhitungan
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
                            <h4 class="card-title">Catatan Hasil Perhitungan</h4>
                        </div>
                       
                    </div>
                   
                    <div class="row">
                        <div class="col s12">
                            <table id="hasil" class="display dataTable">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal Perhitungan</th>
                                        <th>Jumlah Alternatif</th>
                                        <th>Jumlah Anggaran</th>
                                        <th class="center-align">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($hasilPerhitungan as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->created_at->format('d-m-Y H:i:s') }}</td>
                                            @php 
                                               $count =  \App\Models\DetailHasilPerhitungan::where('hasil_id',$item->id)->get()->count();
                                               
                                            @endphp
                                            <td >{{$count}}</td>
                                            <td>{{ "Rp " . number_format( $item->keterangan,2,',','.');   }}</td>
                                            <td class="center-align">
                                                <a class="btn waves-effect waves-light teal darken-4" href="{{ route('hasil-detail', $item->id) }}"><i class="material-icons">visibility</i></a>
                                                 @if (Auth::user()->role_id == 2)
                                                  <form id="list.destroy{{ $item->id }}" style="display: none"
                                                        action="{{ route('hasil-delete', $item->id) }}"
                                                        method="post">
                                                        @method('DELETE')
                                                        @csrf
                                                    </form>
                                                
                                                <a class="btn waves-effect waves-light btn red darken-4"
                                                    onclick="confirmDelete({{ $item->id }})"><i
                                                        class="material-icons">delete</i></a>
                                                 @endif
                                            </td>
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
        $('#hasil').DataTable();
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
                    document.getElementById('list.destroy' + itemId).submit();
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
