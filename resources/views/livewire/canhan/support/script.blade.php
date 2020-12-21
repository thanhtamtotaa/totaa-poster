<script>

    moment.locale("vi");

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
    $(document).on("click", "[totaa-submit]", function() {
        file_upload($(this).attr("totaa-submit"), @this);
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

    window.addEventListener('livewire-upload-start', event => {
        let fime_names = [];
        for (let i = 0; i < $(event.target.files).length; i++) {
            fime_names.push(event.target.files[i].name);
        }

        if ($("div#TT_blockUI_custom").find("div.progress-bar." + $(event.target).attr("wire:model")).length == 0) {
            $("div#TT_blockUI_custom").append(
                '<div class="progress"><div class="progress-bar ' + $(event.target).attr("wire:model") + ' progress-bar-striped bg-info" style="width: 100%;"></div></div><div class="mx-3 mb-2 mt-1 text-left text-tiny">' +
                    fime_names +
                    "</div>"
            );
        } else {
            $("div#TT_blockUI_custom").find("div.progress-bar." + $(event.target).attr("wire:model")).removeClass("bg-info bg-warning bg-danger bg-success progress-bar-animated").addClass("bg-info").css("width", "100%");
        }
    })

    window.addEventListener('livewire-upload-finish', event => {
        let fime_names = [];
        for (let i = 0; i < $(event.target.files).length; i++) {
            fime_names.push(event.target.files[i].name);
        }

        if ($("div#TT_blockUI_custom").find("div.progress-bar." + $(event.target).attr("wire:model")).length == 0) {
            $("div#TT_blockUI_custom").append(
                '<div class="progress"><div class="progress-bar ' + $(event.target).attr("wire:model") + ' progress-bar-striped bg-success" style="width: 100%;"></div></div><div class="mx-3 mb-2 mt-1 text-left text-tiny">' +
                    fime_names +
                    "</div>"
            );
        } else {
            $("div#TT_blockUI_custom").find("div.progress-bar." + $(event.target).attr("wire:model")).removeClass("bg-info bg-warning bg-danger bg-success progress-bar-animated").addClass("bg-success").css("width", "100%");
        }
    })

    window.addEventListener('livewire-upload-error', event => {
        let fime_names = [];
        for (let i = 0; i < $(event.target.files).length; i++) {
            fime_names.push(event.target.files[i].name);
        }

        if ($("div#TT_blockUI_custom").find("div.progress-bar." + $(event.target).attr("wire:model")).length == 0) {
            $("div#TT_blockUI_custom").append(
                '<div class="progress"><div class="progress-bar ' + $(event.target).attr("wire:model") + ' progress-bar-striped bg-danger" style="width: 100%;"></div></div><div class="mx-3 mb-2 mt-1 text-left text-tiny">' +
                    fime_names +
                    "</div>"
            );
        } else {
            $("div#TT_blockUI_custom").find("div.progress-bar." + $(event.target).attr("wire:model")).removeClass("bg-info bg-warning bg-danger bg-success progress-bar-animated").addClass("bg-danger").css("width", "100%");
        }
    })

    window.addEventListener('livewire-upload-progress', event => {
        let fime_names = [];
        for (let i = 0; i < $(event.target.files).length; i++) {
            fime_names.push(event.target.files[i].name);
        }

        if ($("div#TT_blockUI_custom").find("div.progress-bar." + $(event.target).attr("wire:model")).length == 0) {
            $("div#TT_blockUI_custom").append(
                '<div class="progress"><div class="progress-bar ' + $(event.target).attr("wire:model") + ' progress-bar-striped bg-warning" style="width: 100%;"></div></div><div class="mx-3 mb-2 mt-1 text-left text-tiny">' +
                    fime_names +
                    "</div>"
            );
        } else {
            $("div#TT_blockUI_custom").find("div.progress-bar." + $(event.target).attr("wire:model")).removeClass("bg-info bg-warning bg-danger bg-success").addClass("bg-warning progress-bar-animated").css("width", event.detail.progress + "%");
        }
    })

</script>
