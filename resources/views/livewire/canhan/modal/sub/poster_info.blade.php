<div class="col-12 col-xl-6 mb-3 h-max-content">
    <div class="row">

        @if (!!$poster)

        <div class="col-md-12">
            <div class="form-group">
                <h5 class="text-info">
                    Thông tin Poster:
                    @if (!!!$editPosterID && !!!$editDiaDiemID && $poster->trangthai_id == 5)
                        <i wire:click.prevent="edit_poster({{ $poster->id }})" totaa-block-ui wire:loading.attr="disabled" class="ml-2 text-indigo fas fa-edit action-icon px-3"></i>
                    @endif
                </h5>
            </div>
        </div>

            <div class="col-12 col-md-6">
                <div class="form-group">
                    <label class="col-form-label">Mã Poster:</label>
                    <div>
                        <span type="text" class="form-control px-2 h-auto">{{ $poster->poster_code }}</span>
                    </div>
                </div>
            </div>

            @if ($editPosterID == $poster->id)

                <div class="col-12 col-md-6">
                    <div class="form-group">
                        <label class="col-form-label text-indigo" for="poster_name_id">Tên Poster:</label>
                        <div class="select2-success" id="poster_name_id_div">
                            <select class="form-control px-2 select2-totaa" totaa-placeholder="Chọn Poster ..." totaa-search="6" wire:model="poster_name_id" id="poster_name_id" style="width: 100%">
                                @if (!!count($poster_name_arrays))
                                    <option selected></option>
                                    @foreach ($poster_name_arrays as $poster_name_array)
                                        <option value="{{ $poster_name_array["id"] }}">{{ $poster_name_array["name"] }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        @error('poster_name_id')
                            <label class="pl-1 small invalid-feedback d-inline-block" ><i class="fas mr-1 fa-exclamation-circle"></i>{{ $message }}</label>
                        @enderror
                    </div>
                </div>

                <div class="col-12 col-md-6">
                    <div class="form-group">
                        <label class="col-form-label text-indigo" for="mucthuong_id">Mức trả thưởng:</label>
                        <div class="select2-success" id="mucthuong_id_div">
                            <select class="form-control px-2 select2-totaa" totaa-placeholder="Chọn mức trả thưởng ..." totaa-search="10" wire:model="mucthuong_id" id="mucthuong_id" style="width: 100%">
                                @if (!!count($poster_mucthuong_arrays))
                                    <option selected></option>
                                    @foreach ($poster_mucthuong_arrays as $poster_mucthuong_array)
                                        <option value="{{ $poster_mucthuong_array["id"] }}">{{ $poster_mucthuong_array["mucthuong"] }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        @error('mucthuong_id')
                            <label class="pl-1 small invalid-feedback d-inline-block" ><i class="fas mr-1 fa-exclamation-circle"></i>{{ $message }}</label>
                        @enderror
                    </div>
                </div>

            @else
                <div class="col-12 col-md-6">
                    <div class="form-group">
                        <label class="col-form-label">Tên Poster:</label>
                        <div>
                            <span type="text" class="form-control px-2 h-auto">{{ $poster->poster_name->name }}</span>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-6">
                    <div class="form-group">
                        <label class="col-form-label">Mức trả thưởng:</label>
                        <div>
                            <span type="text" class="form-control px-2 h-auto">{{ $poster->muctrathuong->mucthuong }}</span>
                        </div>
                    </div>
                </div>
            @endif

            <div class="col-12 col-md-6">
                <div class="form-group">
                    <label class="col-form-label">Trạng thái:</label>
                    <div>
                        <span type="text" class="form-control px-2 h-auto">{{ $poster->trangthai->status }}</span>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-6">
                <div class="form-group">
                    <label class="col-form-label">Trình dược viên:</label>
                    <div>
                        <span type="text" class="form-control px-2 h-auto">{{ $poster->quanly_by->full_name }}</span>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-6">
                <div class="form-group">
                    <label class="col-form-label">Thời gian khảo sát:</label>
                    <div>
                        <span type="text" class="form-control px-2 h-auto">{{ $poster->created_at->format('d-m-Y H:i') }}</span>
                    </div>
                </div>
            </div>

            @if ($editPosterID == $poster->id)
                <div class="modal-footer mx-auto">
                    <button wire:click.prevent="edit_poster(false)" class="btn btn-danger" wire:loading.attr="disabled" totaa-block-ui>Hủy</button>
                    <button wire:click.prevent="save_edit_poster()" class="btn btn-success" totaa-block-ui wire:loading.attr="disabled">Lưu</button>
                </div>
            @endif

        @endif
    </div>
</div>
