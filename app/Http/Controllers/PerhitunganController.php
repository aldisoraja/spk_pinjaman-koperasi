<?php

namespace App\Http\Controllers;

use App\Models\MasterFactor;
use Illuminate\Http\Request;
use App\Models\MasterGapValue;
use App\Models\AlternativeData;
use App\Models\HasilPerhitungan;
use App\Models\MasterIdealValue;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\AlternatifSubkriteria;
use App\Models\DetailHasilPerhitungan;
use App\Models\MasterCriteria;

class PerhitunganController extends Controller
{
    public function perhitungan(Request $request)
    {   

        $cariAlternatif = AlternativeData::where('is_checked',1)->pluck('id');

        $cariSubkriteriaAlternatif = AlternatifSubkriteria::whereIn('alternatif_id',$cariAlternatif)->get();

        $cariSubkriteriaAlternatifGroupAlternatif = $cariSubkriteriaAlternatif->groupBy('alternatif_id');

        $dataPerhitungans = [];

        // pemetaan GAP 
        
        foreach($cariSubkriteriaAlternatifGroupAlternatif as $items)
        {
            
            $data = [];
            foreach($items as $item )
            {
                $cariNilaiIdeal = MasterIdealValue::where('kriteria_id',$item->subkriteria->kriteria->id)->first();
                $itemPerhitungans =
                [
                    'id_alternatif' => $item->alternatif_id,
                    'kriteria_id' => $item->subkriteria->kriteria->id,
                    'besar_pinjaman'=>$item->alternatif->besar_pinjaman,
                    'sub_kriteria' => $item->subkriteria->id,
                    'nilai_sub_kriteria' => $item->subkriteria->nilai_subkriteria,
                    'faktor_id' => $item->subkriteria->kriteria->faktor_id,
                    'nilai_pemetaan_gap' =>  $item->subkriteria->nilai_subkriteria - $cariNilaiIdeal->nilai_ideal ,
                ];

                array_push($data, $itemPerhitungans);

            }

            array_push($dataPerhitungans,$data);
     
        }
        
        // Pembobotan GAP 

        $dataPembobotanGap  = [];


        foreach($dataPerhitungans as $dataPerhitungan)
        {
            $dataGap  = [];

            foreach($dataPerhitungan as $item)
            {
                $cariBobotGap = MasterGapValue::where('nilai_gap',$item['nilai_pemetaan_gap'])->first();
                $data = [
                    'id_alternatif' => $item['id_alternatif'],
                    'besar_pinjaman' => $item['besar_pinjaman'],
                    'kriteria_id' => $item['kriteria_id'],
                    'sub_kriteria' => $item['sub_kriteria'],
                    'nilai_sub_kriteria' => $item['nilai_sub_kriteria'],
                    'faktor_id' => $item['faktor_id'],
                    'nilai_pemetaan_gap' =>  $item['nilai_pemetaan_gap'],
                    'nilai_bobot_gap' => $cariBobotGap->bobot_nilai_kriteria,


                ];
                
                array_push($dataGap, $data);
            }
            array_push($dataPembobotanGap, $dataGap);


        }

        // Perhitungan Core dan Secondary Factor 
        
        $dataPembobotanGapCollection = collect($dataPembobotanGap);
        // dd($dataPembobotanGapCollection);

        $dataMapping = $dataPembobotanGapCollection->map(function($query)
        {
           $filterCoreFaktor = collect($query)->filter(function($item){
                return $item['faktor_id'] == 1 ;
            });

            $filterSecondaryFaktor = collect($query)->filter(function ($item) {
                return $item['faktor_id'] == 2;
            });


            $countCoreFaktor = $filterCoreFaktor->count();
            $countSecondaryFaktor = $filterSecondaryFaktor->count();


            $sumCoreFaktor = $filterCoreFaktor->sum('nilai_bobot_gap');
            $hasilCoreFaktor = $sumCoreFaktor /   $countCoreFaktor;

            $sumSecondaryFaktor = $filterSecondaryFaktor->sum('nilai_bobot_gap');
            $hasilSecondaryFaktor = $sumSecondaryFaktor /   $countSecondaryFaktor;
            
            return [
                'id_alternatif' => $query[0]['id_alternatif'],
                'besar_pinjaman' => $query[0]['besar_pinjaman'],
                'hasil_core_faktor' =>$hasilCoreFaktor ,
                'hasil_secondary_faktor' =>$hasilSecondaryFaktor,
            ];

        });

        // hasilAkhir 

        $hasilAkhir = $dataMapping->map(function($query)
        {
            $coreFaktorPresentase = MasterFactor::find(1)->bobot_faktor / 100;
            $secondaryFaktorPresentase = MasterFactor::find(2)->bobot_faktor / 100;


            return 
            [
                'id_alternatif' => $query['id_alternatif'],
                'besar_pinjaman'=> $query['besar_pinjaman'],
                'total' => ($query['hasil_core_faktor'] * $coreFaktorPresentase) + ($query['hasil_secondary_faktor'] * $secondaryFaktorPresentase),

            ];

        });

        // $criteriaCoreFaktor = MasterCriteria::where('faktor_id',1)->pluck('id');
        // $countCoreFaktor = $criteriaCoreFaktor->count();
        // $cariNilaiIdealKriteria= MasterIdealValue::whereIn('kriteria_id',$criteriaCoreFaktor)->sum('nilai_ideal');
        // $nilaiMinimumIdeal = $cariNilaiIdealKriteria / $countCoreFaktor;

        $hasilPerhitungan = new HasilPerhitungan();
        $hasilPerhitungan->user_id = Auth::user()->id;
        $hasilPerhitungan->keterangan = (int) $request->jumlah_anggaran ;
        $hasilPerhitungan->save();

        // dd($nilaiMinimumIdeal);
      

        $hasilAkhir = collect($hasilAkhir)->sortByDesc('total');
        $i = 1 ;
        $jumlahAnggaran  = $request->jumlah_anggaran;
        foreach ($hasilAkhir as $item) 
        {
            $alternatif = AlternativeData::where('id', $item['id_alternatif'])->first();
            $jumlahAnggaran -= $item['besar_pinjaman'];

            $detailHasilPerhitungan = new DetailHasilPerhitungan();
            $detailHasilPerhitungan->hasil_id = $hasilPerhitungan->id;
            $detailHasilPerhitungan->alternatif_id = $item['id_alternatif'];
            $detailHasilPerhitungan->nilai_total = $item['total'];
            $detailHasilPerhitungan->rangking = $i ?? '';

            $detailHasilPerhitungan->besar_pinjaman = $alternatif->besar_pinjaman ?? '-';
          
            if($jumlahAnggaran >= 0 && $item['total'])
            {
                $detailHasilPerhitungan->keterangan = 'Di Terima' ;

            }
            else
            {
                $detailHasilPerhitungan->keterangan = 'Di Tolak' ;

            }

            $detailHasilPerhitungan->save();
            $i++;
        }


        return redirect()->route('list-hasil')->with('success', 'Berhasil Melakukan Perhitungan !');


    }

