<?php

namespace Totaa\TotaaPoster\Models\Poster;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Wildside\Userstamps\Userstamps;

class Poster_ChiTiet extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Userstamps;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'poster_chitiets';

    // Disable Laravel's mass assignment protection
    protected $guarded = ['id'];

    //Một poster chi tiết thuộc về một poster
    public function poster()
    {
        return $this->belongsTo('Totaa\TotaaPoster\Models\Poster\Poster_List', 'poster_id', 'id');
    }

    //Một mỗi poster có một hình thức
    public function hinhthuc()
    {
        return $this->belongsTo('Totaa\TotaaPoster\Models\Poster\Poster_HinhThuc', 'poster_hinhthuc_id', 'id');
    }

    //Một mỗi poster có một loại chất liệu bề mặt
    public function chatlieubemat()
    {
        return $this->belongsTo('Totaa\TotaaPoster\Models\Poster\Poster_BeMat', 'poster_bemat_id', 'id');
    }

    //Một yêu cầu poster mới có nhiều  hình ảnh
    public function hinhanhs()
    {
        return $this->hasMany('Totaa\TotaaPoster\Models\Poster\Poster_ChiTiet_HinhAnh', 'poster_chitiet_id', 'id');
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
