<?php

namespace App\Http\Controllers;

use App\Models\Kabupaten;
use App\Models\Mahasiswa;
use App\Models\Provinsi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function index()
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        } else if (auth()->user()->role == "admin") {
            return redirect('/admin/index');
        } else if (auth()->user()->role == "mahasiswa") {
            return redirect('/mahasiswa/index');
        } else {
            Auth::logout();
            request()->session()->invalidate();
            request()->session()->regenerateToken();
            return redirect('/');
        }
    }

    public function login()
    {
        return view('auth.login', [
            'title' => 'login'
        ]);
    }

    public function register()
    {
        return view('auth.register', [
            'title' => 'Registrasi',
            'data_provinsi' => Provinsi::all(),
        ]);
    }

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

        return redirect('/login')->with('success', 'Menunggu Verifikasi dari admin!');
    }


    /**
     * Handle an authentication attempt.
     */
    public function authenticate(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required'],
            'password' => ['required'],
        ]);

        $user = User::where('email', $credentials['email'])->first();

        if ($user && !$user->admin_verified_at && $user->role == 'mahasiswa') {
            return back()->with('loginError', 'Akun Anda belum diverifikasi oleh admin.');
        }

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            switch (auth()->user()->role) {
                case 'admin':
                    return redirect()->intended('/admin/index');
                    break;
                case 'mahasiswa':
                    $mahasiswa = Mahasiswa::where('user_id', auth()->user()->id)->first();
                    $request->session()->put('mahasiswa', $mahasiswa);
                    $request->session()->put('mahasiswa_id', $mahasiswa->id);
                    return redirect()->intended('/mahasiswa/index');
                    break;
                default:
                    Auth::logout();
                    $request->session()->invalidate();
                    $request->session()->regenerateToken();
                    return back()->with('loginError', 'Akun Anda tidak memiliki otoritas apapun, Hubungi Admin terkait');
                    # code...
                    break;
            }
        }

        return back()->with('loginError', 'Email atau Password Salah');
    }

    public function updatePhoto(Request $request, User $user)
    {
        $user->update([
            'foto' => $request->nama_foto
        ]);
        return back()->with('success', 'Foto Berhasil diperbarui');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    public function resetPassword(Request $request, User $user)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('login')->with('status', __($status))
            : back()->withErrors(['email' => [__($status)]]);
    }


    public function getKabupaten($provinsi_id)
    {
        $kabupatenData = Kabupaten::where('provinsi_id', $provinsi_id)->get();

        return response()->json($kabupatenData);
    }
}
