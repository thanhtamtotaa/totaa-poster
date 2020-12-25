<?php

namespace Totaa\TotaaPoster\DataTables;

use Totaa\TotaaPoster\Models\Poster\Poster_List;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Database\Eloquent\Builder;
use Auth;

class PosterCaNhanDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->filter(function ($query) {
                if (!!request('loadiadiem_filter')) {
                    $query->whereHas('diadiem', function (Builder $query2) {
                        $query2->where('diadiem_lists.loaidiadiem_id', request('loadiadiem_filter'));
                    });
                }

                if (!!request('mucthuong_filter')) {
                    $query->where('poster_lists.mucthuong_id', request('mucthuong_filter'));
                }

                if (!!request('trangthai_filter')) {
                    $query->where('poster_lists.trangthai_id', request('trangthai_filter'));
                }
            }, true)
            ->addColumn('action', function ($query) {
                $nv_info = Auth::user()->bfo_info;
                $Action_Icon="<div class='action-div icon-4 px-0 mx-1 d-flex justify-content-around text-center'>";

                if ($nv_info->can("view-poster")) {
                    $Action_Icon.="<div class='col action-icon-w-50 action-icon' totaa-view-poster='$query->id'><i class='text-info fas fa-search'></i></div>";
                }

                if ($nv_info->can("add-poster")) {
                    if ($query->trangthai_id == 5) {
                        $Action_Icon.="<div class='col action-icon-w-50 action-icon' totaa-add-poster='$query->id'><i class='text-success fas fa-plus'></i></div>";
                    } else {
                        $Action_Icon.="<div class='col action-icon-w-50'></div>";
                    }
                }

                if ($nv_info->can("delete-poster")) {
                    if ($query->trangthai_id == 5) {
                        $Action_Icon.="<div class='col action-icon-w-50 action-icon' totaa-delete-poster='$query->id'><i class='text-danger fas fa-trash-alt'></i></div>";
                    } else {
                        $Action_Icon.="<div class='col action-icon-w-50'></div>";
                    }
                }

                $Action_Icon.="</div>";

                return $Action_Icon;
            })
            ->editColumn('diachi', function ($poster) {
                return $poster->diadiem->diachi." - ".$poster->diadiem->xa->level." ".$poster->diadiem->xa->name." - ".$poster->diadiem->xa->huyen->level." ".$poster->diadiem->xa->huyen->name." - ".$poster->diadiem->xa->huyen->tinh->level." ".$poster->diadiem->xa->huyen->tinh->name;
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \Totaa\TotaaPoster\Models\Poster\Poster_List $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Poster_List $model)
    {
        $nv_info = Auth::user()->bfo_info;

        $query = $model->newQuery();

        if (!request()->has('order')) {
            $query->orderBy('id', 'asc');
        };

        $query->where(function ($query2) use ($nv_info) {
            $query2->where('poster_lists.created_by_mnv', $nv_info->mnv)
                  ->orWhere('poster_lists.belongto_mnv', $nv_info->mnv);
        });

        return $query->with(["poster_name:*", "muctrathuong:*", "trangthai:*", "quanly_by:*", 'diadiem:id,tendiadiem,chudiadiem,phone,xa_id,diachi,loaidiadiem_id', 'diadiem.xa:id,level,name,huyen_id', 'diadiem.xa.huyen:id,level,name,tinh_id', 'diadiem.xa.huyen.tinh:id,level,name', 'diadiem.loaidiadiem:*', ])
                    ->withCount(['poster_chitiets' => function (Builder $query2) {
                        $query2->where('poster_chitiets.active', true);
                    }]);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('poster_list-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax("",NULL, [
                        "mucthuong_filter" => '$("#mucthuong_filter").val()',
                        "trangthai_filter" => '$("#trangthai_filter").val()',
                        "loadiadiem_filter" => '$("#loadiadiem_filter").val()',
                    ])
                    ->dom("<'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r><'row'<'col-sm-12 table-responsive't>><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>><'d-none'B>")
                    ->buttons(
                        Button::make('excel')->addClass("btn btn-success btn-block waves-effect")->text('<span class="fas fa-file-excel mx-2"></span>')->title('Dữ liệu Poster Cá nhân ' . date('YmdHis')),
                    )
                    ->parameters([
                        "autoWidth" => false,
                        "lengthMenu" => [
                            [10, 25, 50, -1],
                            [10, 25, 50, "Tất cả"]
                        ],
                        "order" => [],
                        'initComplete' => 'function(settings, json) {
                            var api = this.api();

                            $(document).on("click", "#filter_submit", function(e) {
                                api.draw(false);
                                e.preventDefault();
                            });

                            window.addEventListener("dt_draw", function(e) {
                                api.draw(false);
                                e.preventDefault();
                            });

                            api.buttons()
                                .container()
                                .appendTo($("#datatable-button"));
                        }',
                    ]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::computed('action')
                    ->exportable(false)
                    ->printable(false)
                    ->width(60)
                    ->addClass('text-center')
                    ->title("")
                    ->footer(""),
            Column::make('poster_code')
                    ->title("Mã Poster")
                    ->width(15)
                    ->searchable(true)
                    ->orderable(true)
                    ->footer("Mã Poster"),
            Column::make('poster_name.name')
                    ->title("Tên Poster")
                    ->width(25)
                    ->searchable(false)
                    ->orderable(false)
                    ->render("function() {
                          if (!!data) {
                              return data;
                          } else {
                              return null;
                          }
                      }")
                    ->footer("Tên Poster"),
            Column::make('poster_chitiets_count')
                    ->title("Số lượng")
                    ->width(25)
                    ->searchable(false)
                    ->orderable(false)
                    ->render("function() {
                          if (!!data) {
                              return data;
                          } else {
                              return null;
                          }
                      }")
                    ->footer("Số lượng"),
            Column::make('quanly_by.full_name')
                    ->title("Trình dược viên")
                    ->width(200)
                    ->searchable(false)
                    ->orderable(false)
                    ->render("function() {
                          if (!!data) {
                              return data;
                          } else {
                              return null;
                          }
                      }")
                    ->footer("Trình dược viên"),
            Column::make('muctrathuong.mucthuong')
                    ->title("Mức trả thưởng")
                    ->width(25)
                    ->searchable(false)
                    ->orderable(false)
                    ->render("function() {
                          if (!!data) {
                              return data;
                          } else {
                              return null;
                          }
                      }")
                    ->footer("Mức trả thưởng"),
            Column::make('trangthai.status')
                    ->title("Trạng thái")
                    ->width(25)
                    ->searchable(false)
                    ->orderable(false)
                    ->render("function() {
                          if (!!data) {
                              return data;
                          } else {
                              return null;
                          }
                      }")
                    ->footer("Trạng thái"),
            Column::make('diadiem.loaidiadiem.name')
                    ->title("Loại địa điểm")
                    ->width(25)
                    ->searchable(false)
                    ->orderable(false)
                    ->render("function() {
                          if (!!data) {
                              return data;
                          } else {
                              return null;
                          }
                      }")
                    ->footer("Loại địa điểm"),
            Column::make('diadiem.tendiadiem')
                    ->title("Tên địa điểm")
                    ->width(25)
                    ->searchable(false)
                    ->orderable(false)
                    ->render("function() {
                          if (!!data) {
                              return data;
                          } else {
                              return null;
                          }
                      }")
                    ->footer("Tên địa điểm"),
            Column::make('diadiem.chudiadiem')
                    ->title("Chủ địa điểm")
                    ->width(25)
                    ->searchable(false)
                    ->orderable(false)
                    ->render("function() {
                          if (!!data) {
                              return data;
                          } else {
                              return null;
                          }
                      }")
                    ->footer("Chủ địa điểm"),
            Column::make('diadiem.phone')
                    ->title("Số điện thoại")
                    ->width(25)
                    ->searchable(false)
                    ->orderable(false)
                    ->render("function() {
                          if (!!data) {
                              return data;
                          } else {
                              return null;
                          }
                      }")
                    ->footer("Số điện thoại"),
            Column::make('diachi')
                    ->title("Địa chỉ")
                    ->searchable(false)
                    ->orderable(false)
                    ->render("function() {
                          if (!!data) {
                              return data;
                          } else {
                              return null;
                          }
                      }")
                    ->footer("Địa chỉ"),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Dữ liệu Poster Cá nhân ' . date('YmdHis');
    }
}
