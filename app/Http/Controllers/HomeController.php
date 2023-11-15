<?php

namespace App\Http\Controllers;

use App\Models\AlternativeData;
use App\Models\MasterCriteria;
use App\Models\MasterSubCriteria;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $kriteria = MasterCriteria::all()->count();
        $subKriteria = MasterSubCriteria::all()->count();
        $alternatif = AlternativeData::all()->count();
        $users = User::all()->count();

        $data['countKriteria'] = $kriteria;
        $data['countsubKriteria']= $subKriteria;
        $data['countAlternatif']= $alternatif ;
        $data['countUser']= $users ;


        return view('dashboard',$data);
    }
}
