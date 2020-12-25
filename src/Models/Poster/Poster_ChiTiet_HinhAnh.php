<?php

namespace Totaa\TotaaPoster\Models\Poster;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Wildside\Userstamps\Userstamps;

class Poster_ChiTiet_HinhAnh extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Userstamps;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'poster_chitiet_hinhanhs';

    // Disable Laravel's mass assignment protection
    protected $guarded = ['id'];

    /**
     * Mỗi  hình ảnh đều được lưu trong thư viện
     *
     * @return void
     */
    public function anh()
    {
        return $this->hasOne('Totaa\TotaaFileUpload\Models\FileUpload', 'id', 'totaa_file_id');
    }
}
