<?php

namespace Totaa\TotaaPoster\Models\Poster;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Wildside\Userstamps\Userstamps;

class Poster_List extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Userstamps;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'poster_lists';

    // Disable Laravel's mass assignment protection
    protected $guarded = ['id'];

    //Một poster thuộc một địa điểm
    public function diadiem()
    {
        return $this->belongsTo('Totaa\TotaaPoster\Models\DiaDiem\DiaDiem_List', 'diadiem_id', 'id');
    }

    //Một poster đều thuộc về một sản phẩm
    public function poster_name()
    {
        return $this->belongsTo('Totaa\TotaaPoster\Models\Poster\Poster_Name', 'poster_name_id', 'id');
    }

    //Một poster đều có một mức trả thưởng
    public function muctrathuong()
    {
        return $this->belongsTo('Totaa\TotaaPoster\Models\Poster\Poster_MucThuong', 'mucthuong_id', 'id');
    }

    //Một poster đều có một trạng thái
    public function trangthai()
    {
        return $this->belongsTo('Totaa\TotaaPoster\Models\Poster\Poster_TrangThai', 'trangthai_id', 'id');
    }

    //Một poster đều thuộc về một nhân viên nào đó quản lý
    public function quanly_by()
    {
        return $this->belongsTo('Totaa\TotaaBfo\Models\BfoInfo', 'belongto_mnv', 'mnv');
    }

    //Một poster được tạo bởi một nhân viên
    public function created_by()
    {
        return $this->belongsTo('Totaa\TotaaBfo\Models\BfoInfo', 'created_by_mnv', 'mnv');
    }
}
