<!-- Filters -->
@php
    $tt_diadiem_phanloais = Totaa\TotaaPoster\Models\DiaDiem\DiaDiem_PhanLoai::where("active", true)->select("id", "name")->get();
    $tt_poster_mucthuongs = Totaa\TotaaPoster\Models\Poster\Poster_MucThuong::where("active", true)->select("id", "mucthuong")->get();
    $tt_poster_trangthais = Totaa\TotaaPoster\Models\Poster\Poster_TrangThai::where("active", true)->select("id", "status")->get();
@endphp

<div class="px-4 pt-4 mb-0" wire:ignore>
    <div class="form-row">

        @if (Auth::user()->bfo_info->can("add-poster"))
            <div class="col-md-auto mb-4 pr-md-3">
                <label class="form-label d-none d-md-block">&nbsp;</label>
                <div class="col px-0 mb-1 text-md-left text-center">
                    <button type="button" class="btn btn-success waves-effect" wire:click="$emit('add_diemdan')" wire:loading.attr="disabled"><span class="fas fa-plus-circle mr-2"></span>Điểm dán mới</button>
                </div>
            </div>
        @endif

        <div class="col-md mb-4">
            <label class="form-label" for="mucthuong_filter">Mức thưởng</label>
            <select class="custom-select" id="mucthuong_filter" style="width: 100%">
                @if (count($tt_poster_mucthuongs) == 1)
                    <option value="{{ $tt_poster_mucthuongs["0"]->id }}">{{ $tt_poster_mucthuongs["0"]->mucthuong }}</option>
                @else
                    <option selected></option>
                    @foreach ($tt_poster_mucthuongs as $tt_poster_mucthuong)
                        <option value="{{ $tt_poster_mucthuong->id }}">{{ $tt_poster_mucthuong->mucthuong }}</option>
                    @endforeach
                @endif
            </select>
        </div>

        <div class="col-md mb-4">
            <label class="form-label" for="trangthai_filter">Trạng thái</label>
            <select class="custom-select" id="trangthai_filter" style="width: 100%">
                @if (count($tt_poster_trangthais) == 1)
                    <option value="{{ $tt_poster_trangthais["0"]->id }}">{{ $tt_poster_trangthais["0"]->status }}</option>
                @else
                    <option selected></option>
                    @foreach ($tt_poster_trangthais as $tt_poster_trangthai)
                        <option value="{{ $tt_poster_trangthai->id }}">{{ $tt_poster_trangthai->status }}</option>
                    @endforeach
                @endif
            </select>
        </div>

        <div class="col-md mb-4">
            <label class="form-label" for="loadiadiem_filter">Loại địa điểm</label>
            <select class="custom-select" id="loadiadiem_filter" style="width: 100%">
                @if (count($tt_diadiem_phanloais) == 1)
                    <option value="{{ $tt_diadiem_phanloais["0"]->id }}">{{ $tt_diadiem_phanloais["0"]->name }}</option>
                @else
                    <option selected></option>
                    @foreach ($tt_diadiem_phanloais as $tt_diadiem_phanloai)
                        <option value="{{ $tt_diadiem_phanloai->id }}">{{ $tt_diadiem_phanloai->name }}</option>
                    @endforeach
                @endif
            </select>
        </div>

        <div class="col-md col-xl-2 mb-4 pl-md-2">
            <div class="row p-0 m-0 mw-150">
                <div class="col px-md-1">
                    <label class="form-label d-none d-md-block">&nbsp;</label>
                    <button type="button" id="filter_submit" class="btn btn-info btn-block waves-effect"><span class='fas fa-filter mx-2'></span></button>
                </div>


                <div class="col pl-md-1 pr-0" id="datatable-button">
                    <label class="form-label d-none d-md-block">&nbsp;</label>
                </div>


            </div>
        </div>

    </div>
</div>
<!-- / Filters -->
