@extends('layouts.app')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <div id="breadcrumbs-wrapper" data-image="{{ asset('assets/images/gallery/breadcrumb-bg.jpg') }}">
        <!-- Search for small screen-->
        <div class="container">
            <div class="row">
                <div class="col s12 m6 l6">
                    <h5 class="breadcrumbs-title mt-0 mb-0"><span>Data Alternatif</span></h5>
                </div>
                <div class="col s12 m6 l6 right-align-md">
                    <ol class="breadcrumbs mb-0">
                        <li class="breadcrumb-item"><a href="/dashboard">Home</a>
                        </li>
                        <li class="breadcrumb-item active">Data Alternatif
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col s12 m12">
            <div class="card">
                <div class="card-content black-text">
                    <span class="card-title">Filter Data Alternatif</span>
                    <div class="row">
                        <div class="input-field col s6">
                            <form id="formFilter" action="{{ route('alternatif.index') }}" method="get">
                                <label for="datePicker">Bulan/Tahun</label>
                            <!-- Month Picker Input -->
                            <input class="js-monthpicker" id="datePicker" type="hidden">
                            <input type="text" id="picker" autocomplete="off" value="{{ $request->datePicker ?? '' }}"  name="datePicker" />

                            <!-- Alternative Input (The selected month/year will be placed here) -->
                            
                        </div>
                        <div class="col s6">
                            {{-- <a href="#" onclick="searchData()"
                                class="waves-effect waves-light btn blue lighten-5 black-text" style="margin-top: 25px">
                                <i class="material-icons left">search</i>Cari --}}
                                <button style="margin-top: 25px" type="submit"  class="waves-effect waves-light btn blue lighten-5 black-text" ><i class="material-icons left">search</i>Cari</button>
                            </a>
                            </form>
                            <a href="#" onclick="resetFilter()"
                                class="waves-effect waves-light btn red darken-4 ml-2" style="margin-top: 25px">
                                <i class="material-icons left">lock_reset</i>Reset
                            </a>
                            <!-- Dropdown Trigger -->
                            <a class="dropdown-trigger btn teal darken-4 ml-2" href="#" data-target="dropdown1"
                                style="margin-top: 25px">
                                <i class="material-icons left">print</i>Cetak Data
                            </a>
                            <!-- Dropdown Structure -->
                            <ul id='dropdown1' class='dropdown-content'>
                                <li><a href="{{ route('laporan-alternatif',['datePicker' =>$request->datePicker ?? '']) }}" target="_blank"><i
                                            class="material-icons">print</i>Print</a></li>
                                <li><a href="{{ route('export.excel',['datePicker' =>$request->datePicker ?? '']) }}"><i class="material-icons">file_download</i>Export
                                        Excel</a></li>
                            </ul>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="row" id="dataNotification" >
        <div class="col s12 m12">
            <div class="card-alert card cyan darken-4">
                <div class="card-content white-text">
                    @if($month && $year)
                    <p><i class="material-icons">notifications</i> Menampilkan Data Alternatif Bulan: <span
                            >{{ $month  }}</span> Tahun: <span id="notificationYear">{{ $year }}</span></p>
                    @else
                    <p><i class="material-icons">notifications</i> Menampilkan Semua Data</p>
                    @endif
                </div>
                <button type="button" class="close white-text" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
        </div>
    </div>



    <div class="row">
        <div class="col s12">
            <div class="card">
                <div class="card-content">
                    <div class="flex">
                        <div class="col s6" style="margin-left: -12px">
                            <h4 class="card-title">Data Alternatif</h4>
                        </div>
                        @if (Auth::user()->role_id == 2)
                            <div class="col s6" style="text-align: right">
                                <a class="waves-effect waves-light btn modal-trigger btn-small btn light-blue darken-3 box-shadow-none border-round mr-1 mb-1"
                                    href="{{ route('alternatif.create') }}"><i class="material-icons left">add</i>Tambah Data</a>
                            </div>
                        @endif
                    </div>
                   
                    <div class="row">
                        <div class="col s12">
                            <div  style="overflow-x:auto;">
                                <table id="data-tabs" class="display nowrap">
                                    <thead>
                                        <tr>
                                            @if (Auth::user()->role_id == 2)
                                            <th>
                                                <label>
                                                    <input type="checkbox" id="head-cb" class="select-all">
                                                    <span></span>
                                                </label>
                                            </th>
                                            @endif
                                            <th>No</th>
                                            <th>Tanggal Pinjaman</th>
                                            <th style="width: 150px;">Nomor Anggota</th>
                                            <th>Nama Anggota</th>
                                            <th>TTL</th>
                                            <th>Umur</th>
                                            <th>Alamat</th>
                                            @foreach ($kriterias as $kriteria)
                                                <th>{{ $kriteria->nama_kriteria }}</th>
                                            @endforeach
                                            @if (Auth::user()->role_id == 2)
                                                <th class="center-align" style="width: 300px;">Aksi</th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($alternatifs as $num => $alternatif)
                                            <tr>
                                                @if (Auth::user()->role_id == 2)
                                                    <td>
                                                        <label>
                                                            <input type="checkbox"
                                                                {{ $alternatif->is_checked == 1 ? 'checked' : '' }}
                                                                class="cb-child" value="{{ $alternatif->id }}">
                                                            <span></span>
                                                        </label>
                                                    </td>
                                                @endif
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $alternatif->created_at->format('d-m-Y') }}</td>
                                                <td>{{ $alternatif->no_anggota }}</td>
                                                <td>{{ $alternatif->nama_anggota }}</td>
                                                <td>{{ $alternatif->tempat_lahir }}, {{ \Carbon\Carbon::parse($alternatif->tanggal_lahir)->format('d-m-Y') }}</td>
                                                <td>{{ \Carbon\Carbon::parse($alternatif->tanggal_lahir)->diffInYears(\Carbon\Carbon::now()) }}
                                                </td>
                                                <td>{{ $alternatif->alamat }}</td>
                                                @if($alternatif->alternatifSub->count() < $kriterias->count())

                                                    @foreach ($alternatif->alternatifSub as $item)
                                                        <td>
                                                        @php
                                                            $subkriteria = App\Models\MasterSubCriteria::where('id', $item->subkriteria_id)->first();
                                                        @endphp
                                                                {{ $subkriteria->nama_subkriteria ?? '' }}
                                                        </td>
                                                    @endforeach
                                                    @for($i= 0 ;$i <    $kriterias->count() - $alternatif->alternatifSub->count() ; $i++)
                                                    <td> -</td>
                                                    @endfor

                                                @else
                                                @foreach ($alternatif->alternatifSub as $item)
                                                    <td>
                                                    @php
                                                        $subkriteria = App\Models\MasterSubCriteria::where('id', $item->subkriteria_id)->first();
                                                    @endphp
                                                        @if ($subkriteria)
                                                            {{ $subkriteria->nama_subkriteria }}

                                                        @else
                                                            -
                                                        @endif
                                                    </td>
                                                @endforeach

                                                @endif
                                                
                                                @if (Auth::user()->role_id == 2)
                                                    <td>
                                                        <a class="waves-effect waves-light btn-small btn yellow darken-1 box-shadow-none border-round mr-1 mb-1"
                                                            href="{{ route('alternatif.show', $alternatif->id) }}"><i
                                                                class="material-icons">visibility</i></a>
                                                        {{-- @if (Auth::user()->role_id == 1) --}}
                                                        <a class="waves-effect waves-light btn btn-small teal darken-4 box-shadow-none border-round mr-1 mb-1"
                                                            href="{{ route('alternatif.edit', $alternatif->id) }}"><i
                                                                class="material-icons">edit</i></a>

                                                        <form id="alternatif.destroy{{ $alternatif->id }}"
                                                            action="{{ route('alternatif.destroy', $alternatif->id) }}"
                                                            method="POST" style="display: none;">
                                                            @csrf
                                                            @method('delete')
                                                        </form>
                                                        <a class="waves-effect waves-light btn-small btn red darken-4 box-shadow-none border-round mr-1 mb-1"
                                                            onclick="confirmDelete({{ $alternatif->id }})"><i
                                                                class="material-icons">delete</i></a>
                                                        {{-- @endif --}}
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
    <input type="hidden" name="" value="{{ $kriterias }}" id="kriteriaz">
