<?php

namespace Totaa\TotaaPoster\Database\Seeders;

use Illuminate\Database\Seeder;
use Totaa\TotaaPoster\Models\DiaDiem\DiaDiem_PhanLoai;

class Poster_Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DiaDiem_PhanLoai::updateOrCreate(
            ['id' => 1],
            ['name' => "Cửa hàng tiêu dùng/Tạp hóa", 'active' => true]
        );
        DiaDiem_PhanLoai::updateOrCreate(
            ['id' => 2],
            ['name' => "Nhà thuốc", 'active' => true]
        );
        DiaDiem_PhanLoai::updateOrCreate(
            ['id' => 4],
            ['name' => "Quầy thuốc", 'active' => true]
        );
        DiaDiem_PhanLoai::updateOrCreate(
            ['id' => 9],
            ['name' => "Khác", 'active' => true]
        );
    }
}