    public function detail() 
    {

        $cariAlternatif = AlternativeData::where('is_checked', 1)->pluck('id');

        $cariSubkriteriaAlternatif = AlternatifSubkriteria::whereIn('alternatif_id', $cariAlternatif)->get();

        $cariSubkriteriaAlternatifGroupAlternatif = $cariSubkriteriaAlternatif->groupBy('alternatif_id');

        $dataPerhitungans = [];

        // pemetaan GAP 

        foreach ($cariSubkriteriaAlternatifGroupAlternatif as $items) {

            $data = [];
            foreach ($items as $item) {
                $cariNilaiIdeal = MasterIdealValue::where('kriteria_id', $item->subkriteria->kriteria->id)->first();
                $itemPerhitungans =
                    [
                        'id_alternatif' => $item->alternatif_id,
                        'nama_alternatif' => $item->alternatif->nama_anggota,
                        'kriteria_id' => $item->subkriteria->kriteria->id,
                        'sub_kriteria' => $item->subkriteria->id,
                        'nilai_sub_kriteria' => $item->subkriteria->nilai_subkriteria,
                        'faktor_id' => $item->subkriteria->kriteria->faktor_id,
                        'nilai_pemetaan_gap' =>  $item->subkriteria->nilai_subkriteria - $cariNilaiIdeal->nilai_ideal,
                    ];

                array_push($data, $itemPerhitungans);
            }

            array_push($dataPerhitungans, $data);
        }


        // Pembobotan GAP 

        $dataPembobotanGap  = [];


        foreach ($dataPerhitungans as $dataPerhitungan) {
            $dataGap  = [];

            foreach ($dataPerhitungan as $item) {
                $cariBobotGap = MasterGapValue::where('nilai_gap', $item['nilai_pemetaan_gap'])->first();
                $data = [
                    'id_alternatif' => $item['id_alternatif'],
                    'nama_alternatif' => $item['nama_alternatif'],
                    'kriteria_id' => $item['kriteria_id'],
                    'sub_kriteria' => $item['sub_kriteria'],
                    'nilai_sub_kriteria' => $item['nilai_sub_kriteria'],
                    'faktor_id' => $item['faktor_id'],
                    'nilai_pemetaan_gap' =>  $item['nilai_pemetaan_gap'],
                    'nilai_bobot_gap' => $cariBobotGap->bobot_nilai_kriteria,


                ];

                array_push($dataGap, $data);
            }
            array_push($dataPembobotanGap, $dataGap);
        }

        // Perhitungan Core dan Secondary Factor 

        $dataPembobotanGapCollection = collect($dataPembobotanGap);
        // dd($dataPembobotanGapCollection);

        $dataMapping = $dataPembobotanGapCollection->map(function ($query) {
            $filterCoreFaktor = collect($query)->filter(function ($item) {
                return $item['faktor_id'] == 1;
            });

            $filterSecondaryFaktor = collect($query)->filter(function ($item) {
                return $item['faktor_id'] == 2;
            });

            // dd($filterCoreFaktor,$filterSecondaryFaktor);

            $countCoreFaktor = $filterCoreFaktor->count();
            $countSecondaryFaktor = $filterSecondaryFaktor->count();


            $sumCoreFaktor = $filterCoreFaktor->sum('nilai_bobot_gap');
            $hasilCoreFaktor = $sumCoreFaktor /   $countCoreFaktor;

            $sumSecondaryFaktor = $filterSecondaryFaktor->sum('nilai_bobot_gap');
            $hasilSecondaryFaktor = $sumSecondaryFaktor /   $countSecondaryFaktor;

            return [
                'id_alternatif' => $query[0]['id_alternatif'],
                'nama_alternatif' => $query[0]['nama_alternatif'],
                'hasil_core_faktor' => $hasilCoreFaktor,
                'hasil_secondary_faktor' => $hasilSecondaryFaktor,
            ];
        });


        // hasilAkhir 

        $hasilAkhir = $dataMapping->map(function ($query) {
            $coreFaktorPresentase = MasterFactor::find(1)->bobot_faktor / 100;
            $secondaryFaktorPresentase = MasterFactor::find(2)->bobot_faktor / 100;


            return
                [
                    'id_alternatif' => $query['id_alternatif'],
                    'nama_alternatif' => $query['nama_alternatif'],
                    'total' => ($query['hasil_core_faktor'] * $coreFaktorPresentase) + ($query['hasil_secondary_faktor'] * $secondaryFaktorPresentase),

                ];
        });

        $hasilNilaiAkhir = collect($hasilAkhir);

        $hasilRanking = collect($hasilAkhir)->sortByDesc('total');
        $nilaiIdeal = MasterIdealValue::get()->sortBy('kriteria_id');


        $data['kriteria'] = MasterCriteria::get();
        $data['dataPerhitungans'] = $dataPerhitungans;
        $data['nilaiIdeal'] = $nilaiIdeal;
        $data['dataPembobotanGapCollection'] = $dataPembobotanGapCollection;
        $data['dataMapping'] = $dataMapping;
        $data['hasilRanking'] = $hasilRanking;
        $data['hasilNilaiAkhir'] = $hasilNilaiAkhir;


        return view('perhitungan.detail',$data);


    }

    public function index()
    {
        $countAlternatif = AlternativeData::where('is_checked',1)->count();
        $data['countAlternatif'] = $countAlternatif; 
        return view('perhitungan.perhitungan',$data);
    }
}
