<?php

namespace Totaa\TotaaPoster\Models\Poster;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Wildside\Userstamps\Userstamps;

class Poster_MucThuong extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Userstamps;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'poster_mucthuongs';

    // Disable Laravel's mass assignment protection
    protected $guarded = ['id'];

}
