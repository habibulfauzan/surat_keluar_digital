<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpOffice\PhpWord\TemplateProcessor;
use App\Models\SuratModel;
use Illuminate\Support\Facades\Auth;
use App\Models\PermissionRoleModel;
use chillerlan\QRCode\QRCode;
use chillerlan\QRCode\QROptions;
use NcJoes\OfficeConverter\OfficeConverter;
use Carbon\Carbon;


class SuratController extends Controller
{
    private $allowedStatuses = ['pending', 'accepted', 'completed', 'rejected', 'is_ok'];

    public function list()
    {
        $PermissionRole = PermissionRoleModel::getPermission('Surat Keluar', Auth::user()->role_id);
        if (empty($PermissionRole)) {
            abort(404);
        }

        $data['PermissionAction'] = PermissionRoleModel::getPermission('Action Surat', Auth::user()->role_id);
        $data['PermissionDelSurat'] = PermissionRoleModel::getPermission('Delete Surat', Auth::user()->role_id);
        // $data['PermissionDelete'] = PermissionRoleModel::getPermission('Delete Role', Auth::user()->role_id);
        $data['getRecord'] = SuratModel::getRecord();
        return view('panel.surat.list', $data);
    }

    public function all()
    {
        $data['getRecord'] = SuratModel::getRecord();
        return view('panel.surat.all', $data);
    }

    public function surat_undangan()
    {
        return view('panel/surat/add_undangan');
    }
    public function surat_pengantar()
    {
        return view('panel/surat/add_pengantar');
    }

    public function surat_tugas()
    {
        return view('panel/surat/add_tugas');
    }

