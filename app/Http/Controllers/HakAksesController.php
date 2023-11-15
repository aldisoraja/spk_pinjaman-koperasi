<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class HakAksesController extends Controller
{

    /** 
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        //  untuk menampilkan list user dengan membawa data user  dengan roles nya
        $users =  User::with('role')->get();

        $checkJabatanKetua = User::where('jabatan', 'Ketua')->first();
        $checkJabatanSekretaris = User::where('jabatan', 'Sekretaris')->first();
        $checkJabatanPengawas = User::where('jabatan', 'Pengawas')->first();
        $checkJabatanBendahara = User::where('jabatan', 'Bendahara')->first();

        

        $roles = Role::get();
        $data = [
            'title' => 'List User',
            'users' => $users,
            'roles' => $roles,
            'ketua' => $checkJabatanKetua,
            'sekretaris' => $checkJabatanSekretaris,
            'pengawas' => $checkJabatanPengawas,
            'bendahara' => $checkJabatanBendahara


        ];
        // dd($users);
        return view('hak_akses.hakakses', $data);
    }



    //fungsi untuk menampilkan form reset password sesuai dengan id yang diambil oleh admin
    public function showResetPassword($id)
    {
        $this->authorize('isAdmin');
        $getEmail = User::find($id);

        return view('passwordReset', [
            "title" => "Reset Password",
            'getUser' => $getEmail
        ]);
    }

    //fungsi untuk melakukan update password sesuai dengan id yang dipilih oleh admin
    public function updatePassword(Request $request, $id)
    {
        $this->authorize('isAdmin');
        $request->validate([
            'new_password' => 'required|string|min:8|confirmed'
        ]);

        User::where('id', $request->id)
            ->update(['password' => Hash::make($request->new_password)]);

        return redirect()->route('list.user')->with("status", "success change password");
    }

    public function registerUser(Request $request)
    {
        $this->authorize('isAdmin');
        $title = "Tambah User";

        $data['title'] = $title;
        return view('hak_akses.create', $data);
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
            'no_anggota' => 'required',
            'name' => 'required|string',
            'username' => 'required|string',
            'jabatan' => 'required|string',
            'password' => 'required',
            'role_id' => 'required',
        ]);

        // if($request->jabatan == "Ketua" || $request->jabatan == "Sekretaris")
        // {

        //     $checkJabatan = User::where('jabatan',$request->jabatan)->first();
        //     if($checkJabatan)
        //     {
        //         return redirect()->route('hak-akses.index')->with('error', 'Jabatan sudah terisi!');
        //     }
        // }
        $user = User::create([
            'no_anggota' => $request->no_anggota,
            'name' => $request->name,
            'username' => $request->username,
            'jabatan' => $request->jabatan,
            'password' => Hash::make($request->password),
            'role_id' => $request->role_id,
        ]);

        if ($user) {
            return redirect()->route('hak-akses.index')->with('success', 'Data berhasil ditambahkan!');
        } else {
            return redirect()->route('hak-akses.index')->with('error', 'Data gagal ditambahkan!');
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
        $user  = User::findOrFail($id);
        $roles = Role::all();
        $checkJabatanKetua = User::where('jabatan', 'Ketua')->first();
        $checkJabatanSekretaris = User::where('jabatan', 'Sekretaris')->first();
        $checkJabatanPengawas = User::where('jabatan', 'Pengawas')->first();
        $checkJabatanBendahara = User::where('jabatan', 'Bendahara')->first();

        return view('hak_akses.hak_akses_edit', [
            "title" => "Edit User"
        ], compact('user', 'roles', 'checkJabatanKetua', 'checkJabatanSekretaris', 'checkJabatanPengawas', 'checkJabatanBendahara'));
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
            'nama' => 'required',
            'jabatan' => 'required',
            'role_id' => 'required',

        ]);

       

        // mencari data di user sesuai id
        $hakAkses = User::findOrFail($id);


        $hakAkses->update([
            'name' => $request->nama,
            'jabatan' => $request->jabatan,
            'role_id' => $request->role_id,
        ]);

        if ($hakAkses) 
        {
            return redirect()->route('hak-akses.index')->with('success', 'Data berhasil disimpan!');
        } else {
            return redirect()->route('hak-akses.edit', $id)->with('error', 'Data gagal disimpan!');
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
        $user = User::find($id);
        $user->delete();
        // lalu delete user berdasarkan id
        // dd($user);
        // $haj->delete();
        return redirect()->route('hak-akses.index')->with('success', 'User telah dihapus!');


    }

    public function deleteUser(Request $request, $id)
    {
        // mencari user berdasarkan id 
        // $haj = User::findOrFail($id);
        DB::table('users')->where('id',$id)->delete();

        // lalu delete user berdasarkan id
        // dd($user);
        // $haj->delete();

        // redirect 

        return redirect()->route('indeks-hak-akses')->with('success', 'User deleted!');
    }

}
