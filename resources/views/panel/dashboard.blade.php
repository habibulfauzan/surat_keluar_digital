@extends('panel.layouts.app')
@section('title', 'Dashboard')
@section('content')
    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('') }}">Home</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    @if (session('login_success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle me-1"></i>
            {{ session('login_success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="notif-surat"></div>
    <div class="notif-completed"></div>
    <script>
        setTimeout(function() {
            let alerts = document.querySelectorAll(".alert");
            alerts.forEach(function(alert) {
                alert.classList.remove("show");
                alert.classList.add("fade");
                setTimeout(() => alert.remove(), 500);
            });
        }, 5000); // Hilang dalam 5 detik
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function cekNotifikasi() {
            $.ajax({
                url: "{{ route('notif.surat') }}",
                type: "GET",
                success: function(data) {
                    if (data > 0) {
                        $(".notif-surat").html(`
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <i class="bi bi-exclamation-triangle me-1"></i>
                                📌 Anda memiliki <strong>${data}</strong> surat yang perlu diverifikasi!
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        `);

                        // Auto close setelah 5 detik
                        // setTimeout(function() {
                        //     $(".notif-surat .alert").fadeOut("slow", function() {
                        //         $(this).remove(); // Hapus dari DOM
                        //     });
                        // }, 5000);
                    } else {
                        $(".notif-surat").html(""); // Hapus jika tidak ada notifikasi
                    }
                },
                error: function(xhr, status, error) {
                    console.error("Error fetching notifications:", error);
                }
            });
        }

        function cekNotifikasiCompleted() {
            $.ajax({
                url: "{{ route('notif.completed') }}",
                type: "GET",
                success: function(data) {
                    if (data > 0) {
                        $(".notif-completed").html(`
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="bi bi-check-circle me-1"></i>
                            🎉 ${data} surat telah selesai! Silahkan dicetak. | Cek <a href="">Disini</a>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    `);

                        // Auto close setelah 5 detik
                        // setTimeout(function() {
                        //     $(".notif-completed .alert").fadeOut("slow", function() {
                        //         $(this).remove(); // Hapus dari DOM
                        //     });
                        // }, 5000);
                    }
                },
                error: function(xhr, status, error) {
                    console.error("Error fetching completed notifications:", error);
                }
            });
        }

        // Panggil setiap 10 detik
        setInterval(cekNotifikasi, 10000);
        setInterval(cekNotifikasiCompleted, 10000);

        // Jalankan sekali saat halaman dimuat
        $(document).ready(function() {
            cekNotifikasi();
            cekNotifikasiCompleted();
        });
    </script>



    <section class="section dashboard">
        <div class="row">

            <!-- Left side columns -->
            <div class="col-lg-8">
                <div class="row">
                    <!-- Sales Card -->
                    <div class="col-xxl-4 col-md-6">
                        <div class="card info-card sales-card">
                            <div class="card-body">
                                <h5 class="card-title">Total <span>| Surat</span></h5>
                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="ri-mail-line text-success"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6 class="text-success">{{ $jumlahIsOk + $jumlahRejected + $jumlahPending }}</h6>
                                        <span class="text-muted small pt-1">surat</span>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- End Sales Card -->

                    <!-- Revenue Card -->
                    <div class="col-xxl-4 col-md-6">
                        <div class="card info-card revenue-card">
                            <div class="card-body">
                                <h5 class="card-title">Surat Selesai</h5>

                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-check"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6 class="text-success">{{ $jumlahIsOk }}</h6>
                                        <span class="text-muted small pt-1">surat</span>

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div><!-- End Revenue Card -->

                    <!-- Revenue Card -->
                    <div class="col-xxl-4 col-md-6">
                        <div class="card info-card customers-card">
                            <div class="card-body">
                                <h5 class="card-title">Surat Diproses</h5>
                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-clock-history"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6 class="text-success">{{ $jumlahPending }}</h6>
                                        <span class="text-muted small pt-1">surat menunggu verifikasi</span>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div><!-- End Revenue Card -->

                    <!-- Revenue Card -->
                    <div class="col-xxl-4 col-md-6">
                        <div class="card info-card customers-card">
                            <div class="card-body">
                                <h5 class="card-title">Surat Ditolak</h5>

                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-x text-danger"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6 class="text-success">{{ $jumlahRejected }}</h6>
                                        <span class="text-muted small pt-1">surat</span>

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div><!-- End Revenue Card -->
                    {{-- 
                    <!-- Customers Card -->
                    <div class="col-xxl-4 col-xl-12">

                        <div class="card info-card customers-card">

                            <div class="card-body">
                                <h5 class="card-title">Customers <span>| This Year</span></h5>

                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-people"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>1244</h6>
                                        <span class="text-danger small pt-1 fw-bold">12%</span> <span
                                            class="text-muted small pt-2 ps-1">decrease</span>

                                    </div>
                                </div>

                            </div>
                        </div>

                    </div><!-- End Customers Card --> --}}

                </div>
            </div><!-- End Left side columns -->

            <!-- Right side columns -->
            <div class="col-lg-4">
                <!-- Website Traffic -->
                <div class="card">
                    <div class="card-body pb-0">
                        <h5 class="card-title">Traffic <span>| Surat</span></h5>

                        <div id="trafficChart" style="min-height: 400px;" class="echart"></div>

                        <script>
                            document.addEventListener("DOMContentLoaded", () => {
                                let chartData = [{
                                        value: {{ $jumlahIsOk }},
                                        name: 'Surat Selesai',
                                    },
                                    {
                                        value: {{ $jumlahPending }},
                                        name: 'Surat Diproses'
                                    },
                                    {
                                        value: {{ $jumlahRejected }},
                                        name: 'Surat Ditolak'
                                    }
                                ];
                                echarts.init(document.querySelector("#trafficChart")).setOption({
                                    color: ['#198754', '#fac858', '#ef6766'], // Warna: Hijau, Kuning, Merah
                                    tooltip: {
                                        trigger: 'item'
                                    },
                                    legend: {
                                        top: '5%',
                                        left: 'center'
                                    },
                                    series: [{
                                        name: '',
                                        type: 'pie',
                                        radius: ['40%', '70%'],
                                        avoidLabelOverlap: false,
                                        label: {
                                            show: false,
                                            position: 'center'
                                        },
                                        emphasis: {
                                            label: {
                                                show: true,
                                                fontSize: '18',
                                                fontWeight: 'bold'
                                            }
                                        },
                                        labelLine: {
                                            show: false
                                        },
                                        data: chartData
                                    }]
                                });
                            });
                        </script>

                    </div>
                </div><!-- End Website Traffic -->

            </div><!-- End Right side columns -->

        </div>
    </section>





    </main><!-- End #main -->
@endsection
