<?php

namespace Totaa\TotaaPoster\DataTables;

use Totaa\TotaaPoster\Models\Poster\Poster_List;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

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
            ->addColumn('action', 'poster_list.action')
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
        $query = $model->newQuery();

        if (!request()->has('order')) {
            $query->orderBy('id', 'asc');
        };

        return $query->with(["poster_name:*", "muctrathuong:*", "trangthai:*", "quanly_by:*", 'diadiem:id,tendiadiem,chudiadiem,phone,xa_id,diachi,loaidiadiem_id', 'diadiem.xa:id,level,name,huyen_id', 'diadiem.xa.huyen:id,level,name,tinh_id', 'diadiem.xa.huyen.tinh:id,level,name', 'diadiem.loaidiadiem:*', ]);
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
                    ->dom("<'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r><'row'<'col-sm-12 table-responsive't>><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>")
                    ->parameters([
                        "autoWidth" => false,
                        "lengthMenu" => [
                            [10, 25, 50, -1],
                            [10, 25, 50, "Tất cả"]
                        ],
                        "order" => [],
                        'initComplete' => 'function(settings, json) {
                            var api = this.api();
                            window.addEventListener("dt_draw", function(e) {
                                api.draw(false);
                                e.preventDefault();
                            })
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
        return 'Poster_List_' . date('YmdHis');
    }
}
