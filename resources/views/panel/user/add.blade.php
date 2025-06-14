@extends('panel.layouts.app')
@section('title', 'LPM - Tambah User')

@section('content')
    <div class="pagetitle">
        <h1>Tambah User Baru</h1>
    </div>


    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Tambah User Baru</h5>

                        <form id="addUserForm" action="" method="post">
                            @csrf
                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-12 col-form-label">Nama</label>
                                <div class="col-sm-12">
                                    <input type="text" name="name" class="form-control" value="{{ old('name') }}"
                                        required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-12 col-form-label">Email</label>
                                <div class="col-sm-12">
                                    <input type="email" name="email" class="form-control" value="{{ old('email') }}"
                                        required>
                                    <div style="color:red"> {{ $errors->first('email') }} </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-12 col-form-label">Password</label>
                                <div class="col-sm-12">
                                    <input type="password" name="password" class="form-control" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-12 col-form-label">Role</label>
                                <div class="col-sm-12">
                                    <select name="role_id" class="form-control" required>
                                        <option value=""> Select</option>
                                        @foreach ($getRole as $value)
                                            <option {{ old('role_id') == $value->id ? 'selected' : '' }}
                                                value="{{ $value->id }}"> {{ $value->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>




                            <div class="row mb-3">
                                <div class="col-sm-12" style="text-align: right">
                                    <button type="button" id="submitBtn" class="btn btn-success">Submit</button>
                                </div>
                            </div>

                        </form><!-- End General Form Elements -->

                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Modal Konfirmasi -->
    <div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmModalLabel">Konfirmasi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin ingin menambah user baru?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batalkan</button>
                    <button type="button" class="btn btn-success" id="confirmSubmit">Yakin</button>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('style')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var submitBtn = document.getElementById('submitBtn');
            var confirmModal = new bootstrap.Modal(document.getElementById('confirmModal'));
            var confirmSubmit = document.getElementById('confirmSubmit');
            var addUserForm = document.getElementById('addUserForm');

            submitBtn.addEventListener('click', function(e) {
                e.preventDefault();
                confirmModal.show();
            });

            confirmSubmit.addEventListener('click', function() {
                addUserForm.submit();
            });
        });
    </script>
@endsection
