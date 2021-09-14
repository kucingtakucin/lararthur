@extends('layouts.backend.app')

@push('styles')
    @include('contents.backend.admin.dashboard.css.style_css')
@endpush

@section('breadcumb')
    <h3>@yield('title')</h3>
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('frontend.home.index') }}">Home</a>
        </li>
        <li class="breadcrumb-item">Backend</li>
        <li class="breadcrumb-item">Admin</li>
        <li class="breadcrumb-item"><a href="{{ route('backend.admin.dashboard.index') }}">Dashboard</a></li>
    </ol>
@endsection

@section('content')
    <div class="card">
    <div class="card-header">
        <h5>Selamat Datang di Halaman Admin</h5>
        <div class="card-header-right">
            <ul class="list-unstyled card-option">
                <li><i class="fa fa-spin fa-cog"></i></li>
                <li><i class="icofont icofont-maximize full-card"></i></li>
                <li><i class="icofont icofont-minus minimize-card"></i></li>
                <li><i class="icofont icofont-refresh reload-card"></i></li>
            </ul>
        </div>
    </div>
    <div class="card-body">
        <div id="chart_dashboard"></div>
    </div>
</div>
@endsection

@push('scripts')
    @include('contents.backend.admin.dashboard.js.script_js')
@endpush