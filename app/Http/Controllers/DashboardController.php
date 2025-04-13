<?php

namespace App\Http\Controllers;

use App\Models\SuratModel;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();
        // $now = SuratModel::where('status', 'is_ok')->count();
        // $now++;

        $jumlahIsOk = SuratModel::where('status', 'is_ok')->count();
        $jumlahRejected = SuratModel::where('status', 'rejected')->count();
        $jumlahPending = SuratModel::whereIn('status', ['pending', 'accepted', 'completed'])->count();


        switch ($user->role->id) {
            case 2:
                $jumlahSuratPending = SuratModel::where('status', 'completed')->count();
                break;
            case 3:
                $jumlahSuratPending = SuratModel::where('status', 'pending')->count();
                break;
            case 37:
                $jumlahSuratPending = SuratModel::where('status', 'accepted')->count();
                break;
            default:
                $jumlahSuratPending = '';
                break;
        }
        session()->flash('notif_surat', $jumlahSuratPending);
        return view('panel.dashboard', compact('jumlahIsOk', 'jumlahRejected', 'jumlahPending', 'jumlahSuratPending'));
    }
}
