@extends('panel.layouts.app')
@section('title', 'LPM - Role List')

@section('content')
    <div class="pagetitle">
        <h1>Role List</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('') }}">Home</a></li>
                <li class="breadcrumb-item active">Role</li>
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
                                <h5 class="card-title">Role Tables </h5>
                            </div>
                            <div class="col-md-6" style="text-align: right">
                                {{-- @if (!@empty($PermissionAdd))
                                    <a class="btn btn-success btn-sm" style="margin-top: 10px"
                                        href="{{ url('panel/role/add') }}">
                                        <i class="bi bi-plus-lg"></i>
                                    </a>
                                @endif --}}
                            </div>
                        </div>
                        <!-- Table with stripped rows -->
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Name</th>
                                        @if (!@empty($PermissionEdit) || !@empty($PermissionDelete))
                                            <th scope="col">Action</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $num = 1;
                                    @endphp
                                    @foreach ($getRecord as $value)
                                        <tr>
                                            <th scope="row">{{ $num++ }}</th>
                                            <td>{{ $value->name }}</td>
                                            <td>
                                                @if (!@empty($PermissionEdit))
                                                    <a href="{{ url('panel/role/edit/' . $value->id) }}"
                                                        class="btn btn-sm btn-success"> Edit </a>
                                                @endif
                                                @if (!@empty($PermissionDelete))
                                                    <a href="{{ url('panel/role/delete/' . $value->id) }}"
                                                        class="btn btn-sm btn-danger"> Delete </a>
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
