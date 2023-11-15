<?php

namespace App\Http\Controllers;

use App\Models\AlternatifSubkriteria;
use App\Models\AlternativeData;
use App\Models\MasterCriteria;
use App\Models\MasterSubCriteria;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;

// require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class AlternatifController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $datePicker = $request->datePicker;

        if ($datePicker)
        {

            $datePickerArray = (explode(" ", $datePicker));
            $month = $datePickerArray[0];
            $year = $datePickerArray[1];
            $parseMonth = date_parse($month);
            $startDate = Carbon::createFromDate($year, $parseMonth['month'])->startOfMonth();
            $endDate = Carbon::createFromDate($year, $parseMonth['month'])->endOfMonth();
            $alternatifs = AlternativeData::with('alternatifSub')
            ->whereBetween('created_at', [$startDate, $endDate])->get()->sortByDesc('created_at');
        }
        else
        {
            $startDate = Carbon::now()->startOfMonth();
            $endDate = Carbon::now()->endOfMonth();
           $alternatifs = AlternativeData::with('alternatifSub')->whereBetween('created_at', [$startDate, $endDate])->get()->sortByDesc('created_at');
        }

        $countAlternatif = $alternatifs->count();


        $kriterias = MasterCriteria::all();
        $subkriterias = [];

        foreach ($kriterias as $kriteria) {
            $subkriterias[$kriteria->id] = MasterSubCriteria::where('kriteria_id', $kriteria->id)->get();
        }

        $data = [
            'kriterias' => $kriterias,
            'subkriterias' => $subkriterias,
            'alternatifs' => $alternatifs,
            'month' => $startDate ? $startDate->format('m '):'',
            'year' => $startDate ? $startDate->format('Y ') : '',
            'request'=>$request,
            'countAlternatif' => $countAlternatif

        ];

        return view('alternatif.alternatif', $data);
    }

    public function exportExcel(Request $request)
    {

        $datePicker = $request->datePicker;
        if ($datePicker) {

            $datePickerArray = (explode(" ", $datePicker));
            $month = $datePickerArray[0];
            $year = $datePickerArray[1];
            $parseMonth = date_parse($month);
            $startDate = Carbon::createFromDate($year, $parseMonth['month'])->startOfMonth();
            $endDate = Carbon::createFromDate($year, $parseMonth['month'])->endOfMonth();
            $alternatifs = AlternativeData::with('alternatifSub')
            ->whereBetween('created_at', [$startDate, $endDate])->get()->sortByDesc('created_at');
        } else 
        {
            $startDate = Carbon::now()->startOfMonth();
            $endDate = Carbon::now()->endOfMonth();
            $alternatifs = AlternativeData::with('alternatifSub')->whereBetween('created_at', [$startDate, $endDate])->get()->sortByDesc('created_at');        }

        $kriterias = MasterCriteria::all();
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        
        // Populasikan Spreadsheet dengan data
        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'No Anggota');
        $sheet->setCellValue('C1', 'Tanggal Pinjaman');
        $sheet->setCellValue('D1', 'Nama Anggota');
        $sheet->setCellValue('E1', 'TTL');
        $sheet->setCellValue('F1', 'Umur');
        $sheet->setCellValue('G1', 'Alamat');
        $sheet->setCellValue('H1', 'Pekerjaan');
        $sheet->setCellValue('I1', 'Penghasilan');
        $sheet->setCellValue('J1', 'Besar Pinjaman');
        $sheet->setCellValue('K1', 'Lama Pinjaman');
        $sheet->setCellValue('L1', 'Jaminan');
        $sheet->setCellValue('M1', 'Simpanan');
        $char = range('A', 'Z');
        $row = 2;
        $count = 1 ;
        foreach ($alternatifs as $num => $alternatif) {
            $sheet->setCellValue('A' . $row, $count++);
            $sheet->setCellValue('B' . $row, $alternatif->no_anggota);
            $sheet->setCellValue('C' . $row, $alternatif->created_at->format('d-m-Y'));
            $sheet->setCellValue('D' . $row, $alternatif->nama_anggota);
            $sheet->setCellValue('E' . $row, $alternatif->tempat_lahir.' '. Carbon::parse($alternatif->tanggal_lahir)->format('d-m-Y'));
            $sheet->setCellValue('F' . $row, Carbon::parse($alternatif->tanggal_lahir)->diffInYears(Carbon::now()));
            $sheet->setCellValue('G' . $row, $alternatif->alamat ?? '');
            $i = 7 ;
            foreach ($alternatif->alternatifSub as $key => $value) 
            {
            $subkriteria = MasterSubCriteria::where('id', $value->subkriteria_id)->first();
            $sheet->setCellValue($char[$i++] . $row, $subkriteria->nama_subkriteria);
            }
  
            $row++;
        }

        foreach(range('A', 'M') as $columId){
            $sheet->getColumnDimension($columId)->setAutoSize(true);
        }
        
        $writer = new Xlsx($spreadsheet);
        
        // Atur header untuk memberi tahu browser bahwa ini adalah file Excel
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="Data Alternatif.xlsx"');
        header('Cache-Control: max-age=0');
        
        // Keluarkan file Excel ke output
        $writer->save('php://output');
    }

    public function laporan(Request $request){

        
        $datePicker = $request->datePicker;

        $ketua = User::where('jabatan','ketua')->first();

        if ($datePicker) {

            $datePickerArray = (explode(" ", $datePicker));
            $month = $datePickerArray[0];
            $year = $datePickerArray[1];
            $parseMonth = date_parse($month);
            $startDate = Carbon::createFromDate($year, $parseMonth['month'])->startOfMonth();
            $endDate = Carbon::createFromDate($year, $parseMonth['month'])->endOfMonth();
            $alternatifs = AlternativeData::with('alternatifSub')
            ->whereBetween('created_at', [$startDate, $endDate])->get()->sortByDesc('created_at');
        } else {
            $startDate = Carbon::now()->startOfMonth();
            $endDate = Carbon::now()->endOfMonth();
            $alternatifs = AlternativeData::with('alternatifSub')->whereBetween('created_at', [$startDate, $endDate])->get()->sortByDesc('created_at');        }

        $data = [
            'kriterias' => MasterCriteria::all(),
            'alternatifs' => $alternatifs,
            'ketua' => $ketua
        ];
        return view('laporan.data-alternatif', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kriterias = MasterCriteria::all();
        $subkriterias = [];

        foreach ($kriterias as $kriteria) {
            $subkriterias[$kriteria->id] = MasterSubCriteria::where('kriteria_id', $kriteria->id)->get();
        }

        $data = [
            'kriterias' => $kriterias,
            'subkriterias' => $subkriterias,
         
        ];

        return view('alternatif.alternatif-create', $data);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
        $this->validate($request, [
            'no_anggota' => 'required|numeric',
            'nama_anggota' => 'required|string',
            'tempat_lahir' => 'required|string',
            'tanggal_lahir' => 'required',
            'alamat' => 'required|string',
            'keperluan' => 'required|string',
            'besar_pinjaman' => 'required|numeric',
            'subkriteria_id.*' => 'exists:subkriteria,id'
        ]);


        $alternatif = AlternativeData::create([
            'no_anggota' => $request->no_anggota,
            'nama_anggota' => $request->nama_anggota,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'alamat' => $request->alamat,
            'keperluan' => $request->keperluan,
            'besar_pinjaman' => $request->besar_pinjaman,
        ]);

        foreach ($request->subkriteria_id as $subkriteriaId) {
            $alternatifsub = AlternatifSubkriteria::create([
                'alternatif_id' => $alternatif->id,
                'subkriteria_id' => $subkriteriaId,
            ]);
        };
        // dd($alternatifsub);

        if ($alternatif && $alternatifsub) {
            return redirect()->route('alternatif.index')->with('success', 'Data berhasil disimpan!');
        } else {
            return redirect()->route('alternatif.index')->with('error', 'Data gagal disimpan!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $alternatif = AlternativeData::with('alternatifSub')->find($id);
        $alternatifSub = AlternatifSubkriteria::where('alternatif_id', $alternatif->id)->with('subkriteria')->get();

        $pekerjaan = AlternatifSubkriteria::where('alternatif_id', $alternatif->id)->with('subkriteria')
                                            ->whereHas('subKriteria',function($q){
                                                return $q->where('kriteria_id',1);
                                            })
                                            ->first();

        $data = [
            'alternatif' => $alternatif,
            'alternatifSub' => $alternatifSub,
            'kriterias' => MasterCriteria::all(),
            'pekerjaan' =>$pekerjaan,
        ];
        // dd($data);
        return view('alternatif.alternatif-show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $alternatif = AlternativeData::find($id);
        $kriterias = MasterCriteria::all();
        foreach ($kriterias as $kriteria) {
            $subkriterias[$kriteria->id] = MasterSubCriteria::where('kriteria_id', $kriteria->id)->get();
        }

        $alternatifSubKriteria = AlternatifSubkriteria::with('subkriteria')->where('alternatif_id',$alternatif->id)->get();

        $alternatifSubKriteria = $alternatifSubKriteria->map(function($q){
            return $q->subkriteria;
        });
        // dd($alternatifSubKriteria);

        $data = [
            'alternatif' => $alternatif,
            'kriterias' => $kriterias,
            'subkriterias' => $subkriterias,
            'alternatifSubKriteria' => $alternatifSubKriteria
        ];

        // dd($data);
        return view('alternatif.alternatif-edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'no_anggota' => 'required|string',
            'nama_anggota' => 'required|string',
            'tempat_lahir' => 'required|string',
            'tanggal_lahir' => 'required',
            'alamat' => 'required|string',
            'keperluan' => 'required|string',
            'besar_pinjaman' => 'required|numeric',
            'subkriteria_id.*' => 'exists:subkriteria,id'
        ]);

        $alternatif = AlternativeData::findOrFail($id);
        $alternatifSubkriteria = AlternatifSubkriteria::where('alternatif_id', $id)->get();

        $alternatif->update([
            'no_anggota' => $request->no_anggota,
            'nama_anggota' => $request->nama_anggota,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'alamat' => $request->alamat,
            'keperluan' => $request->keperluan,
            'besar_pinjaman' => $request->besar_pinjaman,
        ]);

        $alternatifSub = [];

        foreach ($request->subkriteria_id as $subkriteriaId) {
            $alternatifSub[] = [
                'alternatif_id' => $alternatif->id,
                'subkriteria_id' => $subkriteriaId,
            ];
        }

        $alternatifSubkriteria->each(function ($item, $key) use ($alternatifSub) {
            $item->update($alternatifSub[$key]);
        });

        if ($alternatif && $alternatifSubkriteria) {
            return redirect()->route('alternatif.index')->with('success', 'Data berhasil disimpan!');
        } else {
            return redirect()->route('alternatif.edit', $id)->with('error', 'Data gagal disimpan!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $alternaatif = AlternativeData::findOrFail($id);
        AlternatifSubkriteria::where('alternatif_id', $id)->delete();
        $alternaatif->delete();

        return redirect()->route('alternatif.index')->with('success', 'Data telah dihapus !');
    }

    public function ManageChecked(Request $request)
    {
        $alternatif = AlternativeData::findOrFail($request->id);

        if($alternatif->is_checked)
        {
            $alternatif->is_checked = 0 ;
        }
        else
        {
            $alternatif->is_checked = 1 ;
        }
        $alternatif->save();

        if($alternatif)
        {
        return 200;

        }
        else
        {
            return 404 ;
        }

    }

    public function MultipleManageChecked(Request $request)
    {
        $alternatifs = AlternativeData::WhereIn('id',$request->ids)->get();



        foreach($alternatifs as $alternatif)
        {
            if ($request->uncheck) 
            {
                $alternatif->is_checked = 0;
            } 
            else 
            {
                $alternatif->is_checked = 1;
            }
            $alternatif->save();

        }


        if ($alternatif) {
            return 200;
        } else {
            return 404;
        }
    }
    
}
