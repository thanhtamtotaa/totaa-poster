
<div wire:ignore.self class="modal fade" id="add_edit_modal" tabindex="-1" role="dialog" aria-labelledby="add_edit_modal" aria-hidden="true" data-toggle="modal" data-backdrop="static" data-keyboard="false">

    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content py-2">
            <div class="modal-header">
                <h4 class="modal-title text-success"><span class="fas fa-map-marked-alt mr-3"></span>{{ $modal_title }}</h4>
                <button type="button" wire:click.prevent="cancel()" class="close" data-dismiss="modal" wire:loading.attr="disabled" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="container-fluid mx-0 px-0">
                    <form class="sw-main sw-theme-default">

                        <ul class="px-0 py-0 mb-2 nav nav-tabs step-anchor" id="Poster_CaNhan_Add_ul">
                            <li class="nav-item {{ $add_diemdan_step == 1 ? "active" : null }} {{ $add_diemdan_step == 2 ? "done" : null }}">
                                <a class="mb-3 nav-link">
                                    <span class="sw-done-icon ion ion-md-checkmark"></span>
                                    <span class="sw-number">1</span>
                                    <div class="text-muted small">Bước 1</div>
                                    Thông tin điểm dán
                                </a>
                            </li>
                            <li class="nav-item {{ $add_diemdan_step == 2 ? "active" : null }}">
                                <a class="mb-3 nav-link">
                                    <span class="sw-done-icon ion ion-md-checkmark"></span>
                                    <span class="sw-number">2</span>
                                    <div class="text-muted small">Bước 2</div>
                                    Thông tin Poster
                                </a>
                            </li>
                        </ul>

                        <div class="row {{ $add_diemdan_step == 1 ? null : "d-none" }}">

                            @if (Auth::user()->bfo_info->hasAnyRole("khaosat-poster"))
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label class="col-form-label" for="team_id">Nhóm:</label>
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
                                        <label class="col-form-label" for="belongto_mnv">Trình dược viên:</label>
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
                                    <label class="col-form-label" for="loaidiadiem_id">Phân loại địa điểm:</label>
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
                                    <label class="col-form-label" for="tendiadiem">Tên địa điểm:</label>
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
                                    <label class="col-form-label" for="chudiadiem">Chủ địa điểm:</label>
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
                                    <label class="col-form-label" for="phone">Số điện thoại:</label>
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
                                    <label class="col-form-label" for="tinh_id">Tỉnh/Thành phố:</label>
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
                                    <label class="col-form-label" for="huyen_id">Quận/Huyện:</label>
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
                                    <label class="col-form-label" for="xa_id">Xã/Phường:</label>
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
                                    <label class="col-form-label" for="diachi">Địa chỉ:</label>
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
                                    <label class="col-form-label" for="thongtinkhac">Thông tin khác:</label>
                                    <div>
                                        <textarea class="form-control px-2" id="thongtinkhac" wire:model.lazy="thongtinkhac" placeholder="Thông tin bổ sung khác (nếu có)..." autocomplete="off" style="width: 100%"></textarea>
                                    </div>
                                    @error('thongtinkhac')
                                        <label class="pl-1 small invalid-feedback d-inline-block" ><i class="fas mr-1 fa-exclamation-circle"></i>{{ $message }}</label>
                                    @enderror
                                </div>
                            </div>


                        </div>


                        <div class="row  {{ $add_diemdan_step == 2 ? null : "d-none" }}">

                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="poster_name" class="col-form-label">Tên Poster:</label>
                                    <div id="poster_name_div">
                                        <select class="form-control" name="poster_name" id="poster_name" required style="width: 100%"  data-msg="<i class='fas mr-1 fa-exclamation-circle'></i>Vui lòng chọn Poster">
                                            <option selected></option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                        </div>


                    </form>
                </div>
            </div>

            <div class="modal-footer mx-auto">
                @if ($add_diemdan_step == 1)
                    <button wire:loading.attr="disabled" wire:click.prevent="cancel()" class="btn btn-danger" data-dismiss="modal"><span class="fas fa-window-close mr-2"></span>Đóng</button>
                    <button wire:loading.attr="disabled" wire:click.prevent="next_step(2)" class="btn btn-success">Tiếp<span class="fas fa-forward ml-2"></span></button>
                @endif

                @if ($add_diemdan_step == 2)
                    <button wire:loading.attr="disabled" wire:click.prevent="back_step(1)" class="btn btn-danger"><span class="fas fa-backward mr-2"></span>Quay lại</button>
                    <button wire:loading.attr="disabled" wire:click.prevent="save_diemdan()" class="btn btn-success">Xác nhận<span class="fas fa-fast-forward ml-2"></span></button>
                @endif

            </div>

        </div>
    </div>

</div>
