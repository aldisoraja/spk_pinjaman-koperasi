@extends('layouts.app')

@section('content')
    <div id="breadcrumbs-wrapper" data-image="{{asset('assets/images/gallery/breadcrumb-bg.jpg')}}">
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
                                <h4 class="card-title">Nilai Ideal</h4>
                            </div>
                            <div class="col s6" style="text-align: right">
                                <a class="waves-effect waves-light btn modal-trigger btn-small btn gradient-45deg-blue-cyan box-shadow-none border-round mr-1 mb-1" href="#modal1"><i class="material-icons left">add</i>Tambah Data</a>
                            </div>
                        </div>
                        <div id="modal1" class="modal modal-fixed-footer">
                            <div class="modal-content">
                            <h5><i class="material-icons left">add</i>Tambah Nilai Ideal</h5>
                            <br>
                                <div class="row">
                                    <form class="col s12">
                                        <div class="row">
                                            <div class="input-field col s12">
                                                <select>
                                                    <option value="pekerjaan">Pekerjaan</option>
                                                    <option value="penghasilan">Penghasilan</option>
                                                    <option value="besar_pinjaman">Besar Pinjaman</option>
                                                    <option value="lama_pinjaman">Lama Pinjaman</option>
                                                    <option value="jaminan">Jaminan</option>
                                                    <option value="simpanan_sukarela">Simpanan Sukarela</option>
                                                </select>
                                                <label>Kriteria</label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="input-field col s12">
                                            <input id="bobot_nilai" type="text" class="validate">
                                            <label for="bobot_nilai">Bobot Nilai</label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="input-field col s12">
                                            <input id="keterangan" type="text" class="validate">
                                            <label for="keterangan">Keterangan</label>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="modal-footer">
                            <a href="#!" class="modal-action modal-close waves-effect waves-light btn-small btn gradient-45deg-red-pink"><i class="material-icons right">cancel</i>Cancel</a>
                            <a href="#!" class="modal-action modal-close waves-effect waves-light btn-small btn gradient-45deg-green-teal"><i class="material-icons right">send</i>Submit</a>
                            </div>
                        </div>
                      <div class="row">
                        <div class="col s12">
                          <div class="responsive-table">
                            <table id="page-length-option" class="display">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Kriteria</th>
                                        <th>Nilai</th>
                                        <th>Keterangan</th>
                                        <th style="text-align: center">Aksi</th>
                                    </tr>
                                </thead>
                                    <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>Pekerjaan</td>
                                        <td>3</td>
                                        <td>Perangkat Desa, Karyawan Swasta, Karyawan Honorer, Penata Busana, Penata Rambut, Penata Rias, Wartawan, Promotor Acara, Bidan, Guru, Perawat, Apoteker, Penyiar Radio, Seniman, Pedagang</td>
                                        <td>
                                            <a class="waves-effect waves-light btn btn-small gradient-45deg-green-teal box-shadow-none border-round mr-1 mb-1 modal-trigger" href="#modal2"><i class="material-icons">edit</i></a>
                                            <a class="wave☻s-effect waves-light btn-small btn gradient-45deg-red-pink box-shadow-none border-round mr-1 mb-1"><i class="material-icons">delete</i></a>
                                        </td>
                                    </tr>
                                    </tbody>
                              </table>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
            </div>
            

      <!-- Modal Edit -->
      <div id="modal2" class="modal modal-fixed-footer">
        <div class="modal-content">
        <h5><i class="material-icons left">edit</i>Edit Data Nilai Ideal</h5>
        <br>
            <div class="row">
                <form class="col s12">
                    <div class="row">
                        <div class="input-field col s12">
                            <select>
                                <option value="pekerjaan">Pekerjaan</option>
                                <option value="penghasilan">Penghasilan</option>
                                <option value="besar_pinjaman">Besar Pinjaman</option>
                                <option value="lama_pinjaman">Lama Pinjaman</option>
                                <option value="jaminan">Jaminan</option>
                                <option value="simpanan_sukarela">Simpanan Sukarela</option>
                            </select>
                            <label>Kriteria</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                        <input id="bobot_nilai" type="text" class="validate">
                        <label for="bobot_nilai">Bobot Nilai</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                        <input id="keterangan" type="text" class="validate">
                        <label for="keterangan">Keterangan</label>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="modal-footer">
        <a href="#!" class="modal-action modal-close waves-effect waves-light btn-small btn gradient-45deg-red-pink"><i class="material-icons right">cancel</i>Cancel</a>
        <a href="#!" class="modal-action modal-close waves-effect waves-light btn-small btn gradient-45deg-green-teal"><i class="material-icons right">send</i>Submit</a>
        </div>
    </div>
@endsection

@push('scripts')
    @if (session()->has('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: 'Data berhasil disimpan',
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
