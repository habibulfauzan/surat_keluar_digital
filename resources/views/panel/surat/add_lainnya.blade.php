@extends('panel.layouts.app')
@section('title', 'LPM - Lainnya')

@section('content')
    <div class="pagetitle">
        <h1>Lainnya</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ url('') }}">Buat Surat</a></li>
                <li class="breadcrumb-item active">Lainnya</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->


    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                @include('_message')
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Lainnya</h5>

                        <!-- Multi Columns Form -->
                        <form class="row g-3" action="{{ route('add.lainnya') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf

                            <div class="col-md-12">
                                <label for="wordFile" class="form-label">Upload docx file</label>
                                <input type="file" class="form-control" id="wordFile" name="wordFile" accept=".docx">
                                <small class="form-text text-muted">
                                    <ul>
                                        <li> Hanya file .docx </li>
                                        <li> Tambahkan ${qr_code} dalam TTD. | <a
                                                href='{{ asset('storage/template_surat/qrcode.png') }}' target="_blank">
                                                Lihat
                                                Contoh </a> </li>
                                    </ul>
                                </small>
                            </div>

                            <div class="col-md-6">
                                <label for="hal" class="form-label">Isi Surat / Hal</label>
                                <input type="text" class="form-control" id="hal" name="hal">
                            </div>

                            <div class="col-md-2">
                                <label for="nomor" class="form-label">Nomor Surat</label>
                                <input type="number" class="form-control" id="nomor" name="nomor">
                            </div>
                            <div class="col-md-4">
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
                            <div class="col-12">
                                <label for="kepada" class="form-label">Tujuan / Kepada</label>
                                <input type="text" class="form-control" id="kepada" name="kepada"
                                    placeholder="Rektor">
                            </div>
                            <div class="text-end">
                                <button type="reset" class="btn btn-secondary">Reset</button>
                                <button type="submit" class="btn btn-success">Submit</button>
                            </div>
                        </form><!-- End Multi Columns Form -->

                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
