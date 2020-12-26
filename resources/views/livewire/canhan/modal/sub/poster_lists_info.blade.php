<div class="col-12 mb-3 h-max-content">
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <h5 class="text-info">Dánh sách Poster:</h5>
            </div>
        </div>

        @if (!!$poster_chitiets)

            @foreach ($poster_chitiets as $key => $poster_chitiet)

                <div class="col-md-12">
                    <div class="{{ $key != 0 ? 'border-top border-totaa pt-3' : '' }} form-group">
                        <b class="text-info ml-3">Poster {{ $poster->poster_name->name." ".($key+1) }}: </b>
                    </div>
                </div>

                <div class="col-12 col-xl-6 mb-3 h-max-content">

                    @if (!!$poster_chitiet->hinhanhs)
                        <div wire:ignore wire:key="hinhanhs_{{ $poster_chitiet->id }}">
                            <div totaa-id="blueimp-carousel" class="blueimp-gallery blueimp-gallery-carousel blueimp-gallery-controls">
                                <div class="slides"></div>
                                <a class="prev">‹</a>
                                <a class="next">›</a>
                                <a class="play-pause"></a>
                                <ol class="indicator"></ol>

                                @if (!$editStatus)
                                    @foreach ($poster_chitiet->hinhanhs as $hinhanh)
                                        @php
                                            $gallery = $hinhanh->anh->getGallery();
                                        @endphp
                                        <a totaa-blueimp-carousel href="{{ $gallery["url"] }}" mine-type="{{ $gallery["mimetype"] }}" thumbnail="{{ $gallery["thumbnail"] }}" class="img-fluid hidden"></a>
                                    @endforeach
                                @endif

                            </div>
                        </div>
                    @endif

                </div>

                <div class="col-12 col-xl-6 mb-3 h-max-content">
                    <div class="row">

                        <div class="col-md-12">
                            <div class="form-group">
                                <h5 class="text-info">
                                    Thông số chi tiết:
                                    @if (!!!$editPosterID && !!!$editDiaDiemID && !!!$editPosterChiTietID && !!!$deletePosterChiTietID && $poster->trangthai_id == 5)
                                        <i wire:click.prevent="edit_poster_chitiet({{ $poster_chitiet->id }})" totaa-block-ui wire:loading.attr="disabled" class="ml-2 text-indigo fas fa-edit action-icon px-3"></i>
                                    @endif
                                </h5>
                            </div>
                        </div>

                        @if ($editPosterChiTietID == $poster_chitiet->id)

                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label class="col-form-label" for="poster_hinhthuc_id">Hình thức Poster:</label>
                                    <div class="select2-success" id="poster_hinhthuc_id_div">
                                        <select class="form-control px-2 select2-totaa" totaa-placeholder="Chọn hình thức Poster ..." totaa-search="10" wire:model="poster_hinhthuc_id" id="poster_hinhthuc_id" style="width: 100%">
                                            @if (!!count($poster_hinhthuc_arrays))
                                                <option selected></option>
                                                @foreach ($poster_hinhthuc_arrays as $poster_hinhthuc_array)
                                                    <option value="{{ $poster_hinhthuc_array["id"] }}">{{ $poster_hinhthuc_array["name"] }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    @error('poster_hinhthuc_id')
                                        <label class="pl-1 small invalid-feedback d-inline-block" ><i class="fas mr-1 fa-exclamation-circle"></i>{{ $message }}</label>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label class="col-form-label" for="poster_bemat_id">Chất liệu bề mặt:</label>
                                    <div class="select2-success" id="poster_bemat_id_div">
                                        <select class="form-control px-2 select2-totaa" totaa-placeholder="Chọn chất liệu bề mặt ..." totaa-search="10" wire:model="poster_bemat_id" id="poster_bemat_id" style="width: 100%">
                                            @if (!!count($poster_bemat_arrays))
                                                <option selected></option>
                                                @foreach ($poster_bemat_arrays as $poster_bemat_array)
                                                    <option value="{{ $poster_bemat_array["id"] }}">{{ $poster_bemat_array["name"] }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    @error('poster_bemat_id')
                                        <label class="pl-1 small invalid-feedback d-inline-block" ><i class="fas mr-1 fa-exclamation-circle"></i>{{ $message }}</label>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-12 col-md-6">
                                <div class="mb-3">
                                    <label class="col-form-label">Kích thước Poster:</label>
                                    <div class="d-flex">

                                        <div class="ngang">
                                            <label class="col-form-label p-0">
                                                <input type="text" class="form-control px-2" id="ngang" wire:model="ngang" autocomplete="off" placeholder="Ngang" pattern="\d+">
                                            </label>
                                            @error('ngang')
                                                <label class="pl-1 small invalid-feedback d-inline-block" ><i class="fas mr-1 fa-exclamation-circle"></i></label>
                                            @enderror
                                        </div><a class="mt-2 mx-3">x</a>

                                        <div class="doc">
                                            <label class="col-form-label p-0">
                                                <input type="text" class="form-control px-2" id="doc" wire:model="doc" autocomplete="off" placeholder="Dọc" pattern="\d+">
                                            </label>
                                            @error('doc')
                                                <label class="pl-1 small invalid-feedback d-inline-block" ><i class="fas mr-1 fa-exclamation-circle"></i></label>
                                            @enderror
                                        </div><i class="mt-2">(cm)</i>

                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label class="col-form-label" for="vitridan">Vị trí dán:</label>
                                    <div id="vitridan_div">
                                        <input type="text" class="form-control px-2" wire:model.lazy="vitridan" id="vitridan" style="width: 100%" placeholder="Mô tả vị trí dán ..." autocomplete="off">
                                    </div>
                                    @error('vitridan')
                                        <label class="pl-1 small invalid-feedback d-inline-block" ><i class="fas mr-1 fa-exclamation-circle"></i>{{ $message }}</label>
                                    @enderror
                                </div>
                            </div>


                            <div class="col-12">
                                <div class="form-group">
                                    <label class="col-form-label" for="ghichu">Ghi chú:</label>
                                    <div>
                                        <textarea class="form-control px-2" id="ghichu" wire:model.lazy="ghichu" placeholder="Các thông tin khác (nếu có)..." autocomplete="off" style="width: 100%"></textarea>
                                    </div>
                                    @error('ghichu')
                                        <label class="pl-1 small invalid-feedback d-inline-block" ><i class="fas mr-1 fa-exclamation-circle"></i>{{ $message }}</label>
                                    @enderror
                                </div>
                            </div>

                            <div class="modal-footer mx-auto">
                                <button wire:click.prevent="edit_poster_chitiet(false)" class="btn btn-danger" wire:loading.attr="disabled" totaa-block-ui>Hủy</button>
                                <button wire:click.prevent="save_edit_poster_chitiet()" class="btn btn-success" totaa-block-ui wire:loading.attr="disabled">Lưu</button>
                            </div>

                        @else
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label class="col-form-label">Hình thức Poster:</label>
                                    <div>
                                        <span type="text" class="form-control px-2 h-auto">{{ $poster_chitiet->hinhthuc->name }}</span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label class="col-form-label">Chất liệu bề mặt:</label>
                                    <div>
                                        <span type="text" class="form-control px-2 h-auto">{{ $poster_chitiet->chatlieubemat->name }}</span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label class="col-form-label">Kích thước:</label>
                                    <div>
                                        <div class="d-flex">
                                            <span type="text" class="form-control px-2 h-auto">{{ $poster_chitiet->ngang }} x {{ $poster_chitiet->doc }} <i>(cm) (ngang x dọc)</i></span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label class="col-form-label">Ví trí dán:</label>
                                    <div>
                                        <span type="text" class="form-control px-2 h-auto">{{ $poster_chitiet->vitridan }}</span>
                                    </div>
                                </div>
                            </div>

                            @if (!!$poster_chitiet->ghichu)
                                <div class="col-12">
                                    <div class="form-group">
                                        <label class="col-form-label">Ghi chú:</label>
                                        <div>
                                            <pre class="form-control px-2 h-auto">{{ $poster_chitiet->ghichu }}</pre>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label class="col-form-label">Trình dược viên:</label>
                                    <div>
                                        <span type="text" class="form-control px-2 h-auto">{{ $poster_chitiet->quanly_by->full_name }}</span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label class="col-form-label">Thời gian khảo sát:</label>
                                    <div>
                                        <span type="text" class="form-control px-2 h-auto">{{ $poster_chitiet->created_at->format('d-m-Y H:i') }}</span>
                                    </div>
                                </div>
                            </div>

                        @endif

                    </div>
                </div>



            @endforeach

        @endif
    </div>
</div>
