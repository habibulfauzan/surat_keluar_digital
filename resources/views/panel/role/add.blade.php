@extends('panel.layouts.app')

@section('content')
    <div class="pagetitle">
        <h1>Add New Role</h1>
    </div>


    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                @error('permission_id')
                    <div class="alert alert-danger" role="alert">{{ $message }}</div>
                @enderror

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Add New Role</h5>

                        <form action="" method="post" id="permissionForm">
                            @csrf
                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-12 col-form-label">Name</label>
                                <div class="col-sm-12">
                                    <input type="text" name="name" class="form-control" required>
                                </div>
                            </div>


                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-12 col-form-label"
                                    style="display: block; margin-bottom: 10px;"><b>Permission</b>
                                </label>


                                @foreach ($getPermission as $value)
                                    <div class="row" style="margin-bottom: 10px;">
                                        <div class="col-md-3">
                                            {{ $value['name'] }}
                                        </div>

                                        <div class="col-sm-9">
                                            <div class="row">
                                                @foreach ($value['group'] as $group)
                                                    <div class="col-md-3">
                                                        <label>
                                                            <input type="checkbox" value="{{ $group['id'] }}"
                                                                name="permission_id[]"> {{ $group['name'] }}
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
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>

                        </form><!-- End General Form Elements -->
                        {{-- 
                        <script>
                            document.getElementById('permissionForm').addEventListener('submit', function(event) {
                                // Ambil semua checkbox dengan nama "permission_ids[]"
                                var checkboxes = document.querySelectorAll('input[name="permission_ids[]"]:checked');

                                // Jika tidak ada checkbox yang dipilih, tampilkan alert dan batalkan submit
                                if (checkboxes.length === 0) {
                                    alert('Harap pilih minimal satu permission.');
                                    event.preventDefault(); // Mencegah form untuk disubmit
                                }
                            });
                        </script> --}}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
