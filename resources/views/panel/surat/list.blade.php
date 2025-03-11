@extends('panel.layouts.app')
@section('title', 'LPM - Menunggu Verifikasi')
@section('content')
    <div class="pagetitle">
        <h1>Menunggu Verifikasi</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('') }}">Home</a></li>
                <li class="breadcrumb-item active">Surat Keluar</li>
                <li class="breadcrumb-item active">Menunggu Verifikasi</li>
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
                                <h5 class="card-title">Surat</h5>
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
                                        <th scope="col">Action</th>
                                        {{-- <th scope="col">Jenis Surat</th> --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $num = 1;

                                    @endphp

                                    @foreach ($getRecord as $value)
                                        @if (
                                            (Auth::user()->role->id == 3 && $value->status == 'pending') ||
                                                (Auth::user()->role->id == 37 && $value->status == 'accepted') ||
                                                (Auth::user()->role->id == 2 && $value->status == 'completed'))
                                            <tr>
                                                {{-- <th scope="row">{{ $num++ }}</th> --}}
                                                <td>
                                                    {{ $value->nomor }}/{{ $value->template_nomor }}/{{ $value->bulan }}/{{ $value->tahun }}
                                                </td>
                                                <td>{{ $value->formatted_updated_at }}</td>
                                                <td>{{ $value->kepada }}</td>
                                                <td>{{ $value->nama }}</td>
                                                <td class="text-center">
                                                    <a href="{{ asset('storage/' . $value->file_path) }}" target="_blank"><i
                                                            class="ri-eye-line"></i>
                                                    </a>
                                                </td>

                                                <td>
                                                    @if (Auth::user()->role->id == 3 && $value->status == 'pending')
                                                        <!-- Tombol Aksi Sekretaris 1 -->
                                                        <div class="action-buttons">
                                                            <button type="button" class="btn btn-sm btn-success"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#acceptModal{{ $value->id }}">
                                                                <i class="bi bi-check-lg"></i>
                                                            </button>
                                                            <button type="button" class="btn btn-sm btn-danger"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#rejectModal{{ $value->id }}">
                                                                <i class="bi bi-x-lg"></i>
                                                            </button>
                                                        </div>

                                                        <!-- Modal Acc Sekretaris 1 -->
                                                        <div class="modal fade" id="acceptModal{{ $value->id }}"
                                                            tabindex="-1">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title">Konfirmasi Persetujuan</h5>
                                                                        <button type="button" class="btn-close"
                                                                            data-bs-dismiss="modal"
                                                                            aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <p>Apakah Anda yakin ingin menyetujui surat ini?</p>
                                                                        <p>Nomor Surat: {{ $value->nomor }}</p>
                                                                        <form
                                                                            action="{{ route('surat.updateStatus', $value->id) }}"
                                                                            method="POST">
                                                                            @csrf
                                                                            @method('PUT')
                                                                            <input type="hidden" name="status"
                                                                                value="accepted">
                                                                            <div class="modal-footer">
                                                                                <button type="button"
                                                                                    class="btn btn-secondary"
                                                                                    data-bs-dismiss="modal">Batal</button>
                                                                                <button type="submit"
                                                                                    class="btn btn-success">Ya,
                                                                                    Setujui</button>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <!-- Modal Tolak Sekretaris 1 -->
                                                        <div class="modal fade" id="rejectModal{{ $value->id }}"
                                                            tabindex="-1">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title">Konfirmasi Penolakan</h5>
                                                                        <button type="button" class="btn-close"
                                                                            data-bs-dismiss="modal"
                                                                            aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <p>Apakah Anda yakin ingin menolak surat ini?</p>
                                                                        <form
                                                                            action="{{ route('surat.updateStatus', $value->id) }}"
                                                                            method="POST">
                                                                            @csrf
                                                                            @method('PUT')
                                                                            <div class="mb-3">
                                                                                <label for="keterangan"
                                                                                    class="form-label">Alasan
                                                                                    Penolakan</label>
                                                                                <textarea class="form-control" name="keterangan" id="keterangan" rows="3" required></textarea>
                                                                            </div>
                                                                            <input type="hidden" name="status"
                                                                                value="rejected">
                                                                            <div class="modal-footer">
                                                                                <button type="button"
                                                                                    class="btn btn-secondary"
                                                                                    data-bs-dismiss="modal">Batal</button>
                                                                                <button type="submit"
                                                                                    class="btn btn-danger">Ya,
                                                                                    Tolak</button>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @elseif(Auth::user()->role->id == 37 && $value->status == 'accepted')
                                                        <!-- Tombol Aksi Sekretaris 2 -->
                                                        <div class="action-buttons">
                                                            <button type="button" class="btn btn-sm btn-success"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#acceptModalSekretaris2{{ $value->id }}">
                                                                <i class="bi bi-check-lg"></i>
                                                            </button>
                                                            <button type="button" class="btn btn-sm btn-danger"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#rejectModalSekretaris2{{ $value->id }}">
                                                                <i class="bi bi-x-lg"></i>
                                                            </button>
                                                        </div>

                                                        <!-- Modal Acc Sekretaris 2 -->
                                                        <div class="modal fade"
                                                            id="acceptModalSekretaris2{{ $value->id }}"
                                                            tabindex="-1">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title">Konfirmasi Persetujuan
                                                                            Sekretaris 2</h5>
                                                                        <button type="button" class="btn-close"
                                                                            data-bs-dismiss="modal"
                                                                            aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <p>Apakah Anda yakin ingin menyetujui surat ini?</p>
                                                                        <p>Nomor Surat: {{ $value->nomor }}</p>
                                                                        <form
                                                                            action="{{ route('surat.updateStatus', $value->id) }}"
                                                                            method="POST">
                                                                            @csrf
                                                                            @method('PUT')
                                                                            <input type="hidden" name="status"
                                                                                value="completed">
                                                                            <div class="modal-footer">
                                                                                <button type="button"
                                                                                    class="btn btn-secondary"
                                                                                    data-bs-dismiss="modal">Batal</button>
                                                                                <button type="submit"
                                                                                    class="btn btn-success">Ya,
                                                                                    Setujui</button>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <!-- Modal Tolak Sekretaris 2 -->
                                                        <div class="modal fade"
                                                            id="rejectModalSekretaris2{{ $value->id }}"
                                                            tabindex="-1">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title">Konfirmasi Penolakan</h5>
                                                                        <button type="button" class="btn-close"
                                                                            data-bs-dismiss="modal"
                                                                            aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <p>Apakah Anda yakin ingin menolak surat ini?</p>
                                                                        <form
                                                                            action="{{ route('surat.updateStatus', $value->id) }}"
                                                                            method="POST">
                                                                            @csrf
                                                                            @method('PUT')
                                                                            <div class="mb-3">
                                                                                <label for="keterangan"
                                                                                    class="form-label">Alasan
                                                                                    Penolakan</label>
                                                                                <textarea class="form-control" name="keterangan" id="keterangan" rows="3" required></textarea>
                                                                            </div>
                                                                            <input type="hidden" name="status"
                                                                                value="rejected">
                                                                            <div class="modal-footer">
                                                                                <button type="button"
                                                                                    class="btn btn-secondary"
                                                                                    data-bs-dismiss="modal">Batal</button>
                                                                                <button type="submit"
                                                                                    class="btn btn-danger">Ya,
                                                                                    Tolak</button>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @elseif(Auth::user()->role->id == 2 && $value->status == 'completed')
                                                        <!-- Tombol Aksi Ketua -->
                                                        <div class="action-buttons">
                                                            <button type="button" class="btn btn-sm btn-success"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#acceptModalKetua{{ $value->id }}">
                                                                <i class="bi bi-check-lg"></i>
                                                            </button>
                                                            <button type="button" class="btn btn-sm btn-danger"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#rejectModalKetua{{ $value->id }}">
                                                                <i class="bi bi-x-lg"></i>
                                                            </button>
                                                        </div>

                                                        <!-- Modal Acc Ketua -->
                                                        <div class="modal fade" id="acceptModalKetua{{ $value->id }}"
                                                            tabindex="-1">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title">Konfirmasi Persetujuan
                                                                            Ketua
                                                                        </h5>
                                                                        <button type="button" class="btn-close"
                                                                            data-bs-dismiss="modal"
                                                                            aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <p>Apakah Anda yakin ingin menyetujui dan
                                                                            tanda-tangan /
                                                                            memberi QR CODE surat ini?</p>
                                                                        <form
                                                                            action="{{ route('surat.updateStatus', $value->id) }}"
                                                                            method="POST">
                                                                            @csrf
                                                                            @method('PUT')
                                                                            <input type="hidden" name="status"
                                                                                value="is_ok">
                                                                            <div class="modal-footer">
                                                                                <button type="button"
                                                                                    class="btn btn-secondary"
                                                                                    data-bs-dismiss="modal">Batal</button>
                                                                                <button type="submit"
                                                                                    class="btn btn-success">Ya,
                                                                                    Setujui</button>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <!-- Modal Tolak Tolak -->
                                                        <div class="modal fade" id="rejectModalKetua{{ $value->id }}"
                                                            tabindex="-1">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title">Konfirmasi Penolakan</h5>
                                                                        <button type="button" class="btn-close"
                                                                            data-bs-dismiss="modal"
                                                                            aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <p>Apakah Anda yakin ingin menolak surat ini?</p>
                                                                        <form
                                                                            action="{{ route('surat.updateStatus', $value->id) }}"
                                                                            method="POST">
                                                                            @csrf
                                                                            @method('PUT')
                                                                            <div class="mb-3">
                                                                                <label for="keterangan"
                                                                                    class="form-label">Alasan
                                                                                    Penolakan</label>
                                                                                <textarea class="form-control" name="keterangan" id="keterangan" rows="3" required></textarea>
                                                                            </div>
                                                                            <input type="hidden" name="status"
                                                                                value="rejected">
                                                                            <div class="modal-footer">
                                                                                <button type="button"
                                                                                    class="btn btn-secondary"
                                                                                    data-bs-dismiss="modal">Batal</button>
                                                                                <button type="submit"
                                                                                    class="btn btn-danger">Ya,
                                                                                    Tolak</button>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @else
                                                        <span class="text-muted">Tidak ada aksi</span>
                                                    @endif
                                                </td>

                                                {{-- <td>{{ $value->status }}</td> --}}
                                                {{-- <td>
                                                {{ $value->jenisSurat->jenis_surat }}
                                            </td> --}}
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- End Table with stripped rows -->

                    </div>
                </div>


            </div>
        </div>
    </section>
@endsection
