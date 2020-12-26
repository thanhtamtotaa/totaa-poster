
<div wire:ignore.self class="modal fade" id="add_poster_modal" tabindex="-1" role="dialog" aria-labelledby="add_poster_modal" aria-hidden="true" data-toggle="modal" data-backdrop="static" data-keyboard="false">

    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content py-2">
            <div class="modal-header">
                <h4 class="modal-title text-success"><span class="fas fa-map-marked-alt mr-3"></span>{{ $modal_title }}</h4>
                <button type="button" wire:click.prevent="cancel()" class="close" data-dismiss="modal" wire:loading.attr="disabled" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            @if ($updateMode && !$editStatus)

            <div class="modal-body">
                <div class="container-fluid mx-0 px-0">
                    <div class="row">


                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label class="col-form-label">Mã Poster:</label>
                                <div>
                                    <span type="text" class="form-control px-2 h-auto">{{ !!$poster ? $poster->poster_code : null }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label class="col-form-label">Tên Poster:</label>
                                <div>
                                    <span type="text" class="form-control px-2 h-auto">{{ !!$poster ? $poster->poster_name->name : null }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-group">
                                <label class="col-form-label">Tên địa điểm:</label>
                                <div>
                                    <span type="text" class="form-control px-2 h-auto">{{ !!$diadiem ? $diadiem->tendiadiem : null }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-group">
                                <label class="col-form-label">Địa chỉ:</label>
                                <div>
                                    <span type="text" class="form-control px-2 h-auto">{{ !!$diadiem ? $diadiem->diachi." - ".$diadiem->xa->level." ".$diadiem->xa->name." - ".$diadiem->xa->huyen->level." ".$diadiem->xa->huyen->name." - ".$diadiem->xa->huyen->tinh->level." ".$diadiem->xa->huyen->tinh->name : null }}</span>
                                </div>
                            </div>
                        </div>

                        @if (Auth::user()->bfo_info->hasAnyRole("khaosat-poster"))
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label class="col-form-label text-indigo" for="team_id">Nhóm:</label>
                                    <div class="select2-success" id="team_id_div">
                                        <select class="form-control px-2 select2-totaa" totaa-placeholder="Chọn nhóm ..." totaa-search="6" wire:model="team_id" id="team_id" style="width: 100%">
                                            @if (!!count($team_arrays))
                                                <option selected></option>
                                                @foreach ($team_arrays as $team_array)
                                                    <option value="{{ $team_array["id"] }}">{{ $team_array["name"] }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    @error('team_id')
                                        <label class="pl-1 small invalid-feedback d-inline-block" ><i class="fas mr-1 fa-exclamation-circle"></i>{{ $message }}</label>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label class="col-form-label text-indigo" for="belongto_mnv">Trình dược viên:</label>
                                    <div class="select2-success" id="belongto_mnv_div">
                                        <select class="form-control px-2 select2-totaa" totaa-placeholder="Chọn trình dược viên ..." totaa-search="6" wire:model="belongto_mnv" id="belongto_mnv" style="width: 100%">
                                            @if (!!count($tdv_arrays))
                                                <option selected></option>
                                                @foreach ($tdv_arrays as $tdv_array)
                                                    <option value="{{ $tdv_array["mnv"] }}">{{ $tdv_array["full_name"] }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    @error('belongto_mnv')
                                        <label class="pl-1 small invalid-feedback d-inline-block" ><i class="fas mr-1 fa-exclamation-circle"></i>{{ $message }}</label>
                                    @enderror
                                </div>
                            </div>
                        @endif

                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label class="col-form-label text-indigo" for="poster_hinhthuc_id">Hình thức Poster:</label>
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
                                <label class="col-form-label text-indigo" for="poster_bemat_id">Chất liệu bề mặt:</label>
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
                                <label class="col-form-label text-indigo">Kích thước Poster:</label>
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
                                <label class="col-form-label text-indigo" for="vitridan">Vị trí dán:</label>
                                <div id="vitridan_div">
                                    <input type="text" class="form-control px-2" wire:model.lazy="vitridan" id="vitridan" style="width: 100%" placeholder="Mô tả vị trí dán ..." autocomplete="off">
                                </div>
                                @error('vitridan')
                                    <label class="pl-1 small invalid-feedback d-inline-block" ><i class="fas mr-1 fa-exclamation-circle"></i>{{ $message }}</label>
                                @enderror
                            </div>
                        </div>


                        <div class="col-12">
                            <div class="form-group mb-1">
                                <label class="col-form-label text-indigo">Hình ảnh:</label>
                            </div>
                        </div>


                        <div class="col-12">
                            <div class="form-group mb-1 px-2">
                                <div>
                                    <input type="file" accept="image/*" class="form-control" id="hinhanh1" wire:model="hinhanh1" style="width: 100%;overflow: hidden;">
                                </div>
                                @error('hinhanh1')
                                    <label class="pl-1 small invalid-feedback d-inline-block" ><i class="fas mr-1 fa-exclamation-circle"></i>{{ $message }}</label>
                                @enderror
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-group mb-1 px-2">
                                <div>
                                    <input type="file" accept="image/*" class="form-control" wire:model="hinhanh2" style="width: 100%;overflow: hidden;">
                                </div>
                                @error('hinhanh2')
                                    <label class="pl-1 small invalid-feedback d-inline-block" ><i class="fas mr-1 fa-exclamation-circle"></i>{{ $message }}</label>
                                @enderror
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-group px-2">
                                <div>
                                    <input type="file" accept="image/*" class="form-control" wire:model="hinhanh3" style="width: 100%;overflow: hidden;">
                                </div>
                                @error('hinhanh3')
                                    <label class="pl-1 small invalid-feedback d-inline-block" ><i class="fas mr-1 fa-exclamation-circle"></i>{{ $message }}</label>
                                @enderror
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-group">
                                <label class="col-form-label text-indigo" for="ghichu">Ghi chú:</label>
                                <div>
                                    <textarea class="form-control px-2" id="ghichu" wire:model.lazy="ghichu" placeholder="Các thông tin khác (nếu có)..." autocomplete="off" style="width: 100%"></textarea>
                                </div>
                                @error('ghichu')
                                    <label class="pl-1 small invalid-feedback d-inline-block" ><i class="fas mr-1 fa-exclamation-circle"></i>{{ $message }}</label>
                                @enderror
                            </div>
                        </div>


                    </div>
                </div>
            </div>

            @endif

            <div class="modal-footer mx-auto">

                <button wire:click.prevent="cancel()" class="btn btn-danger" wire:loading.attr="disabled" data-dismiss="modal">Đóng</button>
                <button wire:click.prevent="TotaaFileUploadSubmit('add_poster')" totaa-file-upload-blockui class="btn btn-success" wire:loading.attr="disabled">Thêm</button>

            </div>

        </div>
    </div>

</div>
