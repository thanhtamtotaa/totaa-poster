<div>
    <!-- Filters and Add Buttons -->
    @include('totaa-poster::livewire.canhan.support.filters')

    <!-- Incluce các modal -->
    @include('totaa-poster::livewire.canhan.modal.add_edit_modal')
    @include('totaa-poster::livewire.canhan.modal.delete_modal')
    @include('totaa-poster::livewire.canhan.modal.add_poster_modal')
    @include('totaa-poster::livewire.canhan.modal.view_poster_modal')

    <!-- Scripts -->
    @push('livewires')
        @include('totaa-poster::livewire.canhan.support.script')
    @endpush

    <!-- Style -->
    @push('styles')
        @include('totaa-poster::livewire.canhan.support.style')
    @endpush
</div>
