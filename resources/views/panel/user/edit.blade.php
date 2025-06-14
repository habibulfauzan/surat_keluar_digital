@extends('panel.layouts.app')
@section('title', 'LPM - Edit User')

@section('content')
    <div class="pagetitle">
        <h1>Edit User</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ url('panel/user') }}">User</a></li>
                <li class="breadcrumb-item active">Edit</li>
            </ol>
        </nav>
    </div>


    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Edit User</h5>

                        <form action="" method="post" id="editUserForm">
                            @csrf
                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-12 col-form-label">Name</label>
                                <div class="col-sm-12">
                                    <input type="text" name="name" class="form-control" value="{{ $getRecord->name }}"
                                        required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-12 col-form-label">Email</label>
                                <div class="col-sm-12">
                                    <input type="email" name="email" class="form-control"
                                        value="{{ $getRecord->email }}" readonly>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-12 col-form-label">Password</label>
                                <div class="col-sm-12">
                                    <input type="text" name="password" class="form-control">
                                    (Change Password?)
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-12 col-form-label">Role</label>
                                <div class="col-sm-12">
                                    <select name="role_id" class="form-control" required>
                                        <option value=""> Select</option>
                                        @foreach ($getRole as $value)
                                            <option {{ $getRecord->role_id == $value->id ? 'selected' : '' }}
                                                value="{{ $value->id }}"> {{ $value->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>




                            <div class="row mb-3">
                                <div class="col-sm-12" style="text-align: right">
                                    <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                        data-bs-target="#confirmModal">Update</button>
                                </div>
                            </div>

                        </form><!-- End General Form Elements -->

                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Modal -->
    <div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmModalLabel">Konfirmasi Update</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin ingin mengupdate data user ini?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-success"
                        onclick="document.getElementById('editUserForm').submit()">Ya, Update</button>
                </div>
            </div>
        </div>
    </div>
@endsection
