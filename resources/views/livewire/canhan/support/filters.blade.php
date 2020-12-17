<!-- Filters -->
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
            <label class="form-label" for="mnv_filter">Mã nhân viên</label>
            <input type="text" id="mnv_filter" class="form-control px-2" placeholder="Lọc theo Mã nhân viên">
        </div>

        <div class="col-md mb-4">
            <label class="form-label" for="full_name_filter">Họ và tên</label>
            <input type="text" id="full_name_filter" class="form-control px-2" placeholder="Lọc theo họ và tên">
        </div>


        <div class="col-md mb-4">
            <label class="form-label" for="chinhanh_filter">Đơn vị</label>
            <select class="custom-select" id="chinhanh_filter" style="width: 100%">
                <option selected></option>
                <option value="Hội sở Hà Bình Phương">Hội sở Hà Bình Phương</option>
                <option value="Chi nhánh Hà Nội">Chi nhánh Hà Nội</option>
                <option value="Chi nhánh Đà Nẵng">Chi nhánh Đà Nẵng</option>
                <option value="Chi nhánh Hồ Chí Minh">Chi nhánh Hồ Chí Minh</option>
                <option value="Văn phòng Tây Nguyên">Văn phòng Tây Nguyên</option>
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
