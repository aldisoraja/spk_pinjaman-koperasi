<?php

namespace App\Http\Controllers;

use App\Models\MasterGapValue;
use Illuminate\Http\Request;

class NilaiGapController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $nilaiGap = MasterGapValue::get();

        $data['nilaiGap'] = $nilaiGap;
        return view('bobotnilaigap', $data);
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
        $this->validate($request, [
            'selisih' => 'required',
            'bobot_nilai' => 'required',
            'keterangan' => 'required',
        ]);

        $gapValue = MasterGapValue::create([
            'nilai_gap' => $request->selisih,
            'bobot_nilai_kriteria' => $request->bobot_nilai,
            'keterangan' => $request->keterangan
        ]);

        if ($gapValue) {
            return redirect()->route('bobot-nilai-gap')->with('success', 'Data berhasil ditambahkan!');
        } else {
            return redirect()->route('bobot-nilai-gap')->with('error', 'Data gagal ditambahkan!');
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
            'gapValue' => MasterGapValue::find($id),
        ];

        // dd($data);
        return view('bobotnilaigap-edit', $data);
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
            'selisih' => 'required',
            'bobot_nilai' => 'required',
            'keterangan' => 'required',
        ]);

        $gapValue = MasterGapValue::findOrFail($id);

        $gapValue->update(
            [
            'nilai_gap' => $request->selisih,
            'bobot_nilai_kriteria' => $request->bobot_nilai,
            'keterangan' => $request->keterangan
        ]);


        if ($gapValue) {
            return redirect()->route('bobot-nilai-gap')->with('success', 'Data berhasil disimpan!');
        } else {
            return redirect()->route('bobot-nilai-gap-edit',$id)->with('error', 'Data gagal disimpan!');
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

        $gapValue = MasterGapValue::find($id);
        $gapValue->delete();

        return redirect()->route('bobot-nilai-gap')->with('success', 'Data berhasil dihapus !');
    }
}
