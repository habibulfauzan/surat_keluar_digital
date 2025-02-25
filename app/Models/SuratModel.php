<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class SuratModel extends Model
{
    protected $table = 'surat';

    protected $fillable = [
        'nomor',
        'template_nomor',
        'nama',
        'kepada',
        'status',
        // 'surat_id',
        'file_path',
        'created_at',
        'updated_at',
    ];

    static public function getSingle($id)
    {
        return SuratModel::find($id);
    }

    static public function getRecord()
    {
        return SuratModel::get()->map(function ($item) {
            $item->bulan = Carbon::parse($item->created_at)->format('m'); // Nama bulan
            $item->tahun = Carbon::parse($item->created_at)->format('Y');
            $item->formatted_created_at = Carbon::parse($item->created_at)->format('d-m-Y'); // Tahun
            $item->formatted_updated_at = Carbon::parse($item->updated_at)->format('d-m-Y'); // Tahun
            return $item;
        });

        // return SuratModel::with('jenisSurat')->get()->map(function ($item) {
        //     $item->bulan = Carbon::parse($item->created_at)->format('m'); // Nama bulan
        //     $item->tahun = Carbon::parse($item->created_at)->format('Y');
        //     $item->formatted_created_at = Carbon::parse($item->created_at)->format('d-m-Y'); // Tahun
        //     $item->formatted_updated_at = Carbon::parse($item->updated_at)->format('d-m-Y'); // Tahun
        //     return $item;
        // });
    }

    // public function jenisSurat()
    // {
    //     return $this->belongsTo(JenisSuratModel::class, 'surat_id', 'id');
    // }
}
