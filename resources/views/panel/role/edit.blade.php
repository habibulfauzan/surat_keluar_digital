@extends('panel.layouts.app')
@section('title', 'LPM - Edit Role')

@section('content')
    <div class="pagetitle">
        <h1>Edit Role</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ url('panel/role') }}">Role</a></li>
                <li class="breadcrumb-item active">Edit</li>
            </ol>
        </nav>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="confirmationModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmationModalLabel">Konfirmasi Update</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin ingin mengupdate role ini?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-success" id="confirmSubmit">Ya, Update</button>
                </div>
            </div>
        </div>
    </div>

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                @error('permission_id')
                    <div class="alert alert-danger" role="alert">{{ $message }}</div>
                @enderror
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Edit Role</h5>

                        <form action="" method="post" id="roleForm">
                            @csrf
                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-12 col-form-label">Name</label>
                                <div class="col-sm-12">
                                    <input type="text" value="{{ $getRecord->name }}" name="name" class="form-control"
                                        required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-12 col-form-label"
                                    style="display: block; margin-bottom: 10px;"><b>Permission</b>
                                </label>

                                @foreach ($getPermission as $value)
                                    @php
                                        $checked = '';
                                    @endphp
                                    <div class="row" style="margin-bottom: 10px;">
                                        <div class="col-md-3">
                                            {{ $value['name'] }}
                                        </div>

                                        <div class="col-sm-9">
                                            <div class="row">
                                                @foreach ($value['group'] as $group)
                                                    @php
                                                        $checked = '';
                                                    @endphp
                                                    @foreach ($getRolePermission as $role)
                                                        @if ($role->permission_id == $group['id'])
                                                            @php
                                                                $checked = 'checked';
                                                            @endphp
                                                        @endif
                                                    @endforeach

                                                    <div class="col-md-3">
                                                        <label>
                                                            <input type="checkbox" {{ $checked }}
                                                                value="{{ $group['id'] }}" name="permission_id[]">
                                                            {{ $group['name'] }}
                                                        </label>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                @endforeach
                            </div>

                            <div class="row mb-3">
                                <div class="col-sm-12" style="text-align: right">
                                    <button type="button" class="btn btn-success" id="showModal">Update</button>
                                </div>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('roleForm');
            const showModalBtn = document.getElementById('showModal');
            const confirmSubmitBtn = document.getElementById('confirmSubmit');
            const modal = new bootstrap.Modal(document.getElementById('confirmationModal'));

            showModalBtn.addEventListener('click', function() {
                if (form.checkValidity()) {
                    modal.show();
                } else {
                    form.reportValidity();
                }
            });

            confirmSubmitBtn.addEventListener('click', function() {
                form.submit();
            });
        });
    </script>
@endsection
