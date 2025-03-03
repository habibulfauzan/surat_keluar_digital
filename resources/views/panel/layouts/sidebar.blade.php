<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">
        @php
            $PermissionSuratKeluar = App\Models\PermissionRoleModel::getPermission(
                'Surat Keluar',
                Auth::user()->role_id,
            );
            $PermissionAksi = App\Models\PermissionRoleModel::getPermission('Verifikasi Surat', Auth::user()->role_id);
            $PermissionBuatSurat = App\Models\PermissionRoleModel::getPermission('Buat Surat', Auth::user()->role_id);
            $PermissionUser = App\Models\PermissionRoleModel::getPermission('User', Auth::user()->role_id);
            $PermissionRole = App\Models\PermissionRoleModel::getPermission('Role', Auth::user()->role_id);
            $PermissionSetting = App\Models\PermissionRoleModel::getPermission('Setting', Auth::user()->role_id);
        @endphp


        <li class="nav-item">
            <a class="nav-link @if (Request::segment(2) != 'dashboard') collapsed @endif" href="{{ url('panel/dashboard') }}">
                <i class="bi bi-grid text-success"></i>
                <span>Dashboard</span>
            </a>
        </li><!-- End Dashboard Nav -->

        @if (!empty($PermissionSuratKeluar))
            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#surat-keluar" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-menu-button-wide text-success"></i><span>Surat Keluar</span><i
                        class="bi bi-chevron-down ms-auto"></i>
                </a>
                @if (!empty($PermissionAksi))
                    <ul id="surat-keluar" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                        <li>
                            <a href="{{ url('panel/surat') }}">
                                <i class="bi bi-circle "></i><span>Menunggu Verifikasi</span>
                            </a>
                        </li>
                    </ul>
                @endif
                <ul id="surat-keluar" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="{{ url('panel/surat/selesai') }}">
                            <i class="bi bi-circle"></i><span>Surat Selesai</span>
                        </a>
                    </li>
                </ul>
                <ul id="surat-keluar" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="{{ url('panel/surat/ditolak') }}">
                            <i class="bi bi-circle"></i><span>Surat Ditolak</span>
                        </a>
                    </li>
                </ul>
                <ul id="surat-keluar" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="{{ url('panel/surat/all') }}">
                            <i class="bi bi-circle"></i><span>Semua Surat</span>
                        </a>
                    </li>
                </ul>
                {{-- <ul id="surat-keluar" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="{{ url('panel/surat/add_manual') }}">
                            <i class="bi bi-circle"></i><span>Input Surat Manual</span>
                        </a>
                    </li>
                </ul> --}}
            </li>
        @endif

        @if (!empty($PermissionBuatSurat))
            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-menu-button-wide text-success"></i><span>Buat Surat</span><i
                        class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="{{ url('panel/surat/add_undangan') }}">
                            <i class="bi bi-circle"></i><span>Surat Undangan</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('panel/surat/add_pengantar') }}">
                            <i class="bi bi-circle"></i><span>Surat Pengantar</span>
                        </a>
                    </li>
                    <li>
                    <li>
                        <a href="{{ url('panel/surat/add_tugas') }}">
                            <i class="bi bi-circle"></i><span>Surat Tugas LPM</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('panel/surat/add_lainnya') }}">
                            <i class="bi bi-circle"></i><span>Lainnya</span>
                        </a>
                    </li>
                </ul>
            </li><!-- End Components Nav -->

            {{-- <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-layout-text-window-reverse"></i><span>Tables</span><i
                    class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="tables-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="tables-general.html">
                        <i class="bi bi-circle"></i><span>General Tables</span>
                    </a>
                </li>
                <li>
                    <a href="tables-data.html">
                        <i class="bi bi-circle"></i><span>Data Tables</span>
                    </a>
                </li>
            </ul>
        </li><!-- End Tables Nav --> --}}

            {{-- <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#charts-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-bar-chart"></i><span>Charts</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="charts-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="charts-chartjs.html">
                        <i class="bi bi-circle"></i><span>Chart.js</span>
                    </a>
                </li>
                <li>
                    <a href="charts-apexcharts.html">
                        <i class="bi bi-circle"></i><span>ApexCharts</span>
                    </a>
                </li>
                <li>
                    <a href="charts-echarts.html">
                        <i class="bi bi-circle"></i><span>ECharts</span>
                    </a>
                </li>
            </ul>
        </li><!-- End Charts Nav --> --}}
        @endif
        @if (!empty($PermissionUser))
            <li class="nav-heading ">Account</li>

            <li class="nav-item">
                <a class="nav-link @if (Request::segment(2) != 'user') collapsed @endif" href="{{ url('panel/user') }}">
                    <i class="bi bi-person text-success"></i>
                    <span>User</span>
                </a>
            </li>
        @endif

        @if (!empty($PermissionRole))
            <li class="nav-item">
                <a class="nav-link @if (Request::segment(2) != 'role') collapsed @endif" href="{{ url('panel/role') }}">
                    <i class="bi bi-person text-success"></i>
                    <span>Role</span>
                </a>
            </li>
        @endif

        @if (!empty($PermissionSetting))
            <li class="nav-item">
                <a class="nav-link @if (Request::segment(2) != 'setting') collapsed @endif"
                    href="{{ url('panel/setting') }}">
                    <i class="bi bi-person"></i>
                    <span>Setting</span>
                </a>
            </li>
        @endif

    </ul>

</aside><!-- End Sidebar-->
