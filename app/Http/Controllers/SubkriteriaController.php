<?php

namespace App\Http\Controllers;

use App\Models\MasterCriteria;
use App\Models\MasterSubCriteria;
use Illuminate\Http\Request;

class SubkriteriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'subkriterias' => MasterSubCriteria::with('kriteria')->get(),
            'kriterias' => MasterCriteria::all(),
        ];

        return view('sub_kriteria.subkriteria', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->nilai_subkriteria == 1){

            $keterangan = "Kurang";
        } elseif($request->nilai_subkriteria == 2){

            $keterangan = "Cukup";
        } elseif($request->nilai_subkriteria == 3){

            $keterangan = "Cukup Baik";
        } elseif($request->nilai_subkriteria == 4){

            $keterangan = "Baik";
        } elseif($request->nilai_subkriteria == 5){

            $keterangan = "Sangat Baik";
        }

        $this->validate($request, [
            'kriteria_id' => 'required',
            'nama_subkriteria' => 'required|string',
            'nilai_subkriteria' => 'required|numeric',
        ]);
        
        $subkriteria = MasterSubCriteria::create([
            'kriteria_id' => $request->kriteria_id,
            'nama_subkriteria' => $request->nama_subkriteria,
            'nilai_subkriteria' => $request->nilai_subkriteria,
            'keterangan_subkriteria' => $keterangan
        ]);

        if ($subkriteria) {
            return redirect()->route('subkriteria.index')->with('success', 'Data berhasil ditambahkan!');
        } else {
            return redirect()->route('subkriteria.index')->with('error', 'Data gagal ditambahkan!');
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = [
            'subkriteria' => MasterSubCriteria::find($id),
            'kriterias' => MasterCriteria::all(),
        ];

        return view('sub_kriteria.subkriteria-edit', $data);
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
        if($request->nilai_subkriteria == 1){

            $keterangan = "Kurang";
        } elseif($request->nilai_subkriteria == 2){

            $keterangan = "Cukup";
        } elseif($request->nilai_subkriteria == 3){

            $keterangan = "Cukup Baik";
        } elseif($request->nilai_subkriteria == 4){

            $keterangan = "Baik";
        } elseif($request->nilai_subkriteria == 5){

            $keterangan = "Sangat Baik";
        }

        $this->validate($request, [
            'kriteria_id' => 'required',
            'nama_subkriteria' => 'required|string',
            'nilai_subkriteria' => 'required|numeric',
        ]);

        $subkriteria = MasterSubCriteria::all()->where('id', $id)->firstOrFail();

        $subkriteria->update([
            'kriteria_id' => $request->kriteria_id,
            'nama_subkriteria' => $request->nama_subkriteria,
            'nilai_subkriteria' => $request->nilai_subkriteria,
            'keterangan_subkriteria' => $keterangan
        ]);

        if ($subkriteria){
            return redirect()->route('subkriteria.index')->with('success', 'Data berhasil disimpan!');
        } else {
            return redirect()->route('subkriteria.edit', $id)->with('error', 'Data gagal disimpan!');
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
        $kriteria = MasterSubCriteria::find($id);
        $kriteria->delete();

        return redirect()->route('subkriteria.index')->with('success', 'Data berhasil dihapus !');
    }
}
