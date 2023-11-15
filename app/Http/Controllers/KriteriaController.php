<?php

namespace App\Http\Controllers;
use App\Models\MasterFactor;
use App\Models\MasterCriteria;
use Illuminate\Support\Facades\Auth;



use Illuminate\Http\Request;

class KriteriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'factors' => MasterFactor::all(),
            'kriterias' => MasterCriteria::with('faktor')->get()
        ];

        return view('kriteria.criteria', $data);
       
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
            'kode_kriteria' => 'required',
            'nama_kriteria' => 'required|string',
            'faktor_id' => 'required',
        ]);

        $kriteria = MasterCriteria::create([
            'kode_kriteria' => $request->kode_kriteria,
            'nama_kriteria' => $request->nama_kriteria,
            'faktor_id' => $request->faktor_id
        ]);

        if ($kriteria) {
            return redirect()->route('criteria.index')->with('success', 'Data berhasil ditambahkan!');
        } else {
            return redirect()->route('criteria.index')->with('error', 'Data gagal ditambahkan!');
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
            'kriteria' => MasterCriteria::find($id),
            'factors' => MasterFactor::all(),
        ];

        // dd($data);
        return view('kriteria.criteria-edit', $data);
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
            'nama_kriteria' => 'required',
            'faktor_id' => 'required',
        ]);

        $kriteria = MasterCriteria::all()->where('id', $id)->firstOrFail();

        $kriteria->update([
            'nama_kriteria' => $request->nama_kriteria,
            'faktor_id' => $request->faktor_id,
        ]);

        if ($kriteria){
            return redirect()->route('criteria.index')->with('success', 'Data berhasil disimpan!');
        } else {
            return redirect()->route('criteria.edit', $id)->with('error', 'Data gagal disimpan!');
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
        $kriteria = MasterCriteria::find($id);
        $kriteria->delete();

        return redirect()->route('criteria.index')->with('success', 'Data berhasil dihapus !');
    }
}
