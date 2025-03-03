@extends('panel.layouts.app')
@section('title', 'LPM - Buat Surat Tugas')
<script>
    function addRow() {
        const table = document.getElementById("itemsTable");
        const row = table.insertRow(-1);
        const no = table.rows.length - 1; // Nomor baris dimulai dari 1

        // Gunakan no - 1 sebagai indeks array (karena array dimulai dari 0)
        row.innerHTML = `
        <td>${no}</td>
        <td><input class="form-control" type="text" name="anggota[${no - 1}][nama]" required></td>
        <td><input class="form-control" type="text" name="anggota[${no - 1}][nip]" required></td>
        <td><input class="form-control" type="text" name="anggota[${no - 1}][pangkat]" required></td>
        <td><input class="form-control" type="text" name="anggota[${no - 1}][jabatan]" required></td>
        <td><button class="btn btn-sm btn-danger" type="button" onclick="deleteRow(this)"><i class="bi bi-trash"></i></button></td>
    `;
        updateRowNumbers();
    }

    function deleteRow(btn) {
        const row = btn.parentNode.parentNode;
        row.remove();
        updateRowNumbers();
    }

    function updateRowNumbers() {
        const rows = document.getElementById("itemsTable").rows;
        for (let i = 1; i < rows.length; i++) {
            // Update nomor baris
            rows[i].cells[0].innerHTML = i;

            // Update nama input array
            rows[i].cells[1].querySelector('input').name = `anggota[${i - 1}][nama]`;
            rows[i].cells[2].querySelector('input').name = `anggota[${i - 1}][nip]`;
            rows[i].cells[3].querySelector('input').name = `anggota[${i - 1}][pangkat]`;
            rows[i].cells[4].querySelector('input').name = `anggota[${i - 1}][jabatan]`;
        }
    }
</script>

@section('content')
    <div class="pagetitle">
        <h1>Surat Tugas LPM</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ url('') }}">Buat Surat</a></li>
                <li class="breadcrumb-item active">Surat Tugas LPM</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->


    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                @include('_message')
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Surat Tugas LPM |
                            <small class="form-text text-muted">
                                <a href='{{ asset('storage/template_surat/tugas.pdf') }}' target="_blank"> Lihat Contoh
                                    Template Surat </a>
                            </small>
                        </h5>
                        <!-- Floating Labels Form -->
                        <form class="row g-3" action="{{ route('add.tugas') }}" method="POST">
                            @csrf

                            <div class="row g-1">
                                <div class="col-md-12">
                                    <h6 class="mb-1">Nomor Surat:</h6>
                                    <input type="number" class="form-control" id="floatingNomor" name="nomor"
                                        placeholder="Nomor Surat" required>
                                </div>
                                <div class="col-12">
                                    <h6 class="mb-1">Dasar:</h6>
                                    <textarea class="form-control" name="dasar" placeholder="Surat ...... Nomor : ..... pada tanggal ......"
                                        style="height: 80px;"></textarea>
                                </div>
                            </div>
                            <div></div>
                            <div class="row g-1">
                                <h6 class="mb-1">Tugas Kepada:</h6>
                                <div class="col-12">
                                    <div class="form-group">
                                        <table class="table table-hover" id="itemsTable">
                                            <thead>
                                                <tr>
                                                    <th scope="col">No.</th>
                                                    <th scope="col">Nama</th>
                                                    <th scope="col">NIP</th>
                                                    <th scope="col">Pangkat</th>
                                                    <th scope="col">Jabatan</th>
                                                    <th scope="col"> </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>1</td>
                                                    <td>
                                                        <input class="form-control" type="text" name="anggota[0][nama]"
                                                            required>
                                                    </td>
                                                    <td><input class="form-control" type="text" name="anggota[0][nip]"
                                                            required></td>
                                                    <td>
                                                        <input class="form-control" type="text"
                                                            name="anggota[0][pangkat]" required>
                                                    </td>
                                                    <td>
                                                        <input class="form-control" type="text"
                                                            name="anggota[0][jabatan]" required>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <button type="button" class="btn btn-success" onclick="addRow()">Tambah
                                            anggota</button>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <h6 class="mb-1">Untuk:</h6>
                                    <textarea class="form-control" name="untuk" placeholder="Kegiatan ... pada tanggal ..." style="height: 80px;"></textarea>
                                </div>
                            </div>

                            <div class="text-end">
                                <button type="reset" class="btn btn-secondary">Reset</button>
                                <button type="submit" class="btn btn-success">Submit</button>
                            </div>
                        </form><!-- End floating Labels Form -->

                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
