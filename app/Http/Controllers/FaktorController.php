<?php

namespace App\Http\Controllers;

use App\Models\MasterFactor;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FaktorController extends Controller
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
        ];

       
        return view('faktor.factor', $data);
        
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
        $validatedData = $request->validate([
            'nama_faktor' => 'required',
            'bobot_faktor' => 'required|numeric'
        ]);

        // cek 100 %
        $cekBobot = MasterFactor::get()->sum('bobot_faktor');

        if ($cekBobot >= 100)
        {
            return redirect()->route('faktor.index')->with('error', 'Bobot faktor tidak boleh lebih dari 100%!');
        }

        $faktor = new MasterFactor($validatedData);
        $faktor->save();

        if ($faktor) {
            return redirect()->route('faktor.index')->with('success', 'Data berhasil ditambahkan!');
        } else {
            return redirect()->route('faktor.index')->with('error', 'Data gagal ditambahkan!');
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
            'faktor' => MasterFactor::find($id),
        ];

        return view('faktor.factor-edit', $data);

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
            
            'bobot_faktor' => 'required|numeric',
        ]);

        // cek 100 %
        $cekBobot = MasterFactor::whereNotIn('id',[$id])->get()->sum('bobot_faktor');


        if ($cekBobot + $request->bobot_faktor > 100) 
        {
            return redirect()->route('criteria.index')->with('error', 'Bobot faktor tidak boleh lebih dari 100%!');
        }

        $faktor = MasterFactor::all()->where('id', $id)->firstOrFail();

        $faktor->update([
            'bobot_faktor' => $request->bobot_faktor,
        ]);

        if ($faktor){
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
        $faktor = MasterFactor::find($id);
        $faktor->delete();

        return redirect()->route('faktor.index')->with('success', 'Data berhasil dihapus !');
    }
}
