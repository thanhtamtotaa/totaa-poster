<div>
    <!-- Filters and Add Buttons -->
    @include('totaa-poster::livewire.canhan.support.filters')

    <!-- Incluce các modal -->
    @include('totaa-poster::livewire.canhan.modal.add_edit_modal')

    <!-- Scripts -->
    @push('livewires')
        @include('totaa-poster::livewire.canhan.support.script')
    @endpush

    <!-- Style -->
    @push('styles')
        @include('totaa-poster::livewire.canhan.support.style')
    @endpush
</div>
