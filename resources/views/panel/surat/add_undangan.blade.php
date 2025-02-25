@extends('panel.layouts.app')

@section('content')
    <div class="pagetitle">
        <h1>Surat Undangan</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ url('') }}">Buat Surat</a></li>
                <li class="breadcrumb-item active">Surat Undangan</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->


    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                @include('_message')
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Surat Undangan |
                            <small class="form-text text-muted">
                                <a href='{{ asset('storage/template_surat/undangan.pdf') }}' target="_blank"> Lihat Contoh
                                    Template Surat </a>
                            </small>
                        </h5>
                        <!-- Floating Labels Form -->
                        <form class="row g-3" action="{{ route('add.Undangan') }}" method="POST">
                            @csrf
                            <div class="row g-1">
                                <h6 class="mb-1">Info Surat:</h6>
                                <div class="col-md-4">
                                    <div class="form-floating">
                                        <input type="number" class="form-control" id="floatingNomor" name="nomor"
                                            placeholder="Nomor Surat" required>
                                        <label for="floatingName">Nomor Surat</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="floatingHal" name="hal"
                                            placeholder="Hal" required>
                                        <label for="floatingHal">Hal</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="floatingSifat" name="kepada"
                                            placeholder="Kepada Yth." required>
                                        <label for="floatingKepada">Kepada Yth.</label>
                                    </div>
                                </div>
                            </div>
                            <div></div>
                            <div class="row g-1">
                                <h6 class="mb-1">Isi Surat:</h6>
                                <div class="col-12">
                                    <div class="form-floating">
                                        <textarea class="form-control" name="kegiatan" placeholder="Nama Kegiatan" id="floatingTextarea"
                                            style="height: 150px; field-sizing: content;" required></textarea>
                                        <label for="floatingTextarea">Isi Surat</label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-floating">
                                        <input type="date" class="form-control" id="floatingTanggal" name="tanggal"
                                            required>
                                        <label for="floatingTanggal">Tanggal</label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-floating">
                                        <input type="time" class="form-control" id="floatingJam" name="jam" required>
                                        <label for="floatingJam">Jam</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="floatingTanggal" name="tempat"
                                                placeholder="Tempat" required>
                                            <label for="floatingTanggal">Tempat</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="text-end">
                                <button type="reset" class="btn btn-secondary">Reset</button>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form><!-- End floating Labels Form -->
                        <script>
                            // Mendapatkan tanggal saat ini
                            const today = new Date().toISOString().split('T')[0];

                            // Mengatur atribut max pada input tanggal
                            document.getElementById('floatingTanggal').setAttribute('min', today);
                        </script>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
