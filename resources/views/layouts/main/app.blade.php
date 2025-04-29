@extends('layouts.app')
 
 
 
@push('styles')
    {{-- Estilos específicos para este layout --}}
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">
@endpush
 
@push('javascript')
    {{-- Scripts específicos para este layout --}}
@endpush
 
 
 
@section('slot')
    <!-- Sidebar -->
    @include('partials.siderbar')
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <!-- Main Content -->
        @yield('content')
    </main>
@endsection