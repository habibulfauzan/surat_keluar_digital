@extends('panel.layouts.app')
@section('title', 'LPM - List User')

@section('content')
    <div class="pagetitle">
        <h1>User List</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('') }}">Home</a></li>
                <li class="breadcrumb-item active">List</li>
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
                                <h5 class="card-title">User List</h5>
                            </div>
                            <div class="col-md-6" style="text-align: right">
                                @if (!@empty($PermissionAdd))
                                    <a class="btn btn-success btn-sm" style="margin-top: 10px"
                                        href="{{ url('panel/user/add') }}">
                                        <i class="bi bi-plus-lg"></i>
                                    </a>
                                @endif
                            </div>
                        </div>
                        <!-- Table with stripped rows -->
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Role</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $num = 1; ?>
                                    @foreach ($getRecord as $value)
                                        <tr>
                                            <th scope="row">{{ $num++ }}</th>
                                            <td>{{ $value->name }}</td>
                                            <td>{{ $value->email }}</td>
                                            <td>{{ $value->role_name }}</td>
                                            <td>
                                                <a href="{{ url('panel/user/edit/' . $value->id) }}"
                                                    class="btn btn-sm btn-success"> Edit </a>
                                                <a href="{{ url(
                                                    'panel/user/
                                                                                                delete/' . $value->id,
                                                ) }}"
                                                    class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                                    data-bs-target="#deleteUserModal"
                                                    data-delete-url="{{ url('panel/user/delete/' . $value->id) }}">
                                                    Hapus
                                                </a>
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

    <!-- Modal Konfirmasi Hapus -->
    <div class="modal fade" id="deleteUserModal" tabindex="-1" aria-labelledby="deleteUserModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteUserModalLabel">Konfirmasi Hapus</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin ingin menghapus user ini?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <a href="#" class="btn btn-danger" id="confirmDeleteBtn">Hapus</a>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var deleteUserModal = document.getElementById('deleteUserModal');
            deleteUserModal.addEventListener('show.bs.modal', function(event) {
                var button = event.relatedTarget;
                var deleteUrl = button.getAttribute('data-delete-url');
                var confirmBtn = document.getElementById('confirmDeleteBtn');
                confirmBtn.setAttribute('href', deleteUrl);
            });
        });
    </script>
@endsection
