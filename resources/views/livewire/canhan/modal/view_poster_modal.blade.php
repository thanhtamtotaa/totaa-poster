
<div wire:ignore.self class="modal fade" id="view_poster_modal" tabindex="-1" role="dialog" aria-labelledby="view_poster_modal" aria-hidden="true" data-toggle="modal" data-backdrop="static" data-keyboard="false">

    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content py-2">
            <div class="modal-header">
                <h4 class="modal-title text-success"><span class="fas fa-map-marked-alt mr-3"></span>Thông tin chia tiết Poster</h4>
                <button type="button" wire:click.prevent="cancel()" class="close" data-dismiss="modal" wire:loading.attr="disabled" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="container-fluid mx-0 px-0">

                    <div class="row">
                        @include('totaa-poster::livewire.canhan.modal.sub.diadiem_info')
                        @include('totaa-poster::livewire.canhan.modal.sub.poster_info')
                        @include('totaa-poster::livewire.canhan.modal.sub.poster_lists_info')
                    </div>

                </div>
            </div>

            <div class="modal-footer mx-auto">
                <button wire:click.prevent="cancel()" class="btn btn-danger" wire:loading.attr="disabled" data-dismiss="modal">Đóng</button>
            </div>

        </div>
    </div>

</div>
