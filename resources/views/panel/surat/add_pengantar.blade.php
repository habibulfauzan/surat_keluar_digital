@extends('panel.layouts.app')
<script>
    function addRow() {
        const table = document.getElementById("itemsTable");
        const row = table.insertRow(-1);
        const no = table.rows.length - 1; // Nomor baris dimulai dari 1

        // Gunakan no - 1 sebagai indeks array (karena array dimulai dari 0)
        row.innerHTML = `
        <td>${no}</td>
        <td><textarea class="form-control" type="text" name="barang[${no - 1}][nama]" required></textarea></td>
        <td><input class="form-control" type="number" name="barang[${no - 1}][jumlah]" required></td>
        <td><textarea class="form-control" type="text" name="barang[${no - 1}][keterangan]" required></textarea></td>
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
            rows[i].cells[1].querySelector('input').name = `barang[${i - 1}][nama]`;
            rows[i].cells[2].querySelector('input').name = `barang[${i - 1}][jumlah]`;
            rows[i].cells[3].querySelector('input').name = `barang[${i - 1}][keterangan]`;
        }
    }
</script>
@section('content')
    <div class="pagetitle">
        <h1>Surat Pengantar</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ url('') }}">Buat Surat</a></li>
                <li class="breadcrumb-item active">Surat Pengantar</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->


    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                @include('_message')
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Buat Surat Pengantar |
                            <small class="form-text text-muted">
                                <a href='{{ asset('storage/template_surat/pengantar.pdf') }}' target="_blank"> Lihat Contoh
                                    Template Surat </a>
                            </small>
                        </h5>

                        <!-- Floating Labels Form -->
                        <form class="row g-3" action="{{ route('add.pengantar') }}" method="POST">
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
                                        <!-- Primary Color Bordered Table -->
                                        <table class="table table-hover" id="itemsTable">
                                            <thead>
                                                <tr>
                                                    <th scope="col">No.</th>
                                                    <th scope="col">Isi Surat / Nama Barang</th>
                                                    <th scope="col">Jumlah</th>
                                                    <th scope="col">Keterangan</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>1</td>
                                                    <td>
                                                        <textarea class="form-control" type="text" name="barang[0][nama]" required></textarea>
                                                    </td>
                                                    <td><input class="form-control" type="number" name="barang[0][jumlah]"
                                                            required></td>
                                                    <td>
                                                        <textarea class="form-control" type="text" name="barang[0][keterangan]" required></textarea>
                                                    </td>
                                                    <td><button class="btn btn-sm btn-danger" type="button"
                                                            onclick="deleteRow(this)">
                                                            <i class="bi bi-trash"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <button type="button" class="btn btn-primary" onclick="addRow()">Tambah
                                            Barang</button>
                                    </div>
                                </div>


                            </div>

                            <div class="text-end">
                                <button type="reset" class="btn btn-secondary">Reset</button>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form><!-- End floating Labels Form -->

                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
