@extends('layouts.backend.app')

@section('breadcumb')
    <h3>@yield('title')</h3>
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('frontend.home.index') }}">Home</a>
        </li>
        <li class="breadcrumb-item">Backend</li>
        <li class="breadcrumb-item">Admin</li>
        <li class="breadcrumb-item"><a href="{{ route('trusty.permissions.index') }}">Roles</a></li>
    </ol>
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <h5 class="text-center">Kelola Data Permissions</h5>
            <p class="text-muted text-center mb-0">Sistem Informasi {{ config('app.name') }}</p>
        </div>
    </div>


    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="text-right mb-3">
                        <a href="{{ route('trusty.permissions.create') }}" class="btn btn-primary"><em
                                class="fa fa-plus"></em>
                            New Permissions</a>
                    </div>
                </div>
                <div class="col-md-12 table-responsive">
                    <table class="table table-bordered table-striped table-hover" id="permissions-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Display Name</th>
                                <th>Description</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($permissions as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td><a href="{{ route('trusty.permissions.show', $item) }}">{{ $item->name }}</a>
                                    </td>
                                    <td>{{ $item->display_name }}</td>
                                    <td>{{ $item->description }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- END Page Content -->

@endsection

@push('scripts')
    <script>
        $('#permissions-table').dataTable();
    </script>
@endpush
