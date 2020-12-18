<script>

    moment.locale("vi");

    //Ẩn toàn bộ modal
    window.addEventListener('hide_modal', function(e) {
        $(".modal.fade").modal("hide");
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

    //Block UI khi ấn thêm mới
    Livewire.on('add_diemdan', function() {
        ToTaa_BlockUI();
    });

    //Gọi view edit role
    $(document).on("click", "[totaa-edit-role]", function() {
        ToTaa_BlockUI();
        Livewire.emit('edit_role', $(this).attr("totaa-edit-role"));
    });

    //Gọi view set-role-permission
    $(document).on("click", "[totaa-set-role-permission]", function() {
        ToTaa_BlockUI();
        Livewire.emit('set_role_permission', $(this).attr("totaa-set-role-permission"));
    });

    //Gọi view xác nhận xóa
    $(document).on("click", "[totaa-delete-role]", function() {
        ToTaa_BlockUI();
        Livewire.emit('delete_role', $(this).attr("totaa-delete-role"));
    });

    //Xử lý khi dữ liệu đã được load xong
    document.addEventListener("DOMContentLoaded", () => {
        Livewire.hook("message.processed", (message, component) => {
            $.unblockUI();

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

    window.addEventListener('livewire-upload-start', event => {
        console.log(event);
    })
    window.addEventListener('livewire-upload-finish', event => {
        console.log(event);
    })
    window.addEventListener('livewire-upload-error', event => {
        console.log(event);
    })
    window.addEventListener('livewire-upload-progress', event => {
        console.log(event);
    })

</script>
