
@extends('layouts.layout-2')
@section('styles')
    <link rel="stylesheet" href="{{ mix('/vendor/libs/datatables/datatables.css') }}">
    <link rel="stylesheet" href="{{ mix('/vendor/libs/smartwizard/smartwizard.css') }}">
    <link rel="stylesheet" href="{{ mix('/vendor/libs/select2/select2.css') }}">
    <link rel="stylesheet" href="{{ mix('/vendor/libs/blueimp-gallery/gallery.css') }}">
    <link rel="stylesheet" href="{{ mix('/vendor/libs/blueimp-gallery/gallery-indicator.css') }}">
    <link rel="stylesheet" href="{{ mix('/vendor/libs/blueimp-gallery/gallery-video.css') }}">
@endsection

@section('scripts')
    <!-- Dependencies -->
    <script src="{{ mix('/vendor/libs/moment/moment.js') }}"></script>
    <script src="{{ mix('/vendor/libs/datatables/datatables.js') }}"></script>
    <script src="{{ mix('/vendor/libs/select2/select2.js') }}"></script>
    <script src="{{ mix('/vendor/libs/blueimp-gallery/gallery.js') }}"></script>
    <script src="{{ mix('/vendor/libs/blueimp-gallery/gallery-fullscreen.js') }}"></script>
    <script src="{{ mix('/vendor/libs/blueimp-gallery/gallery-indicator.js') }}"></script>
    <script src="{{ mix('/vendor/libs/blueimp-gallery/gallery-video.js') }}"></script>
    <script src="{{ mix('/vendor/libs/blueimp-gallery/gallery-vimeo.js') }}"></script>
    <script src="{{ mix('/vendor/libs/blueimp-gallery/gallery-youtube.js') }}"></script>
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
