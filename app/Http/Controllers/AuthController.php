<?php

namespace App\Http\Controllers;

use App\Models\SuratModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Hash;


class AuthController extends Controller
{
    public function login()
    {
        if (!empty(Auth::check())) {
            return redirect('panel/dashboard');
        }
        // dd(Hash::make(12345678));
        return view('auth.login');
    }

    public function auth_login(Request $request)
    {
        $remember = !empty($request->remember) ? true : false;
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $remember)) {
            $user = Auth::user();
            switch ($user->role->name) {
                case 'Admin':
                    $message = "Selamat datang, {$user->name}! Kelola sistem dengan baik.";
                    break;
                case 'Sekretaris 1':
                    $message = "Halo {$user->name}! Pantau surat yang perlu diverifikasi.";
                    break;
                case 'Sekretaris 2':
                    $message = "Halo {$user->name}! Pantau surat yang perlu diverifikasi.";
                    break;
                case 'Ketua':
                    $message = "Selamat datang, {$user->name}!";
                    break;
                default:
                    $message = "Selamat datang di sistem!";
                    break;
            }
            session()->flash('login_success', $message);
            // session()->flash('notif_surat', $jumlahSuratPending);


            return redirect('panel/dashboard');
        } else {
            return redirect()->back()->with('error', "Please enter correct email or password");
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect(url(''));
    }
}
