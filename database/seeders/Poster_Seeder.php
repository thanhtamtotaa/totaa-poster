<?php

namespace Totaa\TotaaPoster\Database\Seeders;

use Illuminate\Database\Seeder;
use Totaa\TotaaPoster\Models\Poster\Poster_Name;
use Totaa\TotaaPoster\Models\Poster\Poster_BeMat;
use Totaa\TotaaPoster\Models\Poster\Poster_HinhThuc;
use Totaa\TotaaPoster\Models\Poster\Poster_MucThuong;
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
        //Seeder phân loại địa điểm
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

        //Seeder tên Poster
        Poster_Name::updateOrCreate(
            ['id' => 1],
            ['name' => "Progermila", 'active' => true]
        );

        Poster_Name::updateOrCreate(
            ['id' => 2],
            ['name' => "Nebusal", 'active' => true]
        );

        //Seeder Hình thức Poster
        Poster_HinhThuc::updateOrCreate(
            ['id' => 1],
            ['name' => "Decal PP dán", 'active' => true]
        );
        Poster_HinhThuc::updateOrCreate(
            ['id' => 2],
            ['name' => "Formex", 'active' => true]
        );
        Poster_HinhThuc::updateOrCreate(
            ['id' => 3],
            ['name' => "Bandroll treo", 'active' => true]
        );
        Poster_HinhThuc::updateOrCreate(
            ['id' => 4],
            ['name' => "Biển vẫy", 'active' => true]
        );
        Poster_HinhThuc::updateOrCreate(
            ['id' => 5],
            ['name' => "Biển không có thông tin TH NT", 'active' => true]
        );
        Poster_HinhThuc::updateOrCreate(
            ['id' => 6],
            ['name' => "Biển hiệu có thông tin TH NT", 'active' => true]
        );

        //Seeder Bề mặt dán Poster
        Poster_BeMat::updateOrCreate(
            ['id' => 1],
            ['name' => "Tường", 'active' => true]
        );
        Poster_BeMat::updateOrCreate(
            ['id' => 2],
            ['name' => "Kính", 'active' => true]
        );
        Poster_BeMat::updateOrCreate(
            ['id' => 3],
            ['name' => "Kim loại", 'active' => true]
        );
        Poster_BeMat::updateOrCreate(
            ['id' => 4],
            ['name' => "Gỗ", 'active' => true]
        );
        Poster_BeMat::updateOrCreate(
            ['id' => 9],
            ['name' => "Khác", 'active' => true]
        );

        //Seeder Poster_MucThuong
        Poster_MucThuong::updateOrCreate(
            ['id' => 1],
            ['mucthuong' => "180.000 VND/Quý", 'active' => true]
        );

        Poster_MucThuong::updateOrCreate(
            ['id' => 2],
            ['mucthuong' => "240.000 VND/Quý", 'active' => true]
        );

        Poster_MucThuong::updateOrCreate(
            ['id' => 3],
            ['mucthuong' => "540.000 VND/Quý", 'active' => true]
        );

        Poster_MucThuong::updateOrCreate(
            ['id' => 9],
            ['mucthuong' => "0 đồng", 'active' => true]
        );
    }
}
