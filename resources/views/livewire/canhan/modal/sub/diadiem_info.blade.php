<div class="col-12 col-xl-6 mb-3 h-max-content">
    <div class="row">
        @if (!!$diadiem)

        <div class="col-md-12">
            <div class="form-group">
                <h5 class="text-info">Thông tin địa điểm:
                    @if (!$editDiaDiemID && $poster->trangthai_id == 5)
                        <i wire:click.prevent="edit_diadiem({{ $diadiem->id }})" totaa-block-ui wire:loading.attr="disabled" class="ml-2 text-indigo fas fa-edit action-icon px-3"></i>
                    @endif
                </h5>
            </div>
        </div>

        @php
            $xa = $diadiem->xa;
            $huyen = $xa->huyen;
            $tinh = $huyen->tinh;
        @endphp

            @if ($editDiaDiemID == $diadiem->id)
                @include('totaa-poster::livewire.canhan.modal.sub.edit.edit_diadiem')
            @else
                <div class="col-12 col-md-6">
                    <div class="form-group">
                        <label class="col-form-label">Phân loại địa điểm:</label>
                        <div>
                            <span type="text" class="form-control px-2 h-auto">{{ $diadiem->loaidiadiem->name }}</span>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-6">
                    <div class="form-group">
                        <label class="col-form-label">Tên địa điểm:</label>
                        <div>
                            <span type="text" class="form-control px-2 h-auto">{{ $diadiem->tendiadiem }}</span>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-6">
                    <div class="form-group">
                        <label class="col-form-label">Chủ địa điểm:</label>
                        <div>
                            <span type="text" class="form-control px-2 h-auto">{{ $diadiem->chudiadiem }}</span>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-6">
                    <div class="form-group">
                        <label class="col-form-label">Số điện thoại:</label>
                        <div>
                            <span type="text" class="form-control px-2 h-auto">{{ $diadiem->phone }}</span>
                        </div>
                    </div>
                </div>

                <div class="col-12">
                    <div class="form-group">
                        <label class="col-form-label">Địa chỉ:</label>
                        <div>
                            <span type="text" class="form-control px-2 h-auto">{{ $diadiem->diachi." - ".$xa->level." ".$xa->name." - ".$huyen->level." ".$huyen->name." - ".$tinh->level." ".$tinh->name }}</span>
                        </div>
                    </div>
                </div>

                @if (!!$diadiem->thongtinkhac)
                    <div class="col-12">
                        <div class="form-group">
                            <label class="col-form-label">Thông tin khác:</label>
                            <div>
                                <pre class="form-control px-2 h-auto">{{ $diadiem->thongtinkhac }}</pre>
                            </div>
                        </div>
                    </div>
                @endif
            @endif


        @endif
    </div>
</div>
