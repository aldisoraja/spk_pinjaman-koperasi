<?php

namespace App\Http\Controllers;

use App\Models\MasterCriteria;
use App\Models\MasterIdealValue;
use Illuminate\Http\Request;

class NilaiIdealController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $nilaiIdeal = MasterIdealValue::get();
        $kriterias = MasterCriteria::get();

        $valueNilai = [1,2,3,4,5];

        $data['valueNilai'] = $valueNilai;
        $data['nilaiIdeal'] = $nilaiIdeal;
        $data['kriterias'] = $kriterias;

        return view('nilai_ideal.nilai_ideal', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
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
            'kriteria' => 'required',
            'nilai_ideal' => 'required',
        ]);

        $nilaiIdeal = MasterIdealValue::create([
            'kriteria_id' => $request->kriteria,
            'nilai_ideal' => $request->nilai_ideal,
        ]);

        if ($nilaiIdeal) {
            return redirect()->route('nilai-ideal')->with('success', 'Data berhasil ditambahkan!');
        } else {
            return redirect()->route('nilai-ideal')->with('error', 'Data gagal ditambahkan!');
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
        $nilaiIdeal = MasterIdealValue::findorFail($id);
        $kriterias = MasterCriteria::get();

        $valueNilai = [1, 2, 3, 4, 5];

        $data['valueNilai'] = $valueNilai;
        $data['nilaiIdeal'] = $nilaiIdeal;
        $data['kriterias'] = $kriterias;
        return view('nilai_ideal.nilai_ideal_edit', $data);
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
            'nilai_ideal' => 'required',
        ]);

        $nilaiIdeal = MasterIdealValue::findOrFail($id);


        $nilaiIdeal->update(
            [
                'nilai_ideal' => $request->nilai_ideal,
            ]
        );


        if ($nilaiIdeal) {
            return redirect()->route('nilai-ideal')->with('success', 'Data berhasil diupdate!');
        } else {
            return redirect()->route('nilai-ideal-edit', $id)->with('error', 'Data gagal diupdate!');
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
        $nilaiIdeal = MasterIdealValue::findOrFail($id);
        $nilaiIdeal->delete();

        return redirect()->route('nilai-ideal')->with('success', 'Data berhasil dihapus !');
    }
}