    public function surat_lainnya()
    {
        return view('panel/surat/add_lainnya');
    }
    // SURAT UNDANGAN
    public function addUndangan(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|after_or_equal:' . Carbon::now(),
        ]);
        // Ambil data dari form
        $nomor = $request->nomor;
        $template_nomor = $request->template_nomor;
        $kepada = $request->kepada;
        $hal = $request->hal;
        $kegiatan = $request->kegiatan;
        $jam = $request->jam;
        $tanggal = $request->tanggal;
        $hari = $this->getDate($tanggal);
        $tempat = $request->tempat;

        // Path ke template dokumen
        $templatePath = storage_path('app/public/template_surat/surat_undangan.docx');

        // Buat objek TemplateProcessor
        $templateProcessor = new TemplateProcessor($templatePath);

        // Ganti placeholder dengan data dinamis
        $templateProcessor->setValue('nomor', $nomor);
        $templateProcessor->setValue('kepada', $kepada);
        $templateProcessor->setValue('hal', $hal);
        $templateProcessor->setValue('kegiatan', $kegiatan);
        $templateProcessor->setValue('hari', $hari);
        $templateProcessor->setValue('jam', $jam);
        $templateProcessor->setValue('tanggal', date('d F Y', strtotime($tanggal)));
        $templateProcessor->setValue('tempat', $tempat);
        $templateProcessor->setValue('date', date('d F Y'));
        $templateProcessor->setValue('no_bulan', date('m'));
        $templateProcessor->setValue('no_tahun', date('Y'));

        // Simpan dokumen ke file sementara
        $fileName = $nomor . '_' . $hal . '.docx';
        $tempFile = storage_path('app/public/draft_surat/' . $fileName);
        $templateProcessor->saveAs($tempFile);
        // Simpan data ke database
        SuratModel::create([
            'nomor' => $request->nomor,
            'template_nomor' => 'Un.04/Ka.LPM/PP.00.9',
            'nama' => $request->hal,
            'kepada' => $request->kepada,
            // 'surat_id' => '1',
            'file_path' => 'draft_surat/' . $fileName, // Simpan path file ke database
        ]);
        // Download dokumen
        // return response()->download($tempFile, $fileName)->deleteFileAfterSend(true);
        return redirect('panel/surat/add_undangan')->with('success', 'Surat Berhasil Dibuat.');
    }

    //SURAT PENGANTAR
    public function addPengantar(Request $request)
    {
        // dd($request->all());
        // Validasi input
        $request->validate([
            'nomor' => 'required|string',
            'barang' => 'required|array',
            'barang.*.nama' => 'required|string',
            'barang.*.jumlah' => 'required|numeric',
        ]);

        // Ambil data dari form
        $barang = $request->input('barang');
        $nomor = $request->nomor;
        $kepada = $request->kepada;
        $hal = $request->hal;

        // Proses template
        $templateProcessor = new TemplateProcessor(storage_path('app/public/template_surat/surat_pegantar.docx'));

        // Isi data utama
        $templateProcessor->setValue('nomor', $nomor);
        $templateProcessor->setValue('kepada', $kepada);
        $templateProcessor->setValue('date', date('d F Y'));
        $templateProcessor->setValue('no_bulan', date('m'));
        $templateProcessor->setValue('no_tahun', date('Y'));

        // Clone row tabel
        $templateProcessor->cloneRow('row.no', count($barang));

        // Isi data barang
        foreach ($barang as $index => $item) {
            $rowNumber = $index + 1;
            $templateProcessor->setValue("row.no#$rowNumber", $rowNumber);
            $templateProcessor->setValue("row.isi#$rowNumber", $item['nama']);
            $templateProcessor->setValue("row.jumlah#$rowNumber", $item['jumlah']);
            $templateProcessor->setValue("row.keterangan#$rowNumber", $item['keterangan']);
        }

        // Simpan dokumen ke file sementara
        $fileName = $nomor . '_' . $hal . '.docx';
        $tempFile = storage_path('app/public/draft_surat/' . $fileName);
        $templateProcessor->saveAs($tempFile);
        // Simpan data ke database
        SuratModel::create([
            'nomor' => $request->nomor,
            'template_nomor' => 'Un.04/Ka.LPM/PP.00.9',
            'nama' => $request->hal,
            'kepada' => $request->kepada,
            // 'surat_id' => '2',
            'file_path' => 'draft_surat/' . $fileName, // Simpan path file ke database
        ]);
        // Download file
        return redirect('panel/surat/add_pengantar')->with('success', 'Surat Pengantar Berhasil Dibuat.');
        // return response()->download(storage_path('app/public/draft_surat/' . $filename))->deleteFileAfterSend(false);
    }

    //SURAT addTugas
    public function addTugas(Request $request)
    {
        // dd($request->all());
        // Ambil data dari form
        $anggota = $request->input('anggota');
        $nomor = $request->nomor;
        $dasar = $request->dasar;
        $untuk = $request->untuk;

        // Proses template
        $templateProcessor = new TemplateProcessor(storage_path('app/public/template_surat/surat_tugas.docx'));

        // Isi data utama
        $templateProcessor->setValue('nomor', $nomor);
        $templateProcessor->setValue('dasar', $dasar);
        $templateProcessor->setValue('untuk', $untuk);
        $templateProcessor->setValue('date', date('d F Y'));
        $templateProcessor->setValue('no_bulan', date('m'));
        $templateProcessor->setValue('no_tahun', date('Y'));

        // Clone row tabel
        $templateProcessor->cloneRow('row.no', count($anggota));

        // Isi data barang
        foreach ($anggota as $index => $item) {
            $rowNumber = $index + 1;
            $templateProcessor->setValue("row.no#$rowNumber", $rowNumber);
            $templateProcessor->setValue("row.nama#$rowNumber", $item['nama']);
            $templateProcessor->setValue("row.nip#$rowNumber", $item['nip']);
            $templateProcessor->setValue("row.pangkat#$rowNumber", $item['pangkat']);
            $templateProcessor->setValue("row.jabatan#$rowNumber", $item['jabatan']);
        }

        // Simpan dokumen ke file sementara
        $fileName = $nomor . '_' . $nomor . '.docx';
        $tempFile = storage_path('app/public/draft_surat/' . $fileName);
        $templateProcessor->saveAs($tempFile);
        // Simpan data ke database
        SuratModel::create([
            'nomor' => $request->nomor,
            'template_nomor' => 'Un.04/Ka.LPM/HM.01',
            'nama' => $request->dasar,
            'kepada' => $request->untuk,
            'file_path' => 'draft_surat/' . $fileName, // Simpan path file ke database
        ]);
        // Download file
        return redirect('panel/surat/add_tugas')->with('success', 'Surat Pengantar Berhasil Dibuat.');
        // return response()->download(storage_path('app/public/draft_surat/' . $filename))->deleteFileAfterSend(false);
    }

    public function addManual(Request $request)
    {
        $request->validate([
            'pdfFile' => 'required|mimes:pdf', // Maksimal 2MB
        ]);
        if ($request->hasFile('pdfFile')) {
            $file = $request->file('pdfFile');
            $fileName = time() . '_' . $file->getClientOriginalName(); // Nama file unik
            // $file->storeAs('acc_surat/', $fileName, 'public');
            $string = $request->template_nomor;
            $parts = explode("Un.04/Ka.LPM/", $string);
            $file->storeAs('Surat/' . $parts[1] . '/', $fileName, 'public');
            // $url = Storage::url($file);
            // Simpan informasi file ke database
            SuratModel::create([
                'nomor' => $request->nomor,
                'nama' => $request->hal,
                'kepada' => $request->kepada,
                'template_nomor' => $request->template_nomor,
                'file_path' => 'Surat/' . $parts[1] . '/' . $fileName, // Simpan path file ke database
                'created_at' => $request->tanggal,
                'updated_at' => $request->tanggal,
                'status' => 'is_ok',
                // 'surat_id' => $request->jenis,
            ]);

            return redirect('panel/surat/selesai')->with('success', 'Surat selesai berhasil ditambahkan!');
        }
        // SuratModel::create([
        //     'nomor' => $request->nomor,
        //     'nama' => $request->hal,
        //     'kepada' => $request->kepada,
        //     'template_nomor' => $request->template_nomor,
        //     'created_at' => $request->tanggal,
        //     'updated_at' => $request->tanggal,
        //     'status' => 'is_ok',
        //     // 'surat_id' => $request->jenis,
        // ]);

        // return redirect('panel/surat/selesai')->with('success', 'Surat selesai berhasil ditambahkan!');
    }

    public function addLainnya(Request $request)
    {
        // Validasi input file
        $request->validate([
            'wordFile' => 'required|mimes:docx|max:2048', // File harus berupa .docx dan maksimal 2MB
            // 'nomor' => 'required|number',
            'hal' => 'required|string',
            'kepada' => 'required|string'
        ], [
            'wordFile.required' => 'File harus diunggah.',
            'wordFile.mimes' => 'File harus berupa DOCX.',
            'wordFile.max' => 'Ukuran file tidak boleh lebih dari 2MB.',
            // 'nomor.required' => 'Nomor harus diisi.',
            'hal.required' => 'Hal harus diisi.',
            'kepada.required' => 'Kepada harus diisi.'
        ]);

        // Periksa apakah file diunggah
        if ($request->hasFile('wordFile')) {
            $file = $request->file('wordFile');
            $fileName = time() . '_' . $file->getClientOriginalName(); // Nama file unik
            $file->storeAs('draft_surat/', $fileName, 'public');

            // Simpan informasi file ke database
            SuratModel::create([
                'nomor' => $request->nomor,
                'nama' => $request->hal,
                'kepada' => $request->kepada,
                'template_nomor' => $request->template_nomor,
                'file_path' => 'draft_surat/' . $fileName, // Simpan path file ke database
                'status' => 'pending',
            ]);

            return redirect('panel/surat/add_lainnya')->with('success', 'File DOCX berhasil diunggah dan disimpan ke database!');
        }

        // Jika file tidak diunggah, kembalikan dengan pesan error
        return redirect('panel/surat/add_lainnya')->with('error', 'Gagal mengunggah file.');
    }


    private function getDate($tanggal)
    {
        $hari = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
        $dayOfWeek = date('w', strtotime($tanggal)); // 'w' mengembalikan 0 (Minggu) sampai 6 (Sabtu)
        return $hari[$dayOfWeek];
    }


    //TTD
    public function updateStatus(Request $request, $id)
    {
        // dd($request->all());
        // Validasi input
        $request->validate([
            'status' => 'required|in:' . implode(',', $this->allowedStatuses),
        ]);

        // Temukan member berdasarkan ID
        $surat = SuratModel::findOrFail($id);

        // Update status
        if ($request->status == 'accepted') {
            if (Auth::user()->role->name == 'Sekretaris 1' && $surat->status == 'pending') {
                $surat->status = 'accepted'; // ACC Sekretaris 1
            } else {
                return redirect()->route('surat.index')->with('error', 'Anda tidak memiliki izin untuk melakukan aksi ini.');
            }
        } elseif ($request->status == 'completed') {
            if (Auth::user()->role->name == 'Sekretaris 2' && $surat->status == 'accepted') {
                $surat->status = 'completed'; // ACC Sekretaris 2
            } else {
                return redirect()->route('surat.index')->with('error', 'Anda tidak memiliki izin untuk melakukan aksi ini.');
            }
        } elseif ($request->status == 'rejected') {
            if (Auth::user()->role->name == 'Sekretaris 1' && $surat->status == 'pending') {
                $surat->status = 'rejected'; // Sekretaris 1: pending -> rejected
                $surat->ket = $request->keterangan;
            } elseif (Auth::user()->role->name == 'Sekretaris 2' && $surat->status == 'accepted') {
                $surat->status = 'rejected';
                $surat->ket = $request->keterangan;
            } elseif (Auth::user()->role->name == 'Ketua' && $surat->status == 'completed') {
                $surat->status = 'rejected';
                $surat->ket = $request->keterangan;
            } else {
                return redirect()->route('surat.index')->with('error', 'Anda tidak memiliki izin untuk melakukan aksi ini.');
            }
        } elseif ($request->status == 'is_ok') {
            if (Auth::user()->role->name == 'Ketua' && $surat->status == 'completed') {
                $surat->status = 'is_ok'; // Ketua: completed -> siap_di_print

                // Path ke template file
                $templatePath = storage_path('app/public/' . $surat->file_path);

                // Generate nama file yang valid
                $fileName = 'acc_' . $surat->nomor . '_' . str_replace(' ', '_', $surat->nama) . '.docx';
                $pdfFileName = bin2hex(random_bytes(2)) . '_' . $surat->nomor . '_' . str_replace(' ', '_', $surat->nama) . '.pdf';
                $string = $surat->template_nomor;
                $parts = explode("Un.04/Ka.LPM/", $string);
                // Path untuk menyimpan file Word sementara
                $tempWordFilePath = storage_path('app/public/Surat/' . $parts[1] . '/' . $fileName);

                // Pastikan direktori output ada
                $outputDir = storage_path('app/public/Surat/' . $parts[1]);
                if (!is_dir($outputDir)) {
                    mkdir($outputDir, 0755, true); // Buat direktori jika tidak ada
                }

                // Buat instance TemplateProcessor
                $templateProcessor = new TemplateProcessor($templatePath);

                // Generate QR code
                $data = url("/storage/Surat/$parts[1]/{$pdfFileName}");
                $options = new QROptions([
                    'version'    => 5, // Versi QR Code
                    'outputType' => QRCode::OUTPUT_IMAGE_PNG, // Format output (PNG)
                    'eccLevel'   => QRCode::ECC_L, // Level koreksi error (L)
                ]);
                $qrCode = new QRCode($options);

                // Simpan QR code ke file sementara
                $qrImagePath = storage_path('app/public/qrcodes/qrcode_' . $surat->id . '.png');
                $qrCode->render($data, $qrImagePath);

                // Ganti placeholder {QR_CODE} dengan gambar QR code
                $templateProcessor->setImageValue('qr_code', [
                    'path' => $qrImagePath,
                    'width' => 100,
                    'height' => 100,
                ]);

                // Simpan file Word sementara
                $templateProcessor->saveAs($tempWordFilePath);

                // Konversi file Word ke PDF menggunakan OfficeConverter
                $converter = new OfficeConverter($tempWordFilePath);
                $converter->convertTo($pdfFileName);

                // Hapus file sementara
                unlink($qrImagePath); // Hapus file QR code sementara
                // unlink($tempWordFilePath); // Hapus file Word sementara
                unlink($templatePath);

                // Simpan path file PDF ke database
                $surat->update([
                    'file_path' => 'Surat/' . $parts[1] . '/' . $pdfFileName,
                ]);
            } else {
                return redirect()->route('surat.index')->with('error', 'Anda tidak memiliki izin untuk melakukan aksi ini.');
            }
        }

        // Simpan perubahan
        $surat->save();

        // Redirect kembali dengan pesan sukses
        return redirect()->route('surat.index')->with('success', 'Status berhasil diupdate!');
    }

    public function selesai()
    {
        $data['getRecord'] = SuratModel::getRecord();
        return view('panel.surat.selesai', $data);
    }
    public function ditolak()
    {
        $data['getRecord'] = SuratModel::getRecord();
        return view('panel.surat.ditolak', $data);
    }
}
