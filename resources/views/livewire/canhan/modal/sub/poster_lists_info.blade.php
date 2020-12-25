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
                        <div>
                            <div totaa-id="blueimp-carousel" class="blueimp-gallery blueimp-gallery-carousel blueimp-gallery-controls">
                                <div class="slides"></div>
                                <a class="prev">‹</a>
                                <a class="next">›</a>
                                <a class="play-pause"></a>
                                <ol class="indicator"></ol>

                                @foreach ($poster_chitiet->hinhanhs as $hinhanh)
                                    @php
                                        $gallery = $hinhanh->anh->getGallery();
                                    @endphp
                                    <a totaa-blueimp-carousel href="{{ $gallery["url"] }}" mine-type="{{ $gallery["mimetype"] }}" thumbnail="{{ $gallery["thumbnail"] }}" class="img-fluid hidden"></a>
                                @endforeach

                            </div>
                        </div>
                    @endif

                </div>

                <div class="col-12 col-xl-6 mb-3 h-max-content">
                    <div class="row">

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



                    </div>
                </div>



            @endforeach

        @endif
    </div>
</div>
