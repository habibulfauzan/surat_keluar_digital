<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\SuratController;
use App\Models\SuratModel;

// Route untuk menampilkan form



Route::get('/', [AuthController::class, 'login']);
Route::post('/', [AuthController::class, 'auth_login']);

Route::get('logout', [AuthController::class, 'logout']);

Route::group(['middleware' => 'useradmin'], function () {
    Route::get('panel/dashboard', [DashboardController::class, 'dashboard']);


    Route::get('panel/role', [RoleController::class, 'list']);
    Route::get('panel/role/add', [RoleController::class, 'add']);
    Route::post('panel/role/add', [RoleController::class, 'insert']);
    Route::get('panel/role/edit/{id}', [RoleController::class, 'edit']);
    Route::post('panel/role/edit/{id}', [RoleController::class, 'update']);
    Route::get('panel/role/delete/{id}', [RoleController::class, 'delete']);


    Route::get('panel/user', [UserController::class, 'list']);
    Route::get('panel/user/add', [UserController::class, 'add']);
    Route::post('panel/user/add', [UserController::class, 'insert']);
    Route::get('panel/user/edit/{id}', [UserController::class, 'edit']);
    Route::post('panel/user/edit/{id}', [UserController::class, 'update']);
    Route::get('panel/user/delete/{id}', [UserController::class, 'delete']);

    Route::get('panel/surat', [SuratController::class, 'list'])->name('surat.index');
    Route::get('panel/surat/all', [SuratController::class, 'all']);
    Route::get('panel/surat/add_undangan', [SuratController::class, 'surat_undangan']);
    Route::get('panel/surat/add_pengantar', [SuratController::class, 'surat_pengantar']);
    Route::get('panel/surat/add_tugas', [SuratController::class, 'surat_tugas']);
    Route::get('panel/surat/add_lainnya', [SuratController::class, 'surat_lainnya']);

    Route::post('/addUndangan', [SuratController::class, 'addUndangan'])->name('add.Undangan');
    Route::post('/addPengantar', [SuratController::class, 'addPengantar'])->name('add.pengantar');
    Route::post('/addTugas', [SuratController::class, 'addTugas'])->name('add.tugas');
    Route::post('/addManual', [SuratController::class, 'addManual'])->name('add.manual');
    Route::post('/addLainnya', [SuratController::class, 'addLainnya'])->name('add.lainnya');

    Route::put('/panel/surat/update-status/{id}', [SuratController::class, 'updateStatus'])->name('surat.updateStatus');

    Route::get('panel/surat/selesai', [SuratController::class, 'selesai']);
    Route::get('panel/surat/ditolak', [SuratController::class, 'ditolak']);

    //NOTIF ROLE
    Route::get('/notif-surat', function () {
        $user = Auth::user();
        $jumlahSuratPending = match ($user->role->name) {
            'Sekretaris 1' => SuratModel::where('status', 'pending')->count(),
            'Sekretaris 2' => SuratModel::where('status', 'accepted')->count(),
            'Ketua' => SuratModel::where('status', 'completed')->count(),
            default => '',
        };
        return response()->json($jumlahSuratPending);
    })->name('notif.surat');

    //NOTIF PEMBUAT SURAT
    Route::get('/ok-surat', function () {
        $user = Auth::user();
        // Hitung jumlah surat dengan status 'completed'
        $jumlahCompleted  = match ($user->role->name) {
            'Pembuat Surat' => SuratModel::where('status', 'is_ok')->count(),
            default => '',
        };
        // Ambil nilai terakhir dari session (default 0 jika tidak ada)
        $completedSebelumnya = session('last_completed_' . $user->id, 0);

        // Hitung selisih completed baru
        $completedBaru = max(0, $jumlahCompleted  - $completedSebelumnya);

        // Simpan jumlah terbaru ke session
        session(['last_completed_' . $user->id => $jumlahCompleted]);

        return response()->json($completedBaru);
    })->name('notif.completed');
});
