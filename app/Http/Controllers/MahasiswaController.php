<?php

namespace App\Http\Controllers;

use App\Models\Kabupaten;
use App\Models\Mahasiswa;
use App\Models\Provinsi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class MahasiswaController extends Controller
{
    public function index()
    {
        return view('mahasiswa.index', [
            'title' => 'Dashboard',
            'page' => 'index',
            'mahasiswa' => auth()->user()->mahasiswa,
            'data_provinsi' => Provinsi::all(),
            'data_kabupaten' => Kabupaten::all(),
        ]);
    }

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
            'foto' => $foto ?? $request->foto,
        ]);
        return back()->with('success', 'Data mahasiswa diperbarui');
    }
}
