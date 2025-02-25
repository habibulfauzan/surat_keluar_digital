@extends('panel.layouts.app')

@section('content')
    <div class="pagetitle">
        <h1>List Semua Surat</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('') }}">Home</a></li>
                <li class="breadcrumb-item active">Surat Keluar</li>
                <li class="breadcrumb-item active">List Semua Surat</li>
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
                                        {{-- <th scope="col">Jenis Surat</th> --}}
                                        <th scope="col">File</th>
                                        <th scope="col">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $num = 1;
                                    @endphp

                                    @foreach ($getRecord as $value)
                                        <tr>
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
                                            {{-- <td>{{ $value->status }}</td> --}}
                                            {{-- <td>
                                            {{ $value->jenisSurat->jenis_surat }}
                                        </td> --}}
                                            <td class="text-center">
                                                @if ($value->status == 'rejected')
                                                    <span class="badge bg-danger">
                                                        <i class="bi bi-x-lg" aria-placeholder="A"></i>
                                                    </span>
                                                @elseif ($value->status == 'pending' || $value->status == 'accepted' || $value->status == 'completed')
                                                    <span class="badge bg-warning">
                                                        <i class="bi bi-clock-history"></i>
                                                    </span>
                                                @else
                                                    <span class="badge bg-success">
                                                        <i class="bi bi-check-lg"></i>
                                                        </button>
                                                @endif
                                            </td>
                                        </tr>
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
