<script>

    moment.locale("vi");

    //Trạng thái filter
    $("#trangthai_filter")
        .wrap('<div class="position-relative"></div>')
        .select2({
            placeholder: "Chọn trạng thái",
            minimumResultsForSearch: 10,
            allowClear: true
        });

    //Loại địa điểm filter
    $("#loadiadiem_filter")
        .wrap('<div class="position-relative"></div>')
        .select2({
            placeholder: "Chọn loại địa điểm",
            minimumResultsForSearch: 10,
            allowClear: true
        });

    //Mức thưởng filter
    $("#mucthuong_filter")
        .wrap('<div class="position-relative"></div>')
        .select2({
            placeholder: "Chọn mức thưởng",
            minimumResultsForSearch: 10,
            allowClear: true
        });

    //Ẩn toàn bộ modal
    window.addEventListener('hide_modal', function(e) {
        $(".modal.fade").modal("hide");
    })

    //$.blockUI();
    window.addEventListener('blockUI', function(e) {
        ToTaa_BlockUI();
    })

    //$.unblockUI();
    window.addEventListener('unblockUI', function(e) {
        $.unblockUI();
    })

    //Hiện modal cụ thể
    window.addEventListener('show_modal', event => {
        $(event.detail).modal("show");
    })

    //Toastr thông báo
    window.addEventListener('toastr', event => {
        toastr[event.detail.type](event.detail.message, event.detail.title, {
            positionClass: "toast-top-right",
            closeButton: true,
            progressBar: true,
            timeOut: 15000,
            extendedTimeOut: 2000,
            preventDuplicates: false,
            newestOnTop: true,
            rtl: $("body").attr("dir") === "rtl" ||
                $("html").attr("dir") === "rtl"
        });
    })

    //Gọi view edit role
    $(document).on("click", "[totaa-block-ui]", function() {
        ToTaa_BlockUI();
    });

    //Submit
    $(document).on("click", '[totaa-click-prevent]', function(event) {
        event.preventDefault();
        file_upload($(this).attr("totaa-click-prevent"));

    });

    //Block UI khi ấn thêm mới
    Livewire.on('add_diemdan', function() {
        ToTaa_BlockUI();
    });

    //Gọi view edit role
    $(document).on("click", "[totaa-edit-role]", function() {
        ToTaa_BlockUI();
        Livewire.emit('edit_role', $(this).attr("totaa-edit-role"));
    });

    //Gọi view thêm Poster
    $(document).on("click", "[totaa-add-poster]", function() {
        ToTaa_BlockUI();
        Livewire.emit('add_poster_modal', $(this).attr("totaa-add-poster"));
    });

    //Gọi view xác nhận xóa Poster
    $(document).on("click", "[totaa-delete-poster]", function() {
        ToTaa_BlockUI();
        Livewire.emit('delete_poster_confirm', $(this).attr("totaa-delete-poster"));
    });

    //Xử lý khi dữ liệu đã được load xong
    document.addEventListener("DOMContentLoaded", () => {
        Livewire.hook("message.failed", (message, component) => {
            $.unblockUI();
        });

        Livewire.hook("message.processed", (message, component) => {

            if ($("select.select2-totaa").length != 0) {
                $("select.select2-totaa").each(function(e) {
                    $(this)
                    .wrap('<div class="position-relative"></div>')
                    .select2({
                        placeholder: $(this).attr("totaa-placeholder"),
                        minimumResultsForSearch: $(this).attr("totaa-search"),
                        dropdownParent: $("#" + $(this).attr("id") + "_div"),
                    });
                });
            }

        });
    });

    if ($("select.select2-totaa").length != 0) {
        $("select.select2-totaa").each(function(e) {
            $(this).on('select2:close', function (e) {
                @this.set($(this).attr("wire:model"), $(this).val());
            });
        });
    }


</script>
