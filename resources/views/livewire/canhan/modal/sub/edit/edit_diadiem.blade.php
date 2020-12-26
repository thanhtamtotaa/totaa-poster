<div class="col-12 col-md-6">
    <div class="form-group">
        <label class="col-form-label text-indigo" for="loaidiadiem_id">Phân loại địa điểm:</label>
        <div class="select2-success" id="loaidiadiem_id_div">
            <select class="form-control px-2 select2-totaa" totaa-placeholder="Chọn loại địa điểm ..." totaa-search="6" wire:model="loaidiadiem_id" id="loaidiadiem_id" style="width: 100%">
                @if (!!count($diadiem_phanloai_arrays))
                    <option selected></option>
                    @foreach ($diadiem_phanloai_arrays as $diadiem_phanloai_array)
                        <option value="{{ $diadiem_phanloai_array["id"] }}">{{ $diadiem_phanloai_array["name"] }}</option>
                    @endforeach
                @endif
            </select>
        </div>
        @error('loaidiadiem_id')
            <label class="pl-1 small invalid-feedback d-inline-block" ><i class="fas mr-1 fa-exclamation-circle"></i>{{ $message }}</label>
        @enderror
    </div>
</div>

<div class="col-12 col-md-6">
    <div class="form-group">
        <label class="col-form-label text-indigo" for="tendiadiem">Tên địa điểm:</label>
        <div id="tendiadiem_div">
            <input type="text" class="form-control px-2" wire:model.lazy="tendiadiem" id="tendiadiem" style="width: 100%" placeholder="Tên điểm dán Poster ..." autocomplete="off">
        </div>
        @error('tendiadiem')
            <label class="pl-1 small invalid-feedback d-inline-block" ><i class="fas mr-1 fa-exclamation-circle"></i>{{ $message }}</label>
        @enderror
    </div>
</div>

<div class="col-12 col-md-6">
    <div class="form-group">
        <label class="col-form-label text-indigo" for="chudiadiem">Chủ địa điểm:</label>
        <div id="chudiadiem_div">
            <input type="text" class="form-control px-2" wire:model.lazy="chudiadiem" id="chudiadiem" style="width: 100%" placeholder="Họ tên chủ địa điểm ..." autocomplete="off">
        </div>
        @error('chudiadiem')
            <label class="pl-1 small invalid-feedback d-inline-block" ><i class="fas mr-1 fa-exclamation-circle"></i>{{ $message }}</label>
        @enderror
    </div>
</div>

<div class="col-12 col-md-6">
    <div class="form-group">
        <label class="col-form-label text-indigo" for="phone">Số điện thoại:</label>
        <div id="phone_div">
            <input type="text" class="form-control px-2" wire:model.lazy="phone" id="phone" style="width: 100%" placeholder="Số điện thoại chủ địa điểm ..." autocomplete="off">
        </div>
        @error('phone')
            <label class="pl-1 small invalid-feedback d-inline-block" ><i class="fas mr-1 fa-exclamation-circle"></i>{{ $message }}</label>
        @enderror
    </div>
</div>

<div class="col-12 col-md-6">
    <div class="form-group">
        <label class="col-form-label text-indigo" for="tinh_id">Tỉnh/Thành phố:</label>
        <div class="select2-success" id="tinh_id_div">
            <select class="form-control px-2 select2-totaa" totaa-placeholder="Chọn Tỉnh/Thành phố ..." totaa-search="10" wire:model="tinh_id" id="tinh_id" style="width: 100%">
                @if (!!count($tinh_arrays))
                    <option selected></option>
                    @foreach ($tinh_arrays as $tinh_array)
                        <option value="{{ $tinh_array["id"] }}">{{ $tinh_array["level"] }} {{ $tinh_array["name"] }}</option>
                    @endforeach
                @endif
            </select>
        </div>
        @error('tinh_id')
            <label class="pl-1 small invalid-feedback d-inline-block" ><i class="fas mr-1 fa-exclamation-circle"></i>{{ $message }}</label>
        @enderror
    </div>
</div>

<div class="col-12 col-md-6">
    <div class="form-group">
        <label class="col-form-label text-indigo" for="huyen_id">Quận/Huyện:</label>
        <div class="select2-success" id="huyen_id_div">
            <select class="form-control px-2 select2-totaa" totaa-placeholder="Chọn Quận/Huyện ..." totaa-search="10" wire:model="huyen_id" id="huyen_id" style="width: 100%">
                @if (!!count($huyen_arrays))
                    <option selected></option>
                    @foreach ($huyen_arrays as $huyen_array)
                        <option value="{{ $huyen_array["id"] }}">{{ $huyen_array["level"] }} {{ $huyen_array["name"] }}</option>
                    @endforeach
                @endif
            </select>
        </div>
        @error('huyen_id')
            <label class="pl-1 small invalid-feedback d-inline-block" ><i class="fas mr-1 fa-exclamation-circle"></i>{{ $message }}</label>
        @enderror
    </div>
</div>

<div class="col-12 col-md-6">
    <div class="form-group">
        <label class="col-form-label text-indigo" for="xa_id">Xã/Phường:</label>
        <div class="select2-success" id="xa_id_div">
            <select class="form-control px-2 select2-totaa" totaa-placeholder="Chọn Xã/Phường ..." totaa-search="10" wire:model="xa_id" id="xa_id" style="width: 100%">
                @if (!!count($xa_arrays))
                    <option selected></option>
                    @foreach ($xa_arrays as $xa_array)
                        <option value="{{ $xa_array["id"] }}">{{ $xa_array["level"] }} {{ $xa_array["name"] }}</option>
                    @endforeach
                @endif
            </select>
        </div>
        @error('xa_id')
            <label class="pl-1 small invalid-feedback d-inline-block" ><i class="fas mr-1 fa-exclamation-circle"></i>{{ $message }}</label>
        @enderror
    </div>
</div>

<div class="col-12 col-md-6">
    <div class="form-group">
        <label class="col-form-label text-indigo" for="diachi">Địa chỉ:</label>
        <div id="diachi_div">
            <input type="text" class="form-control px-2" wire:model.lazy="diachi" id="diachi" style="width: 100%" placeholder="Địa chỉ ..." autocomplete="off">
        </div>
        @error('diachi')
            <label class="pl-1 small invalid-feedback d-inline-block" ><i class="fas mr-1 fa-exclamation-circle"></i>{{ $message }}</label>
        @enderror
    </div>
</div>

<div class="col-12">
    <div class="form-group">
        <label class="col-form-label text-indigo" for="thongtinkhac">Thông tin khác:</label>
        <div>
            <textarea class="form-control px-2" id="thongtinkhac" wire:model.lazy="thongtinkhac" placeholder="Thông tin bổ sung khác (nếu có)..." autocomplete="off" style="width: 100%"></textarea>
        </div>
        @error('thongtinkhac')
            <label class="pl-1 small invalid-feedback d-inline-block" ><i class="fas mr-1 fa-exclamation-circle"></i>{{ $message }}</label>
        @enderror
    </div>
</div>

<div class="modal-footer mx-auto">

    <button wire:click.prevent="edit_diadiem(false)" class="btn btn-danger" wire:loading.attr="disabled" totaa-block-ui>Hủy</button>
    <button wire:click.prevent="save_edit_diadiem()" class="btn btn-success" totaa-block-ui wire:loading.attr="disabled">Lưu</button>

</div>
