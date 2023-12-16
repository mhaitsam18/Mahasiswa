<?php

namespace App\Http\Controllers;

use App\Models\Kabupaten;
use App\Models\Mahasiswa;
use App\Models\Provinsi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;




class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.mahasiswa.index',  [
            'title' => 'Data mahasiswa',
            'page' => 'mahasiswa',
            'data_mahasiswa' => Mahasiswa::latest()->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.mahasiswa.create',  [
            'title' => 'Tambah mahasiswa',
            'page' => 'mahasiswa',
            'data_provinsi' => Provinsi::all(),
            'data_kabupaten' => Kabupaten::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_lengkap' => 'required',
            'alamat_ktp' => 'required',
            'alamat_domisili' => 'required',
            'kabupaten_id' => 'required',
            'kecamatan' => 'required',
            'nomor_telepon' => 'required',
            'nomor_hp' => 'required',
            'email' => 'required|email:dns|unique:users',
            'kewarganegaraan' => 'required',
            'wna' => '',
            'tanggal_lahir' => 'required',
            'negara_tempat_lahir' => '',
            'provinsi_tempat_lahir' => 'required',
            'kota_tempat_lahir' => 'required',
            'jenis_kelamin' => 'required',
            'status_menikah' => 'required',
            'agama' => 'required',
            'password' => 'required|confirmed',
        ]);
        $validatedData['password'] = Hash::make($validatedData['password']);
        $validatedData['role'] = 'mahasiswa';

        if ($request->file('foto')) {
            $validatedData['foto'] = $request->file('foto')->store('foto-profil');
        };

        $user = User::create([
            'name' => $request->nama_lengkap,
            'email' => $request->email,
            'password' => $validatedData['password'],
            'role' => 'mahasiswa',
            'foto' => $validatedData['foto'],

        ]);

        $validatedMahasiswa['user_id'] = $user->id;


        Mahasiswa::create([
            'user_id' => $user->id,
            'nama_lengkap' => $request->nama_lengkap,
            'alamat_ktp' => $request->alamat_ktp,
            'alamat_domisili' => $request->alamat_domisili,
            'kabupaten_id' => $request->kabupaten_id,
            'kecamatan' => $request->kecamatan,
            'nomor_telepon' => $request->nomor_telepon,
            'nomor_hp' => $request->nomor_hp,
            'email' => $request->email,
            'kewarganegaraan' => $request->kewarganegaraan,
            'wna' => $request->wna,
            'tanggal_lahir' => $request->tanggal_lahir,
            'negara_tempat_lahir' => $request->negara_tempat_lahir,
            'provinsi_tempat_lahir' => $request->provinsi_tempat_lahir,
            'kota_tempat_lahir' => $request->kota_tempat_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'status_menikah' => $request->status_menikah,
            'agama' => $request->agama,
            'foto' => $validatedData['foto'],
        ]);

        return redirect('/admin/mahasiswa')->with('success', 'Data Mahasiswa ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Mahasiswa $mahasiswa)
    {
        return view('admin.mahasiswa.show',  [
            'title' => 'Detail mahasiswa',
            'page' => 'mahasiswa',
            'mahasiswa' => $mahasiswa,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Mahasiswa $mahasiswa)
    {
        return view('admin.mahasiswa.edit', [
            'title' => 'Edit Mahasiswa',
            'page' => 'mahasiswa',
            'mahasiswa' => $mahasiswa,
            'data_provinsi' => Provinsi::all(),
            'data_kabupaten' => Kabupaten::all(),
        ]);
    }

    public function verify(Mahasiswa $mahasiswa)
    {
        if ($mahasiswa->user_id) {
            User::find($mahasiswa->user_id)->update([
                'admin_verified_at' => now()
            ]);
            return back()->with('success', 'Mahasiswa telah diverifikasi.');
        } else {
            return back()->with('error', 'User ID mahasiswa tidak valid.');
        }
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Mahasiswa $mahasiswa)
    {
        $request->validate([
            'nama_lengkap' => 'required',
            'email' => [
                'required',
                'email:dns',
                Rule::unique('users')->ignore($mahasiswa->user_id),
            ],
            'alamat_ktp' => 'required',
            'alamat_domisili' => 'required',
            'kabupaten_id' => 'required',
            'kecamatan' => 'required',
            'nomor_telepon' => 'required',
            'nomor_hp' => 'required',
            'kewarganegaraan' => 'required',
            'wna' => '',
            'tanggal_lahir' => 'required',
            'negara_tempat_lahir' => '',
            'provinsi_tempat_lahir' => 'required',
            'kota_tempat_lahir' => 'required',
            'jenis_kelamin' => 'required',
            'status_menikah' => 'required',
            'agama' => 'required',
            'foto' => 'required',
        ]);


        if ($request->file('foto')) {
            $foto = $request->file('foto')->store('foto-profil');
        }
        $mahasiswa->update([
            'nama_lengkap' => $request->nama_lengkap,
            'alamat_ktp' => $request->alamat_ktp,
            'alamat_domisili' => $request->alamat_domisili,
            'kabupaten_id' => $request->kabupaten_id,
            'kecamatan' => $request->kecamatan,
            'nomor_telepon' => $request->nomor_telepon,
            'nomor_hp' => $request->nomor_hp,
            'email' => $request->email,
            'kewarganegaraan' => $request->kewarganegaraan,
            'wna' => $request->wna,
            'tanggal_lahir' => $request->tanggal_lahir,
            'negara_tempat_lahir' => $request->negara_tempat_lahir,
            'provinsi_tempat_lahir' => $request->provinsi_tempat_lahir,
            'kota_tempat_lahir' => $request->kota_tempat_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'status_menikah' => $request->status_menikah,
            'agama' => $request->agama,
            'foto' => $foto ?? $request->foto,
        ]);

        $user = User::find($mahasiswa->user_id);
        $user->update([
            'name' => $request->nama_lengkap,
            'email' => $request->email,
        ]);
        return redirect('/admin/mahasiswa')->with('success', 'Data mahasiswa diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Mahasiswa $mahasiswa)
    {
        User::find($mahasiswa->user_id)->delete();
        $mahasiswa->delete();
        return back()->with('success', 'Data Mahasiswa dihapus');
    }
}
