@extends('panel.layouts.app')
@section('title', 'LPM - Surat Selesai')

@section('content')
    <div class="pagetitle">
        <h1>Surat Selesai</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('') }}">Home</a></li>
                <li class="breadcrumb-item active">Surat Keluar</li>
                <li class="breadcrumb-item active">Surat Selesai</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                @include('_message')
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h5 class="card-title">List Surat Selesai</h5>
                            </div>
                            <div class="col-md-6 text-end">
                                <!-- Button Trigger Modal -->
                                <button type="button" class="btn btn-success btn-sm" style="margin-top: 10px"
                                    data-bs-toggle="modal" data-bs-target="#addSuratModal">
                                    <i class="bi bi-plus-lg"></i>
                                </button>
                            </div>
                        </div>
                        <!-- Table with stripped rows -->
                        <div class="table-responsive">
                            <table class="table table-striped datatable">
                                <thead>
                                    <tr>
                                        <th scope="col">No. Surat</th>
                                        <th scope="col">Tanggal</th>
                                        <th scope="col">Tujuan</th>
                                        <th scope="col">Isi Surat</th>
                                        <th scope="col">File</th>
                                        {{-- <th scope="col">Jenis Surat</th> --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $num = 1;
                                    @endphp

                                    @foreach ($getRecord as $value)
                                        {{-- {{ var_dump($value) }} --}}
                                        @if ($value->status == 'is_ok')
                                            <tr>
                                                {{-- <th scope="row">{{ $num++ }}</th> --}}
                                                <td>
                                                    {{ $value->nomor }}/{{ $value->template_nomor }}/{{ $value->bulan }}/{{ $value->tahun }}
                                                </td>
                                                <td>{{ $value->formatted_updated_at }}</td>
                                                <td>{{ $value->kepada }}</td>
                                                <td>{{ $value->nama }}</td>
                                                {{-- <td>
                                                {{ $value->jenisSurat->jenis_surat }}
                                            </td> --}}
                                                <td class="text-center">
                                                    <a href="{{ asset('storage/' . $value->file_path) }}" target="_blank">
                                                        <i class="ri-eye-line"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- End Table with stripped rows -->
                        <!-- Add Surat Modal -->
                        <div class="modal fade" id="addSuratModal" tabindex="-1" aria-labelledby="addSuratModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="addSuratModalLabel">Tambah Surat Keluar</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <form action="{{ route('add.manual') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="modal-body">
                                            <!-- Form Input Fields -->
                                            <div class="row g-1">
                                                <div class="col-md-4">
                                                    <label for="nomor" class="form-label">
                                                        Nomor Surat</label>
                                                    <input type="number" class="form-control" id="nomor" name="nomor"
                                                        required>
                                                </div>
                                                <div class="col-md-8">
                                                    <label for="template_nomor" class="form-label">Template Nomor</label>
                                                    <select class="form-select" name="template_nomor"
                                                        aria-label="Floating label select example">
                                                        <option selected>Pilih Template Nomor</option>
                                                        <option value="Un.04/Ka.LPM/PP.00.9">Un.04/Ka.LPM/PP.00.9</option>
                                                        <option value="Un.04/Ka.LPM/KU.00.1">Un.04/Ka.LPM/KU.00.1</option>
                                                        <option value="Un.04/Ka.LPM/KP.02.3">Un.04/Ka.LPM/KP.02.3</option>
                                                        <option value="Un.04/Ka.LPM/UD">Un.04/Ka.LPM/UD</option>
                                                        <option value="Un.04/Ka.LPM/HM.01">Un.04/Ka.LPM/HM.01</option>
                                                        <option value="Un.04/Ka.LPM/KP.01.2">Un.04/Ka.LPM/KP.01.2</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-12">
                                                    <label for="hal" class="form-label">Hal</label>
                                                    <input type="text" class="form-control" id="hal" name="hal"
                                                        required>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="kepada" class="form-label">Kepada</label>
                                                    <input type="text" class="form-control" id="kepada" name="kepada"
                                                        required>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="tanggal" class="form-label">Tanggal</label>
                                                    <input type="date" class="form-control" id="tanggal" name="tanggal"
                                                        required>
                                                </div>
                                                {{-- {{ storage_path() }} --}}
                                                {{-- <div class="col-md-4">
                                                    <label for="kepada" class="form-label">Jenis Surat</label>
                                                    <select class="form-select" name="jenis"
                                                        aria-label="Floating label select example">
                                                        <option selected>Pilih Jenis Surat</option>
                                                        <option value="1">Surat Undangan</option>
                                                        <option value="2">Surat Pengantar</option>
                                                        <option value="3">Surat Permohonan</option>
                                                    </select>
                                                </div> --}}
                                                <div class="col-md-12">
                                                    <label for="pdfFile" class="form-label">Upload PDF File</label>
                                                    <input type="file" class="form-control" id="pdfFile" name="pdfFile"
                                                        accept="application/pdf" required>
                                                </div>
                                                <!-- Tambahkan field lain sesuai kebutuhan -->
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary btn-sm"
                                                data-bs-dismiss="modal">Tutup</button>
                                            <button type="submit" class="btn btn-success btn-sm">Simpan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </section>
@endsection
