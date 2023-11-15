@extends('layouts.app')

@section('content')
    <div id="breadcrumbs-wrapper" data-image="{{ asset('assets/images/gallery/breadcrumb-bg.jpg') }}">
        <!-- Search for small screen-->
        <div class="container">
            <div class="row">
                <div class="col s12 m6 l6">
                    <h5 class="breadcrumbs-title mt-0 mb-0"><span>Hak Akses</span></h5>
                </div>
                <div class="col s12 m6 l6 right-align-md">
                    <ol class="breadcrumbs mb-0">
                        <li class="breadcrumb-item"><a href="/dashboard">Home</a>
                        </li>
                        <li class="breadcrumb-item active">Hak Akses
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
                            <h4 class="card-title">Data Hak Akses</h4>
                        </div>
                        <div class="col s6" style="text-align: right">
                            <a class="waves-effect waves-light btn modal-trigger btn-small btn light-blue darken-3 box-shadow-none border-round mr-1 mb-1"
                                href="#modal1"><i class="material-icons left">add</i>Tambah Data</a>
                        </div>
                    </div>
                    <div id="modal1" class="modal modal-fixed-footer">
                        <div class="modal-content">
                            <h5><i class="material-icons left">add</i>Tambah Data Hak Akses</h5>
                            <br>
                            <div class="row">
                                <form id="register" class="col s12" method="POST" action="{{ route('hak-akses.store') }}">
                                    @csrf
                                    <div class="row">
                                        <div class="input-field col s12">
                                            <input name="no_anggota" id="no_anggota" type="text"
                                                class="@error('no_anggota') is-invalid @enderror"
                                                value="{{ old('no_anggota') }}" required autocomplete="no_anggota"
                                                autofocus>
                                            <label for="no_anggota">No Anggota</label>
                                            @error('no_anggota')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="input-field col s12">
                                            <input id="name" type="text" class="@error('name') is-invalid @enderror"
                                                name="name" value="{{ old('name') }}" required autocomplete="name"
                                                autofocus>
                                            <label for="name">Nama</label>
                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="input-field col s12">
                                            <input id="username" type="text"
                                                class="@error('username') is-invalid @enderror" name="username"
                                                value="{{ old('username') }}" required autocomplete="username">
                                            <label for="username">Username</label>
                                            @error('username')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="input-field col s12">
                                            <input id="password" type="password"
                                                class="@error('password') is-invalid @enderror" name="password" required
                                                autocomplete="new-password">
                                            <label for="password">Password</label>
                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="input-field col s12">
                                            <select id="jabatan" name="jabatan" required>
                                                <option value="#" disabled selected>-- Pilih Jabatan --</option>
                                                @if(!$ketua)
                                                <option value="Ketua">Ketua</option>
                                                @endif
                                                @if(!$sekretaris)
                                                <option value="Sekretaris">Sekretaris</option>
                                                @endif
                                                @if(!$pengawas)
                                                <option value="Pengawas">Pengawas</option>
                                                @endif
                                                @if(!$bendahara)
                                                <option value="Bendahara">Bendahara</option>
                                                @endif
                                                <option value="Pengurus">Pengurus</option>
                                            </select>
                                            <label>Jabatan</label>
                                        </div>
                                    </div>
                                    {{-- <div class="row">
                                        <div class="input-field col s12">
                                            <input id="jabatan" type="text"
                                                class="@error('jabatan') is-invalid @enderror" name="jabatan"
                                                value="{{ old('jabatan') }}" required autocomplete="jabatan">
                                            <label for="jabatan">Jabatan</label>
                                            @error('jabatan')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div> --}}
                                    <div class="row">
                                        <div class="input-field col s12">
                                            <select name="role_id" id="role_id">
                                                <option value="" disabled selected>-- Pilih Akses Masuk --
                                                </option>
                                                @foreach ($roles as $role)
                                                    <option value="{{$role->id}}">{{$role->role_name}}</option>
                                                @endforeach
                                            </select>
                                            <label>Akses Masuk</label>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <a href="javascript:void(0);"
                                class="modal-action modal-close waves-effect waves-light btn-small btn red darken-4"
                                onclick="document.getElementById('register').reset();"><i
                                    class="material-icons right">cancel</i>Cancel</a>
                            <a href="javascript:void(0);"
                                class="modal-action modal-close waves-effect waves-light btn-small btn teal darken-4"
                                onclick="document.getElementById('register').submit();"><i
                                    class="material-icons right">send</i>Submit</a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12">
                            <table id="hak_akses" class="display dataTable">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th style="width: 100px">No Anggota</th>
                                        <th>Nama</th>
                                        <th>Username</th>
                                        {{-- <th style="max-width: 150">Password</th> --}}
                                        <th>Jabatan</th>
                                        <th>Akses Masuk</th>
                                        <th style="text-align: center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $user->no_anggota }}</td>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->username }}</td>
                                            {{-- <td>{{ $user->password }}</td> --}}
                                            <td>{{ $user->jabatan ?? '' }}</td>
                                            <td>{{ $user->role->role_name ?? '' }}</td>

                                            <td style="display: flex; justify-content: center; align-items: center;">
                                                <a class="waves-effect waves-light btn btn-small teal darken-4 box-shadow-none border-round mr-1 mb-1 modal-trigger"
                                                href="{{ route('edit-hak-akses', $user->id) }}"><i
                                                class="material-icons">edit</i></a>
                                                @if ($user->id != Auth()->user()->id)
                                                    <form id="hak_akses.destroy{{ $user->id }}"
                                                        action="{{ route('hak-akses.destroy', $user->id) }}"
                                                        method="post">
                                                        @method('DELETE')
                                                        @csrf
                                                    </form>
                                                    <a class="wave☻s-effect waves-light btn-small btn red darken-4 box-shadow-none border-round mr-1 mb-1"
                                                        onclick="confirmDelete({{ $user->id }})"><i
                                                            class="material-icons">delete</i></a>
                                                @else
                                              
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
        $('#hak_akses').DataTable();
    </script>
    <script>
        function confirmDelete(userId) {
            Swal.fire({
                title: 'Konfirmasi',
                text: 'Apakah Anda yakin ingin menghapus data ini?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, Hapus',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('hak_akses.destroy' + userId).submit();
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
