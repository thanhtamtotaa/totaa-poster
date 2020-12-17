<?php

namespace Totaa\TotaaPoster\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Totaa\TotaaPoster\DataTables\PosterCaNhanDataTable;
use Totaa\TotaaPoster\DataTables\PosterNhomDataTable;

class PosterController extends Controller
{
    /**
     * canhan
     *
     * @return void
     */
    public function canhan(PosterCaNhanDataTable $dataTable)
    {
        if (Auth::user()->bfo_info->hasAnyPermission(["view-poster", "add-poster"])) {
            return $dataTable->render('totaa-poster::canhan', ['title' => 'Poster - Cá nhân']);
        } else {
            return view('errors.dynamic', [
                'error_code' => '403',
                'error_description' => 'Không có quyền truy cập',
                'title' => 'Poster - Cá nhân',
            ]);
        }
    }

    /**
     * nhom
     *
     * @return void
     */
    public function nhom(PosterNhomDataTable $dataTable)
    {
        if (Auth::user()->bfo_info->hasAnyPermission(["view-poster"])) {
            return $dataTable->render('totaa-poster::nhom', ['title' => 'Poster - Nhóm']);
        } else {
            return view('errors.dynamic', [
                'error_code' => '403',
                'error_description' => 'Không có quyền truy cập',
                'title' => 'Poster - Nhóm',
            ]);
        }
    }
}
