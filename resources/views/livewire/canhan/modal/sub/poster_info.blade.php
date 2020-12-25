<div class="col-12 col-xl-6 mb-3 h-max-content">
    <div class="row">

        <div class="col-md-12">
            <div class="form-group">
                <h5 class="text-info">Thông tin Poster:</h5>
            </div>
        </div>

        @if (!!$poster)

            <div class="col-12 col-md-6">
                <div class="form-group">
                    <label class="col-form-label">Mã Poster:</label>
                    <div>
                        <span type="text" class="form-control px-2 h-auto">{{ $poster->poster_code }}</span>
                    </div>
                </div>
            </div>

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

        @endif
    </div>
</div>
