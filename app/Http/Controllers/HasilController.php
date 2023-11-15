<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\HasilPerhitungan;
use App\Http\Controllers\Controller;
use App\Models\DetailHasilPerhitungan;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class HasilController extends Controller
{
    public function index()
    {
        $hasilPerhitungan = HasilPerhitungan::get()->sortByDesc('created_at');

        $data['hasilPerhitungan'] = $hasilPerhitungan;

        return view('hasil.list',$data);
    }

    public function detail(Request $request, $id)
    {

        $detailHasilPerhitungan = DetailHasilPerhitungan::where('hasil_id',$id)->get();
      
        $data['detailHasilPerhitungan'] = $detailHasilPerhitungan;

        return view('hasil.detail', $data);
    }

    public function laporan(Request $request,$id)
    {

        $ketua = User::where('jabatan', 'ketua')->first();

        $detailHasilPerhitungan = DetailHasilPerhitungan::where('hasil_id', $id)->get();

        $data['detailHasilPerhitungan'] = $detailHasilPerhitungan;
        $data['ketua'] = $ketua;

        return view('laporan.hasil-perhitungan', $data);
    }

    public function exportExcel(Request $request,$id)
    {


        $detailHasilPerhitungan = DetailHasilPerhitungan::where('hasil_id', $id)->get();
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $clone1 = clone   $detailHasilPerhitungan;
        $clone2 = clone  $detailHasilPerhitungan;
        $clone3 = clone  $detailHasilPerhitungan;
        // Populasikan Spreadsheet dengan data
        $sheet->setCellValue('A1', 'Diterima :');
        $sheet->setCellValue('B1', $clone1->where('keterangan','Di Terima')->count() ?? 0 );;
        $sheet->setCellValue('A2', 'Ditolak :');
        $sheet->setCellValue('B2', $clone2->where('keterangan','Di Tolak')->count() ?? 0 );
        $sheet->setCellValue('A3', 'Total Pinjaman :');
        $sheet->setCellValue('B3', "Rp " . number_format($clone3->where('keterangan', 'Di Terima')->sum('besar_pinjaman'), 2, ',', '.'));
        $sheet->setCellValue('A5', 'No');
        $sheet->setCellValue('B5', 'Tanggal Perhitungan');
        $sheet->setCellValue('C5', 'No Anggota');
        $sheet->setCellValue('D5', 'Nama Anggota');
        $sheet->setCellValue('E5', 'Besar Pinjaman');
        $sheet->setCellValue('F5', 'Nilai');
        $sheet->setCellValue('G5', 'Keterangan');

       
        // $char = range('A', 'Z');

        $row = 7;
        foreach ($detailHasilPerhitungan as $num =>$item) {
            $sheet->setCellValue('A' . $row, $num+1);
            $sheet->setCellValue('B' . $row, $item->created_at->format('d-m-Y H:i:s'));
            $sheet->setCellValue('C' . $row, $item->alternatif->no_anggota);
            $sheet->setCellValue('D' . $row, $item->alternatif->nama_anggota);
            $sheet->setCellValue('E' . $row, "Rp " . number_format( $item->besar_pinjaman,2,',','.'));
            $sheet->setCellValue('F' . $row, $item->nilai_total); 
            $sheet->setCellValue('G' . $row, $item->keterangan ?? '');
            $row++;

        }

        foreach(range('A', 'G') as $columId){
            $sheet->getColumnDimension($columId)->setAutoSize(true);
        }

        $writer = new Xlsx($spreadsheet);

        // Atur header untuk memberi tahu browser bahwa ini adalah file Excel
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="Hasil Perhitungan.xlsx"');
        header('Cache-Control: max-age=0');

        // Keluarkan file Excel ke output
        $writer->save('php://output');
    }

    public function destroy($id)
    {
        $hasilPerhitungan = HasilPerhitungan::findOrFail($id);

        $detailHasilPerhitungan = DetailHasilPerhitungan::where('hasil_id',$hasilPerhitungan->id)->get();
        foreach($detailHasilPerhitungan as $item)
        {
            $item->delete();
        }
        $hasilPerhitungan->delete();

        return redirect()->route('list-hasil')->with('success', 'Data telah dihapus !');
    }

}
