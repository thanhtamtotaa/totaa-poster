
@extends('layouts.layout-2')
@section('styles')
    <link rel="stylesheet" href="{{ mix('/vendor/libs/datatables/datatables.css') }}">
    <link rel="stylesheet" href="{{ mix('/vendor/libs/smartwizard/smartwizard.css') }}">
    <link rel="stylesheet" href="{{ mix('/vendor/libs/select2/select2.css') }}">
@endsection

@section('scripts')
    <!-- Dependencies -->
    <script src="{{ mix('/vendor/libs/moment/moment.js') }}"></script>
    <script src="{{ mix('/vendor/libs/datatables/datatables.js') }}"></script>
    <script src="{{ mix('/vendor/libs/select2/select2.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
@endsection

@push('datatables')
    {{$dataTable->scripts()}}
@endpush

@section('content')
    <h4 class="font-weight-bold py-3 mb-4">{{ $title }}</h4>

    <div class="card">

        @livewire('totaa-poster::canhan-livewire')

        <div class="card-datatable table-responsive pt-2">
            {{$dataTable->table(["totaa-datatables", "class" => "table table-striped table-bordered", "width" => "100%"])}}
        </div>

    </div>

@endsection
