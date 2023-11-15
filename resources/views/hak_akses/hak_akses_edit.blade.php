@extends('layouts.app')

@section('content')
    <div id="breadcrumbs-wrapper" data-image="{{ asset('assets/images/gallery/breadcrumb-bg.jpg') }}">
        <!-- Search for small screen-->
        <div class="container">
            <div class="row">
                <div class="col s12 m6 l6">
                    <h5 class="breadcrumbs-title mt-0 mb-0"><span>Edit Hak Akses</span></h5>
                </div>
                <div class="col s12 m6 l6 right-align-md">
                    <ol class="breadcrumbs mb-0">
                        <li class="breadcrumb-item"><a href="/dashboard">Home</a>
                        </li>
                        <li class="breadcrumb-item"><a href="/hak-akses">Hak Akses</a>
                        </li>
                        <li class="breadcrumb-item active">Edit Hak Akses
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
                            <h4 class="card-title"><i class="material-icons left">edit</i>Edit Hak Akses </h4>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col s12">
                            <form action="{{ route('update-hak-akses',['id'=> $user->id ?? '']) }}" class="col s12" method="POST">
                                @csrf
                                @method('put')
                                <div class="row">
                                    <div class="input-field col s12">
                                        <input disabled value="{{ $user->no_anggota ?? '' }}" name="no_anggota" id="disable" type="text"
                                            class="validate" >
                                        <label for="disabled">No Anggota (disable) </label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s12">
                                        <input id="nama" value="{{ $user->name ?? '' }}" name="nama" type="text" class="validate" required>
                                        <label for="nama">Nama</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s12">
                                        <input disabled value="{{ $user->username ?? '' }}"  id="disabled" type="text"
                                            class="validate">
                                        <label for="disabled">Username (disabled)</label>
                                    </div>
                                </div>
                                {{-- <div class="row">
                                    <div class="input-field col s12">
                                        <input id="password" value="{{ $user->password }}" name="password" type="password" class="validate">
                                        <label for="password">Password</label>
                                    </div>
                                </div> --}}
                                <div class="row">
                                    <div class="input-field col s12">
                                        <select id="jabatan" name="jabatan" required>
                                            <option value="#" disabled selected>-- Pilih Jabatan --</option>
                                            @if($user->jabatan == "Ketua")
                                            <option value="Ketua" selected>Ketua</option>
                                            @endif
                                            @if(!$checkJabatanSekretaris)
                                            <option value="Sekretaris" >Sekretaris</option>
                                            @endif
                                            @if(!$checkJabatanPengawas)
                                            <option value="Pengawas" >Pengawas</option>
                                            @endif
                                            @if(!$checkJabatanKetua)
                                            <option value="Ketua" >Ketua</option>
                                            @endif
                                            @if(!$checkJabatanBendahara)
                                            <option value="Bendahara" >Bendahara</option>
                                            @endif
                                            @if( $user->jabatan == "Pengawas")
                                            <option value="Pengawas" selected>Pengawas</option>
                                            {{-- @elseif(!$checkJabatanKetua)
                                            <option value="Ketua" >Ketua</option>
                                             @elseif(!$checkJabatanSekretaris)
                                               <option value="Sekretaris" >Sekretaris</option> --}}
                                            @endif
                                            @if( $user->jabatan == "Bendahara")
                                            <option value="Bendahara" selected >Bendahara</option>
                                            @endif
                                            @if($user->jabatan == "Sekretaris" )
                                               <option value="Sekretaris" selected>Sekretaris</option>
                                            {{-- @elseif(!$checkJabatanPengawas)
                                            <option value="Pengawas" >Pengawas</option>
                                             @elseif(!$checkJabatanKetua)
                                            <option value="Ketua" >Ketua</option> --}}
                                            @endif
                                            @if($user->jabatan == "Pengurus")
                                               <option value="Pengurus"  selected>Pengurus</option>
                                             @else
                                               <option value="Pengurus"  >Pengurus</option>

                                            @endif
                                            
                                          
                                          
                                        </select>
                                        <label>Jabatan</label>
                                    </div>
                                </div>
                                {{-- <div class="row">
                                    <div class="input-field col s12">
                                        <input id="jabatan" type="text" value="{{ $user->jabatan ?? '' }}" name="jabatan" class="validate">
                                        <label for="jabatan">Jabatan</label>
                                    </div>
                                </div> --}}
                                <div class="row">
                                    <div class="input-field col s12">
                                        <select name="role_id">
                                            @foreach ($roles as $role)
                                                <option value="{{ $role->id}}" {{ $role->id == $user->role_id ? 'selected': '' }}>{{ $role->role_name }}</option>   
                                            @endforeach
                                        </select>
                                        <label>Akses Masuk</label>
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