@endsection

@push('scripts')
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

  <script>
    
    $( document ).ready(function() 
        {
            // let kriterias = $('#kriteriaz').val();
            var krtierias = [
            @foreach ($kriterias as $kriteria)
                 "{{ $kriteria->id  }}", 
            @endforeach
            ];

            // console.log(krtierias)
            krtierias.forEach((kriteria) => {
                 $("#mySelect"+kriteria).select2({
                    dropdownParent: $("#modal1 .modal-content")

                });
          
            });
        })
  </script>

    <script>
        $('#data-tabs').DataTable({
                    'paging':false,
                });
        function resetFilter() 
        {
            $('#picker').val('');
            
            $("#formFilter").submit();
        }

      
    </script>
    <script>
        // Fungsi untuk menampilkan div dengan informasi bulan dan tahun
        function showDataNotification(month, year) {
            $('#notificationMonth').text(month.toString().padStart(2, '0'));
            $('#notificationYear').text(year);
            $('#dataNotification').show();
        }

        function getMonthNumber(monthName) {
            var date = new Date(Date.parse(monthName + " 1, 2023"));
            var month = date.getMonth() + 1;
            return month.toString().padStart(2, '0');
        }

        // Fungsi untuk mencari data berdasarkan bulan dan tahun
        // function searchData() {
        //     var selectedDate = $('#datePicker').val(); // Mendapatkan nilai bulan dan tahun dari input

        //     console.log(selectedDate)

        //     // Periksa apakah nilai bulan dan tahun valid
        //     if (!selectedDate) {
        //         // Tampilkan pesan kesalahan jika bulan dan tahun tidak valid
        //         alert('Bulan dan tahun harus diisi!');
        //         return;
        //     }

        //     // Split string selectedDate menjadi array
        //     var dateParts = selectedDate.split(' '); // Memisahkan bulan dan tahun

        //     var selectedMonth = getMonthNumber(dateParts[0]); // Mendapatkan bulan dari array
        //     var selectedYear = dateParts[1]; // Mendapatkan tahun dari array

        //     console.log(selectedMonth);

        //     // Panggil fungsi untuk menampilkan div dengan informasi bulan dan tahun
        //     showDataNotification(selectedMonth, selectedYear);

        //     // Cari data pada datatable dengan bulan dan tahun yang sesuai
        //     var dataTable = $('#scroll-vert-hor').DataTable();
        //     var searchValue = selectedYear + '-' + selectedMonth;
        //     dataTable.column(2).search(searchValue, true, false).draw();
        // }

        // // Panggil searchData() ketika terjadi perubahan pada input bulan dan tahun
        // $('#datePicker').on('change', searchData);
    </script>


    <script>
        $(function() {
            $('.js-monthpicker').monthpicker();
        });
    </script>



    <script>
        function confirmDelete(alternatifId) {
            Swal.fire({
                title: 'Konfirmasi',
                text: 'Apakah Anda yakin ingin menghapus data ini?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, Hapus',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('alternatif.destroy' + alternatifId).submit();
                }
            });
        }
    </script>

    <script>

        $( document ).ready(function() 
        {
             var checkboxLength = $('table tbody .cb-child:checked').length;
             if(checkboxLength > 0 &&checkboxLength == {{ $countAlternatif }})
             {
               $('#head-cb').prop("checked",true);

             }
             else
             {
               $('#head-cb').prop("checked",false);

             }
        });

        $('table tbody').on('click', '.cb-child', function(event) {
            var id = $(this).val();
            $.ajax({

                type: 'get',
                url: "{{ route('manage-checked') }}",
                data: {
                    "_token": "{{ csrf_token() }}",
                    id: id,

                },
                success: function(data) {
                    if (data == 200) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: 'Berhasil Di Ganti',
                        }).then(function() {
                            location.reload()
                        })

                    } else if (data == 400) {
                        // alert(data.msg);
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal',
                            text: 'Harap Coba Kembali !',
                        }).then(function() {
                            location.reload()

                        })
                    }


                }
            });

        })
    </script>

    <script>
        $('#head-cb').on('click',function(event) {
        let checked =  $('#head-cb').is(":checked");
        if(checked)
        {
            $('.cb-child').prop("checked",true);

            let checkbox_terpilih = $('table tbody .cb-child:checked');
            let ids = [];
            
            $.each(checkbox_terpilih, function(index,elm){
                ids.push(elm.value)
            })


              $.ajax({

                type: 'get',
                url: "{{ route('multiple-manage-checked') }}",
                data: {
                    "_token": "{{ csrf_token() }}",
                    ids: ids,

                },
                success: function(data) {
                    if (data == 200) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: 'Berhasil Di Ganti',
                        }).then(function() {
                            location.reload()
                        })

                    } else if (data == 400) {
                        // alert(data.msg);
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal',
                            text: 'Harap Coba Kembali !',
                        }).then(function() {
                            location.reload()

                        })
                    }


                }
            });

        }
        else
        {
            $('.cb-child').prop("checked",false);
            let checkbox_terpilih = $('table tbody .cb-child');
            let ids = [];
            
            $.each(checkbox_terpilih, function(index,elm){
                ids.push(elm.value)
            })


              $.ajax({

                type: 'get',
                url: "{{ route('multiple-manage-checked') }}",
                data: {
                    "_token": "{{ csrf_token() }}",
                    ids: ids,
                    uncheck: 1

                },
                success: function(data) {
                    if (data == 200) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: 'Berhasil Di Ganti',
                        }).then(function() {
                            location.reload()
                        })

                    } else if (data == 400) {
                        // alert(data.msg);
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal',
                            text: 'Harap Coba Kembali !',
                        }).then(function() {
                            location.reload()

                        })
                    }


                }
            });

        }
    })
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
