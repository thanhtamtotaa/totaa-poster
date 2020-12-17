<?php

namespace Totaa\TotaaPoster\Models\DiaDiem;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Wildside\Userstamps\Userstamps;

class DiaDiem_PhanLoai extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Userstamps;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'diadiem_phanloais';

    // Disable Laravel's mass assignment protection
    protected $guarded = ['id'];

}
