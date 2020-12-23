<?php

namespace Totaa\TotaaPoster\Models\DiaDiem;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Wildside\Userstamps\Userstamps;

class DiaDiem_List extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Userstamps;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'diadiem_lists';

    // Disable Laravel's mass assignment protection
    protected $guarded = ['id'];

    /**
     * Mỗi địa điểm thuộc một phân loại
     *
     * @return void
     */
    public function loaidiadiem()
    {
        return $this->belongsTo('Totaa\TotaaPoster\Models\DiaDiem\DiaDiem_PhanLoai', 'loaidiadiem_id', 'id');
    }

    //Một điểm dán có thể có nhiều poster
    public function posters()
    {
        return $this->hasMany('Totaa\TotaaPoster\Models\Poster\Poster_List', 'diadiem_id', 'id');
    }

    /**
     * Mỗi địa điểm nằm ở một xã nào đó
     *
     * @return void
     */
    public function xa()
    {
        return $this->belongsTo('Totaa\TotaaDonvi\Models\TotaaXa', 'xa_id', 'id');
    }

}
