@extends('layouts.backend.app')

@push('styles')
    <style>
        div.dataTables_filter,
        div.dataTables_length {
            margin: 0 !important;
        }

    </style>
@endpush

@section('breadcumb')
    <h3>@yield('title')</h3>
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('frontend.home.index') }}">Home</a>
        </li>
        <li class="breadcrumb-item">Backend</li>
        <li class="breadcrumb-item">Admin</li>
        <li class="breadcrumb-item"><a href="{{ route('backend.admin.permissions.index') }}">Roles</a></li>
    </ol>
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <h5 class="text-center">Manajemen Permissions</h5>
            <p class="text-muted text-center mb-0">Sistem Informasi {{ config('app.name') }}</p>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12 table-responsive">
                    <table id="table_data" class="table table-striped table-bordered table-hover"></table>
                </div>
            </div>
        </div>
    </div>

    <!-- END Page Content -->

    <!-- Modal -->
    @include('contents.backend.admin.permissions.modal.tambah')
    @include('contents.backend.admin.permissions.modal.ubah')
@endsection

@push('scripts')
    @include('contents.backend.admin.permissions.index_js')
@endpush
